<?php

namespace App\Controller;

use App\Entity\Chanson;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
   * @Route("/", name="app_home")
   */
  public function getAllChansons(EntityManagerInterface $entityManager){
    $repository = $entityManager->getRepository(Chanson::class);
    $chansons = $repository->findAll();

    return $this->render('home/index.html.twig', [
        'chansons' => $chansons,
    ]);
  }
}
