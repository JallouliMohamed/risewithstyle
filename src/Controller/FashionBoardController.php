<?php


namespace App\Controller;


use App\Entity\Fashionboard;
use App\Entity\Product;
use App\Entity\Quiz;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FashionBoardController extends AbstractController
{
    public function manageFashionBoard()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $fashionBoards = $this->getDoctrine()->getRepository(Fashionboard::class)->getUsers();
        $entityManager = $this->getDoctrine()->getManager();
        $colors = $entityManager->getRepository(Product::class)->findUniqueColors();
        return $this->render('backOffice/manageFashionBoard.html.twig',[
                "fashionBoards" => $fashionBoards, "products" => $products,"colors"=>$colors
            ]
        );
    }
    public function updateFashionBoard(Request $request,\Swift_Mailer $mailer)
    {
        $user_id = $request->get('user');
        $products_id = $request->get('products');
        $adminValidation = $request->get('adminValidation');
        $entityManager = $this->getDoctrine()->getManager();
        $user=$this->getDoctrine()->getRepository(User::class)->find($user_id);
        $products =array();
        $fashionBoard = $this->getDoctrine()->getRepository(Fashionboard::class)->findByUser($user);
        for ($index = 0; $index < count($products_id); $index++){
            $a =$entityManager->getRepository(Product::class)->find( $products_id[$index]);
            array_push($products,$a);
        }/*
        $collection = new ArrayCollection($products);
        $fashionBoard[0]->setProducts($collection);
        $fashionBoard[0]->setAdminValidation($adminValidation);
        $entityManager->
        $entityManager->flush();

        return $this->redirect($this->generateUrl('manageBundle'));*/
        $collection = new ArrayCollection($products);
        $fashionBoard[0]->setProducts($collection);
        $fashionBoard[0]->setAdminValidation($adminValidation);
        $entityManager->persist($fashionBoard[0]);
        $entityManager->flush();

        return new JsonResponse($products);
    }
    public function getQuizByfashionBoard(Request $request)
    {
        $fashionBoard_id = $request->get('id');

        $fashionBoard = $this->getDoctrine()->getRepository(Fashionboard::class)->find($fashionBoard_id);
        $entityManager = $this->getDoctrine()->getManager();
        $quiz=$entityManager->getRepository(Quiz::class)
            ->findByfashionboardid($fashionBoard);
        /*$entityManager = $this->getDoctrine()->getManager();
        $quiz =$entityManager->getRepository(Quiz::class)
            ->findByUserAndFashionBoard($user_id,$fashionBoard[0]->getId());
        $products =array();
        for ($index = 0; $index < count($quiz); $index++) {
            array_push($products, $quiz[$index]->getQuestionid(),$quiz[$index]->getResponseid());
        }*/
        return new JsonResponse($quiz);
    }
    public function getQuizByUser(Request $request)
    {
        $user_id = $request->get('user');
        $fashionBoard = $this->getDoctrine()->getRepository(Fashionboard::class)->findByUser($user_id);
        $entityManager = $this->getDoctrine()->getManager();
        $quiz =$entityManager->getRepository(Quiz::class)
            ->findByUserAndFashionBoard($user_id,$fashionBoard[0]->getId());
        $products =array();
        for ($index = 0; $index < count($quiz); $index++) {
            array_push($products, $quiz[$index]->getQuestionid(),$quiz[$index]->getResponseid());
        }
        return new JsonResponse($products);
    }

    public function listFashionBoard()
    {
        $fashionBoards = $this->getDoctrine()->getRepository(Fashionboard::class)->findAll();
        return $this->render('backOffice/listFashionBoard.html.twig', [
            "fashionBoards" => $fashionBoards,
        ]);

    }
}