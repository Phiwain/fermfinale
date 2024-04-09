<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_cart')]
    public function index(Cart $cart): Response
    {
        $selectedQuantity = null;
        return $this->render('cart/index.html.twig',[
            'cart'=>$cart->getCart(),
            'total'=>$cart->getTotal(),
            'selectedQuantity' => $selectedQuantity
        ]);
    }
    #[Route('/cart/add/{id}', name: 'app_cart_add', requirements: ['id' => '\d+'])]
    public function add(int $id, Cart $cart, ProductRepository $productRepository, Request $request): Response
    {

        // Rechercher le produit par son identifiant
        $product = $productRepository->findOneById($id);

        // Si le produit n'existe pas, rediriger avec un message d'erreur
        if (!$product) {
            $this->addFlash('error', "Produit non trouvé.");
            return $this->redirect($request->headers->get('referer'));
        }

        // Récupérer la quantité sélectionnée depuis la demande
        $selectedQuantity = $request->request->get('selected_quantity');

        // Vérifier si la quantité est valide
        if (!is_numeric($selectedQuantity) || $selectedQuantity <= 0) {
            $this->addFlash('error', "Quantité invalide.");
            return $this->redirect($request->headers->get('referer'));
        }

        // Convertir la quantité en un nombre décimal
        $selectedQuantity = floatval($selectedQuantity);

        // Ajouter le produit avec la quantité sélectionnée au panier
        $cart->add($product, $selectedQuantity);
        dd($cart->getCart());
        // Message de succès
        $this->addFlash('success', "Produit correctement ajouté à votre panier");

        // Rediriger vers la page précédente
        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/cart/descrease/{id}', name: 'app_cart_decrease')]
    public function decrease($id, Cart $cart): Response
    {

        $cart->decrease($id);


        $this->addFlash(
            'success',
            "Produit correctement supprimé à votre panier"
        );

        return $this->redirectToRoute('app_cart');
    }


    #[Route('/cart/remove', name: 'app_cart_remove')]
    public function remove(Cart $cart): Response
    {

        $cart->remove();


        return $this->redirectToRoute('app_home');
    }
}
