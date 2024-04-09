<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/produits', name: 'app_product')]
    public function index(ProductRepository $productRepository): Response
    {
        $selected_quantity=null;
        $products=$productRepository->findAll();
        if(!$products){
            return $this->redirectToRoute('app_product');
        }


        return $this->render('product/index.html.twig', [
            'products'=>$products,
            'selected_quantity'=>$selected_quantity
        ]);
    }
}
