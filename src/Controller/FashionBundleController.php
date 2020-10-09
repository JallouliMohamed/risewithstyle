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
        return $this->render('backOffice/addBundle.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}