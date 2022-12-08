<?php

namespace App\DataFixtures;

use App\Entity\Chanson;
use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChansonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i <7; $i++){
            $genre = new Genre();
            $genre->setNom("chanson $i");
            $genre->setDescription("Le contenu $i");

            $manager->persist($genre);

            for($j=1; $j <=2 ; $j++){
                $chanson = new Chanson();
                $chanson ->setTitre("chanson $j")
                   ->setNomAlbum("Album1 $j")
                   ->setParoles("Le Lorem u faux texte la composition et la mise en page avant impression.")
                   ->setAuteur("Alemien $j")
                   ->setDateAjout(new \DateTime())
                   ->setDateSortie(new \DateTime("10/10/2015"))
                   ->setGenre($genre);

                $manager->persist($chanson);
            }
            $manager->flush();
        }
        $manager->flush();
    }
}
