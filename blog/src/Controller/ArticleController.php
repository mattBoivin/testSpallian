<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Form\Type\ArticleType;

use Symfony\Component\Security\Core\Security;


class ArticleController extends AbstractController
{
    
    public function __construct(Security $security) {
        $this->security = $security;
    }
    
    /**
     * @Route("/articles", name="articles", methods={"GET"})
     */
    public function index(): Response
    {
        $user = $this->security->getUser();
        $userRoles = $user->getRoles();
        
        if (in_array('ROLE_ADMIN', $userRoles)) {
            $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        }
        else {
            $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['author' => $user->getUsername()]);
        }

        return $this->render('articles/articles.html.twig', [
            'articles' => $articles,
            'title_page' => 'Articles'
        ]);
    }
    
    /**
     * @Route("/articles/{id}", name="detail_article", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function detail(int $id): Response
    {
        $article = $this->getDoctrine()->getManager()
            ->getRepository(Article::class)
            ->getOneArticle($id);
        
        if ($article === null){
            throw new NotFoundHttpException("L'article d'id ".$id." n'a pas été trouvé");
        }

        return $this->render('articles/article.html.twig', [
            'article' => $article,
            'title_page' => 'Article'
        ]);
    }
    
    /**
     * @Route("/articles", name="delete_article", methods={"DELETE"})
     */
    public function deleteArticle(Request $request): Response
    {
        $id = $request->get('id');
        
        $entityManager = $this->getDoctrine()->getManager();
        
        $article = $entityManager
            ->getRepository(Article::class)
            ->getOneArticle($id);
        
        $response = new Response();
        
        if ($article === null){
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            throw new NotFoundHttpException("L'article d'id ".$id." n'a pas été trouvé");
        }
        else {
            $entityManager->remove($article);
            $entityManager->flush();
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
        }
        
        return $response;
    }
    
    /**
     * @Route("/articles/{id}/edit", name="edit_article", requirements={"id"="\d+"})
     */
    public function editArticle(Request $request): Response
    {
        $id = $request->get('id');
        
        $entityManager = $this->getDoctrine()->getManager();
        
        $article = $entityManager
            ->getRepository(Article::class)
            ->getOneArticle($id);
            
        if ($article === null){
            throw new NotFoundHttpException("L'article d'id ".$id." n'a pas été trouvé");
        }
        
        $form = $this->createForm(ArticleType::class, $article);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            
            $user = $this->security->getUser();
            
            $article
                ->setDate(
                    new \DateTime()
                )
                ->setAuthor($user->getUsername());
            
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('articles');
        }
        
        return $this->render('articles/edit.html.twig', [
            'form' => $form->createView(),
            'title_page' => 'Edition article'
        ]);
    }
    
    /**
     * @Route("/articles/add", name="add_article")
     */
    public function addArticle(Request $request): Response
    {
        $article = new Article();
        
        $form = $this->createForm(ArticleType::class, $article);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            
            $user = $this->security->getUser();
            
            $article
                ->setDate(
                    new \DateTime()
                )
                ->setAuthor($user->getUsername());
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('articles');
        }
        
        return $this->render('articles/edit.html.twig', [
            'form' => $form->createView(),
            'title_page' => 'Nouvel article'
        ]);
    }
}
