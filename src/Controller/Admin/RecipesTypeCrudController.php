<?php

namespace App\Controller\Admin;

use App\Entity\RecipesType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecipesTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RecipesType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type de recette')
            ->setEntityLabelInPlural('Types de recettes');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom'),
            SlugField::new('slug')->setLabel('URL')->setTargetFieldName('name')->setHelp('URL du produit générée automatiquement'),
        ];
    }

}
