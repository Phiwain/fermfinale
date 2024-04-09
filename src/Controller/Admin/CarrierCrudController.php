<?php

namespace App\Controller\Admin;

use App\Entity\Carrier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarrierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Carrier::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Point de Livraisons')
            ->setEntityLabelInPlural('Points de Livraison');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Name')->setLabel("Nom du point de livraison"),
            TextEditorField::new('Address')->setLabel("Adresse du point de livraison"),
        ];
    }

}
