<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits');
    }

    public function configureFields(string $pageName): iterable
    {
        $required = true;
        if ($pageName == 'edit'){$required=false;}

        return [
            TextField::new('name')->setLabel('Nom'),
            SlugField::new('slug')->setLabel('URL')->setTargetFieldName('name')->setHelp('URL du produit générée automatiquement'),
            TextEditorField::new('description')->setLabel('Description'),
            ImageField::new('illustration')
                ->setLabel('Image')
                ->setHelp('Image du produit')
                ->setUploadDir('/public/uploads')
                ->setBasePath('/uploads')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
                ->setRequired($required),
            NumberField::new('price')->setLabel('Prix au Kg')->setHelp('Prix au kg - sans le €'),
            AssociationField::new('Quantity', 'Quantité'),
            AssociationField::new('category', 'Catégorie')

        ];
    }
}
