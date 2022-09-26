<?php

namespace App\Controller\Admin;

use App\Entity\BlogOption;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BlogOptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogOption::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
