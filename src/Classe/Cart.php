<?php

namespace App\Classe;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{
    public function __construct(private RequestStack $requestStack)
    {

    }

    public function add($product, $quantity)
    {
        $cart = $this->requestStack->getSession()->get('cart');

        // Convertir la quantité en un entier
        $quantity = intval($quantity);

        // Vérifier si le produit est déjà dans le panier
        if (isset($cart[$product->getId()])) {
            // Si oui, mettre à jour la quantité existante
            $cart[$product->getId()]['qty'] += $quantity;
        } else {
            // Sinon, ajouter un nouveau produit au panier
            $cart[$product->getId()] = [
                'object' => $product,
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
    public  function fullQuantity(){
        $cart=$this->requestStack->getSession()->get('cart');
        $quantity = 0;

        if(!isset($cart)){
            return $quantity;
        }

        foreach ($cart as $product) {
            $quantity = $quantity + intval($product['qty']);
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
            $qty = intval($product['qty']); // Conversion en entier
            $price = $price + ($product['object']->getPrice() * $qty);
        }
        return $price;
    }
    public function remove()
    {
       return $this->requestStack->getSession()->remove('cart');
    }
    public function getCart(){
        return $this->requestStack->getSession()->get('cart');
    }
}