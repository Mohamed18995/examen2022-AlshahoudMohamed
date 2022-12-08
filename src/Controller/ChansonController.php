<?php

namespace App\Controller;

use App\Entity\Chanson;
use App\Form\ChansonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class ChansonController extends AbstractController
{
    /**
   * @Route("/chanson/{id}/edit", name="chanson_edit")
   */
  public function edit(Request $request, PersistenceManagerRegistry $doctrine, Chanson $chanson ) 
  {
    $form = $this->createForm(ChansonType::class, $chanson);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $doctrine->getManager();
      $entityManager->persist($chanson);
      $entityManager->flush();

      return $this->redirectToRoute("afficher_chanson", ["id"=> $chanson->getId()]);

    }
    return $this->render('chanson/edit.html.twig', [
        'editForm' =>$form->createView()
    ]);
   }

    /**
    * @Route("/chanson/{id}", name="afficher_chanson")
    */
    public function afficher(Chanson $chanson) : Response
    {
      return $this->render('chanson/show.html.twig', [
       'chanson' => $chanson,
       ]);
    }

    /**
   * @Route("/create/chanson", name="chanson_create")
   */
  public function add(Request $request, PersistenceManagerRegistry $doctrine) 
  {
    $chanson= new Chanson();
    $form = $this->createForm(ChansonType::class, $chanson);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $chanson->setDateAjout(new \DateTime());
      $chanson->setDateSortie(new \DateTime());
      $chanson = $form->getData();
      $entityManager = $doctrine->getManager();
      $entityManager->persist($chanson);
      $entityManager->flush();

      return $this->redirectToRoute('app_home');

    }
    return $this->render('chanson/add.html.twig', ['form' =>$form->createView()]);
  }
}
