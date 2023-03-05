<?php

namespace App\Controller\Admin;

use App\Entity\Songs;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SongsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Songs::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            
            ImageField::new('name')
                ->setBasePath('/uploads/songs/')
                ->setUploadDir('public/uploads/songs')
                ->setRequired(false),
            ImageField::new('image')
                ->setBasePath('/uploads/images/')
                ->setUploadDir('public/uploads/images')
                ->setRequired(false),
            TextField::new('category'),
            
        ];
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $audioFile = $entityInstance->getName();
        $imageFile = $entityInstance->getImage();

        if ($audioFile) {
            $audioPath = $this->getParameter('kernel.project_dir') . '/public/uploads/songs/' . $audioFile;
            if (file_exists($audioPath)) {
                unlink($audioPath);
            }
        }

        if ($imageFile) {
            $imagePath = $this->getParameter('kernel.project_dir') . '/public/uploads/images/' . $imageFile;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        parent::deleteEntity($entityManager, $entityInstance);
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
