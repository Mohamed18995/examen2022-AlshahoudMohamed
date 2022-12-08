<?php

namespace App\Controller;

use App\Entity\Chanson;
use App\Entity\Genre;
use App\Form\GenreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

class GenreController extends AbstractController
{
    //afficher des genres
    #[Route('/genre', name: 'genre')]
    public function index(EntityManagerInterface $entityManager): Response
    {

      $genres = $entityManager->getRepository(Genre::class)->findAll();


        return $this->render('genre/index.html.twig', [
            'genres' => $genres,
        ]);
    }

    //afficher un genre

    /**
    * @Route("/genre/{id}", name="afficher_genre")
    */
    public function afficher($id, EntityManagerInterface $entityManager) : Response
    {
      $repository = $entityManager->getRepository(Chanson::class);
      $chansons = $repository->findBy(["genre" => $id]);

      return $this->render('home/index.html.twig', [
       'chansons' => $chansons,
       ]);
    }

    /**
   * @Route("/create/genre", name="genre_create")
   */
  public function add(Request $request, PersistenceManagerRegistry $doctrine) 
  {
    $genre = new Genre();
    $form = $this->createForm(GenreType::class, $genre);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $genre = $form->getData();
      $entityManager = $doctrine->getManager();
      $entityManager->persist($genre);
      $entityManager->flush();

      return $this->redirectToRoute('genre');

    }
    return $this->render('genre/AddGenre.html.twig', ['form' =>$form->createView()]);
  }
}
