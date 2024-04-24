<?php

namespace App\Classe;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart
{
    public function __construct(private RequestStack $requestStack)
    {

    }

    public function add(array $product, $quantity)
    {
        $cart = $this->requestStack->getSession()->get('cart', []);

        $quantity = floatval($quantity);

        $productId = $product['id'];
        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'illustration' => $product['illustration'],
                'price' => $product['price'],
                'qty' => $quantity
            ];
        }

        $this->requestStack->getSession()->set('cart', $cart);
    }


    public function decrease($id)
    {
        $cart=$this->requestStack->getSession()->get('cart');

        if ($cart[$id]['qty'] > 1){
            $cart[$id]['qty']  = $cart[$id]['qty'] -1;
        } else {
            unset($cart[$id]);
        }
        $this->requestStack->getSession()->set('cart', $cart );
    }
    public function fullQuantity()
    {
        $cart = $this->requestStack->getSession()->get('cart');
        $quantity = 0;

        if (!isset($cart)) {
            return $quantity;
        }

        foreach ($cart as $product) {
            if (is_array($product) && array_key_exists('qty', $product)) {
                $quantity += floatval($product['qty']);
            }
        }

        return $quantity;
    }

    public function getTotal()
    {
        $cart = $this->requestStack->getSession()->get('cart');
        $price = 0;

        if (!isset($cart)) {
            return $price;
        }

        foreach ($cart as $product) {
            $qty = floatval($product['qty']); // Conversion en entier
            $price = $price + ($product['price'] * $qty);
        }
        return $price;
    }
    public function remove()
    {
       return $this->requestStack->getSession()->remove('cart');
    }
    public function getCart(SessionInterface $session){
        return  $session->get('cart', []);
    }
}