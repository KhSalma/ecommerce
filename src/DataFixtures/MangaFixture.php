<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Manga;
use App\Entity\Category;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MangaFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $categories = [];

        for ($i = 0; $i < 6; $i++) {
            $category = new Category();
            $category
                ->setName($faker->words(1,true))
                ->setDescriptiveText($faker->paragraphs($nb = 2, $asText = true))
                ->setImage($faker->imageUrl($width = 640, $height = 480));

            $manager->persist($category);
            $categories[] = $category;
        }
        for ($i = 0; $i < 20; $i++)
        {
            $manga = new Manga();
            $manga
                ->setTitle($faker->words(3,true))
                ->setShortDescription($faker->sentences(3,true))
                ->setLongDescription($faker->paragraphs($nb = 2, $asText = true))
                ->setMainImage($faker->imageUrl($width = 640, $height = 480))
                ->setSecondary1Image($faker->imageUrl($width = 640, $height = 480))
                ->setSecondary2Image($faker->imageUrl($width = 640, $height = 480))
                ->setPrice($faker->numberBetween(10,150))
                ->setCategories($faker->randomElements($categories));;

            $manager->persist($manga);
            for ($j = 0; $j < mt_rand(0, 4); $j++) {
                $reviews = new Review();
                $reviews
                    ->setUsername($faker->name)
                    ->setEmail($faker->email)
                    ->setComment($faker->paragraphs($nb = 2, $asText = true))
                    ->setCreatedAt(new \DateTime())
                    ->setManga($manga);

                $manager->persist($reviews);
            }
        }
        

        $manager->flush();
    }
}
