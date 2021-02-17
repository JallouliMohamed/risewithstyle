<?php
namespace App\Controller;
use App\Entity\Fashionbundle;
use App\Form\FashionBundleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FashionBundleController extends AbstractController
{
    public function addBundle(Request $request)
    {
        $fashionBundle = new Fashionbundle();
        $form = $this->createForm(FashionBundleType::class, $fashionBundle);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fashionBundle = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fashionBundle);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('manageBundle'));
        }
        return $this->render('backOffice/addBundle.html.twig', [
            "form_title" => "Ajouter un paquet",
            'form' => $form->createView(),
        ]);

    }
    public function manageBundle()
    {
        $fashionBundles = $this->getDoctrine()->getRepository(Fashionbundle::class)->findAll();
        return $this->render('backOffice/manageBundles.html.twig', [
            "fashionBundles" => $fashionBundles,
        ]);

    }
    public function updateBundle(Request $request,int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $fashionBundle = $entityManager->getRepository(Fashionbundle::class)->find($id);
        $form = $this->createForm(FashionBundleType::class, $fashionBundle);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirect($this->generateUrl('manageBundle'));
        }
        return $this->render('backOffice/addBundle.html.twig', [
            "form_title" => "Modifier un paquet",
            'form' => $form->createView(),
        ]);

    }
    public function deleteFashionBUndle(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $fashionBundle = $entityManager->getRepository(Fashionbundle::class)->find($id);
        $entityManager->remove($fashionBundle);
        $entityManager->flush();
        return $this->redirectToRoute("manageBundle");
    }
}