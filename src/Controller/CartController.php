<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_cart')]
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $cart = $session->get('cart', []);
        $cartWithData = [];
        $total = 0;
        $fullCartQuantity = 0;

        foreach ($cart as $id => $item) {
            $product = $productRepository->find($id);
            if ($product) {
                $fullCartQuantity++;

                $subtotal = $product->getPrice() * $item['qty'];

                $cartWithData[] = [
                    'product' => $product,
                    'quantity' => $item['qty'],
                    'subtotal' => $subtotal
                ];

                $total += $subtotal;
            }
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $cartWithData,
            'total' => $total,
            'fullCartQuantity' => $fullCartQuantity,
        ]);
    }
    #[Route('/cart/add/{id}', name: 'app_cart_add', requirements: ['id' => '\d+'])]
    public function add(int $id, SessionInterface $session, Request $request,ProductRepository $productRepository): Response
    {
        $cart = $session->get('cart', []);

        $quantity = $request->request->get('quantity', 1);
        $product = $productRepository->find($id);
        $productId = $product->getId();
        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'illustration' => $product->getIllustration(),
                'price' => $product->getPrice(),
                'qty' => $quantity
            ];
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove/{id}', name: 'app_cart_remove', requirements: ['id' => '\d+'])]
    public function remove(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        unset($cart[$id]);
        $session->set('cart', $cart);

        return $this->redirectToRoute('app_cart');
    }
}
