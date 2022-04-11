<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle("Ninja Attack");
        $movie->setReleaseYear(2002);
        $movie->setDescription("Awesome movie about cool ninjas");
        $movie->setImagePath("https://images.unsplash.com/photo-1630453228219-13c0a4de0e99?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80");

        $movie->addActor($this->getReference('actor_1'));
        $movie->addActor($this->getReference('actor_2'));

        $manager->persist($movie);

        $movie2 = new Movie();
        $movie2->setTitle("Samurai going to work");
        $movie2->setReleaseYear(2012);
        $movie2->setDescription("Well we all gotta work");
        $movie2->setImagePath("https://images.unsplash.com/photo-1606681547076-ba4d2f2b9f6e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80");

        $movie2->addActor($this->getReference('actor_3'));
        $movie2->addActor($this->getReference('actor_4'));


        $manager->persist($movie2);

        $manager->flush();
    }
}
