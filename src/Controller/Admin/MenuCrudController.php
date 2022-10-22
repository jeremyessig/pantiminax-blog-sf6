<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuCrudController extends AbstractCrudController
{

    const MENU_PAGES = 0;
    const MENU_ARTICLE = 1;
    const MENU_LINKS = 2;
    const MENU_CATEGORIES = 3;

    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return Menu::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        $submenuIndex = $this->getSubMenuIndex();
        $entityLabelInSingular = 'un menu';
        $entityLabelInPlural = match ($submenuIndex) {
            self::MENU_ARTICLE => 'Articles',
            self::MENU_CATEGORIES => 'Catégories',
            self::MENU_LINKS => 'Liens personnalisés',
            default => 'Pages'
        };

        return $crud
            ->setEntityLabelInSingular($entityLabelInSingular)
            ->setEntityLabelInPlural($entityLabelInPlural);
    }


    public function configureFields(string $pageName): iterable
    {

        yield TextField::new('name', 'Titre de la navigation');
        yield NumberField::new('menuOrder', 'Ordre');
        yield BooleanField::new('isVisible', 'Visible');
        yield AssociationField::new('subMenus', 'Sous-éléments');
    }

    // 11:40 minutes

    private function getSubMenuIndex(): int
    {
        return $this->requestStack->getMainRequest()->query->getInt('submenuIndex');
    }
}
