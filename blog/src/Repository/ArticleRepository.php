<?php

namespace App\Repository;

use App\Entity\Article;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, TokenStorageInterface $tokenStorage)
    {
        parent::__construct($registry, Article::class);
        
        $this->tokenStorage = $tokenStorage;
    }
    
    public function getOneArticle(int $id) {
        //$user = $this->container->security->getUser();
        $user = $this->tokenStorage->getToken()->getUser();
        $userRoles = $user->getRoles();
        
        if (in_array('ROLE_ADMIN', $userRoles)) {
            $article = $this->find($id);
        }
        else {
            $article = $this->findOneBy(['author' => $user->getUsername(), 'id' => $id]);
        }
        
        return $article;
    }
}
