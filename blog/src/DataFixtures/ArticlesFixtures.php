<?php

namespace App\DataFixtures;

use App\Entity\Article;

use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\Fixture;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ArticlesFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct()
    {
        
    }

    public function load(ObjectManager $manager)
    {
        $article1 = new Article();

        $article1
            ->setTitle('article 1')
            ->setsubtitle('sous article 1')
            ->setContent('le contenu de mon article 1')
            ->setDate(
                new \DateTime()
            )
            ->setAuthor('user@contact.com')
        ;

        $manager->persist($article1);
        
        
        $article2 = new Article();

        $article2
            ->setTitle('article 2')
            ->setsubtitle('sous article 2')
            ->setContent('le contenu de mon article 2')
            ->setDate(
                new \DateTime()
            )
            ->setAuthor('user@contact.com')
        ;

        $manager->persist($article2);
        
        $article3 = new Article();

        $article3
            ->setTitle('article 3')
            //->setsubtitle('sous article 3')
            ->setContent('le contenu de mon article 3')
            ->setDate(
                new \DateTime()
            )
            ->setAuthor('user2@contact.com')
        ;

        $manager->persist($article3);

        $manager->flush();
    }
}
