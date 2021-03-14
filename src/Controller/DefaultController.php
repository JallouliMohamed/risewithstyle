<?php

namespace App\Controller;
use App\Entity\Fashionboard;
use App\Entity\Product;
use App\Entity\Quiz;
use App\Form\ProductType;
use Braintree\Gateway;
use Braintree\Transaction;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use App\Entity\Fashionbundle;
use App\Entity\Order;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Yoeunes\Notify\Notifiers\Toastr;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="default")
     */
    public function index(SessionInterface $session)
    {
        if ($session->has('route')){
            if ($session->get('route')=='formule'){
                $session->remove('route');
                return $this->redirectToRoute('formule');

            }else {
                //redirecti lehne lel admin bel role

                return $this->render('default/baseAdmin.html.twig', [
                    'controller_name' => 'DefaultController',
                ]);
            }
        }
        $user=$this->container->get('security.authorization_checker');
        if (($user->isGranted('ROLE_ADMIN'))){
            return $this->render('backOffice/dashboard.html.twig');
        }
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    public function formule()
    {
        $fashionbundle = $this->getDoctrine()->getRepository(Fashionbundle::class)->findAll();
        return $this->render('default/formule.html.twig',array(
                'fashionbundle' => $fashionbundle
            )
        );
    }
    public function userProfile()
    {
        $boards=$this->getDoctrine()->getRepository(Fashionboard::class)->findBy(['user'=>$this->getUser()]);
        return $this->render('default/profile.html.twig',array(
            'boards' => $boards
        ));
    }
    public function purchase(SessionInterface $session,Request $request)
    {    $idbundle=$request->get('idbundle');

        $em = $this->getDoctrine()->getManager();
        $bundle = $this->getDoctrine()->getManager()->getRepository('App:Fashionbundle')->find($idbundle);
        $usr=$this->getUser();

        if ($usr==null){
            $session->set('route', 'formule');
            return $this->redirectToRoute('fos_user_security_login');
        }else{
            $gateway=new Gateway([
                'environment' => 'sandbox',
                'merchantId' => 'rfszkvmy9dny63w8',
                'publicKey' => '6m896hfk35jdcmtr',
                'privateKey' => 'c4c2da6f784477ef1879aa88274c2583'
            ]);
            return $this->render('default/purchase.html.twig',['gateway'=>$gateway->clientToken()->generate(),'bundle'=>$bundle]);
            }


        }

    public function updateuser(SessionInterface $session,Request $request)
    {
        $usr=$this->getUser();
        var_dump($request->request->get('firstname'));
        if ($request->request->get('email')!=null){
            $usr->setEmail($request->request->get('email'));

        }
        $usr->setFirstname($request->request->get('firstname'));
        $usr->setLastname($request->request->get('firstname'));
        $usr->setPhonenumber($request->request->get('phone'));
        $usr->setAddress($request->request->get('city'));
        $usr->setState(true);
        $this->getDoctrine()->getManager()->persist($usr);
        $this->getDoctrine()->getManager()->flush();
        return new JsonResponse('success');
    }

    public function manageBundle()
    {
        return $this->render('backOffice/manageBundles.html.twig');

    }

    public function addBundle()
    {
        return $this->render('backOffice/addBundle.html.twig'
        );

    }
    public function manageProducts()
    {
        return $this->render('backOffice/manageBundles.html.twig');

    }
    public function addProduct()
    {
        return $this->render('backOffice/addProduct.html.twig');
    }
    public function listFashionBoard()
    {
        return $this->render('backOffice/manageBundles.html.twig');

    }
    public function manageFashionBoard()
    {
        return $this->render('backOffice/manageFashionBoard.html.twig'
        );

    }
    public function manageOrders()
    {
        return $this->render('backOffice/manageBundles.html.twig');

    }
    public function manageQuiz()
    {
        return $this->render('backOffice/manageBundles.html.twig'
        );

    }
    public function addQuiz()
    {
        return $this->render('backOffice/addBundle.html.twig');

    }
    public function viewDashboard()
    {
        return $this->render('backOffice/dashboard.html.twig');

    }
    public function newProduct(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                //$safeFilename = $slugger->slug($originalFilename);
                // SluggerInterface $slugger
                $safeFilename = "test";
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $product->setBrochureFilename($newFilename);
            }

            // ... persist the $product variable or any other work

            return $this->redirect($this->generateUrl('manageProduct'));
        }

        return $this->render('backOffice/addProduct.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    public function wardropfashionboard()
    {
        $activatedboards=$this->getDoctrine()->getRepository(Fashionboard::class)->findBy(['user'=>$this->getUser(),'clientActivation'=>1]);

        $boards=$this->getDoctrine()->getRepository(Fashionboard::class)->findBy(['user'=>$this->getUser()]);
        return $this->render('default/fashionboard.html.twig',array(
            'boards' => $boards,
            'nbboards'=>sizeof($boards),
            'nbactivatedboards'=>sizeof($activatedboards)
        ));
    }
    public function activationfasionboard(){


            $response = JsonResponse::fromJsonString('{ "message": "https://localhost:8000/quiz" }');
            return $response;

    }
    public function quizAnswer(Request $request){
        return $this->render('default/quiz.html.twig');
    }
    public function submitquiz(Request $request){
        $result=json_decode($request->request->get('values'), true);
        $activatedboards=$this->getDoctrine()->getRepository(Fashionboard::class)->findOneBy(['user'=>$this->getUser(),'clientActivation'=>0]);

        if($activatedboards!=null){

            $activatedboards->setClientActivation(1);
            $this->getDoctrine()->getManager()->persist($activatedboards);

            foreach ($result as $key => $value){
                var_dump($value);

                $quiz = new Quiz();
            $quiz->setUser($this->getUser());
                $quiz->setFashionboardid($activatedboards);
                $quiz->setQuestionid($value['question']);
                $quiz->setResponseid($value['answer']);


                $this->getDoctrine()->getManager()->persist($quiz);

                $this->getDoctrine()->getManager()->flush();



            }

        }
        $arr=['message'=>'success'];
        return $this->render('default/quiz.html.twig');

    }
    public function addQuizVersion(Request $request){
        $s = $request->get('flexRadioDefault',0)[0];
        $k = $request->get('flexRadioDefault1',0)[0];
        $look = $request->get('flexRadioDefault2',0)[0];
        $sexy = $request->get('sexy');
        $glamour = $request->get('glamour');
        $casual = $request->get('casual');
        $chic = $request->get('chic');
        $trendy = $request->get('trendy');
        $sport = $request->get('sport');
        $questions=['how do you identify','pointure chaussures','les hauts','les bas','Quel est votre type de morphologie ?',
            $request->get('flexRadioDefault2',0)[0],'Laquelles de ces marques vous préférez pour faire votre shopping?'
        ];
        $activatedboards=$this->getDoctrine()->getRepository(Fashionboard::class)->findOneBy(['user'=>$this->getUser(),'clientActivation'=>0]);
        $chaussure = $request->get('chaussure');
        $haut = $request->get('haut');
        $bas = $request->get('bas');
        $marques=['adidas','bershka','boohoo','calvinklein','chloe','coach','fendi','forever21','gap','gucci','hermes','jennyfer','mango','maxmara','tommy','zara'];
        $look=['casual', 'chic', 'sport', 'trendy','sexy','glamour'];

        $quiz = new Quiz();
        $quiz->setUser($this->getUser());
        $quiz->setFashionboardid($activatedboards);
        $quiz->setQuestionid($questions[0]);
        $quiz->setResponseid($s);
        $this->getDoctrine()->getManager()->persist($quiz);
        $this->getDoctrine()->getManager()->flush();

        $quiz = new Quiz();
        $quiz->setUser($this->getUser());
        $quiz->setFashionboardid($activatedboards);
        $quiz->setQuestionid($questions[1]);
        $quiz->setResponseid($chaussure);
        $this->getDoctrine()->getManager()->persist($quiz);
        $this->getDoctrine()->getManager()->flush();

        $quiz = new Quiz();
        $quiz->setUser($this->getUser());
        $quiz->setFashionboardid($activatedboards);
        $quiz->setQuestionid($questions[2]);
        $quiz->setResponseid($haut);
        $this->getDoctrine()->getManager()->persist($quiz);
        $this->getDoctrine()->getManager()->flush();

        $quiz = new Quiz();
        $quiz->setUser($this->getUser());
        $quiz->setFashionboardid($activatedboards);
        $quiz->setQuestionid($questions[3]);
        $quiz->setResponseid($bas);
        $this->getDoctrine()->getManager()->persist($quiz);
        $this->getDoctrine()->getManager()->flush();

        $quiz = new Quiz();
        $quiz->setUser($this->getUser());
        $quiz->setFashionboardid($activatedboards);
        $quiz->setQuestionid($questions[4]);
        $quiz->setResponseid($k);
        $this->getDoctrine()->getManager()->persist($quiz);
        $this->getDoctrine()->getManager()->flush();

        $quiz = new Quiz();
        $quiz->setUser($this->getUser());
        $quiz->setFashionboardid($activatedboards);
        $quiz->setQuestionid($questions[5]);
        $tmp="";
        foreach($look as $i){
            $tb=$request->get($i);
            if ($tb != null){
                $tmp= $tmp . $tb .";";
            }
        }
        $quiz->setResponseid($tmp);
        $this->getDoctrine()->getManager()->persist($quiz);
        $this->getDoctrine()->getManager()->flush();


        $quiz = new Quiz();
        $quiz->setUser($this->getUser());
        $quiz->setFashionboardid($activatedboards);
        $quiz->setQuestionid($questions[5]);
        $tmp="";
        foreach($marques as $i){
            $tb=$request->get($i);
            if ($tb != null){
                $tmp= $tmp . $tb .";";
            }
        }
        $quiz->setResponseid($tmp);
        $this->getDoctrine()->getManager()->persist($quiz);
        $this->getDoctrine()->getManager()->flush();
        $activatedboards->setClientActivation(1);
        $this->getDoctrine()->getManager()->persist($activatedboards);

        $this->getDoctrine()->getManager()->flush();


        $activatedboards=$this->getDoctrine()->getRepository(Fashionboard::class)->findBy(['user'=>$this->getUser(),'clientActivation'=>1]);

        $boards=$this->getDoctrine()->getRepository(Fashionboard::class)->findBy(['user'=>$this->getUser()]);
        return $this->render('default/fashionboard.html.twig',array(
            'boards' => $boards,
            'nbboards'=>sizeof($boards),
            'nbactivatedboards'=>sizeof($activatedboards)
        ));
    }
    public function viewActivatedFashionBoard(Request $request){
        $activatedboards=new Fashionboard();
        $activatedboards=$this->getDoctrine()->getRepository(Fashionboard::class)->find($request->get('id'));

        return $this->render('default/fashionboardproduct.html.twig',["fashionboard"=>$activatedboards]);
    }
    public function viewSingleProduct(Request $request){
        $product=new Product();
        $product=$this->getDoctrine()->getRepository(Product::class)->find($request->get('id'));

        return $this->render('default/singleProduct.html.twig',["product"=>$product]);
    }
    public function checkoutBrainTree(Request $request){
        $amount=$request->get('amount');
        $idbundle=$request->get('bundleid');
        $bundle = $this->getDoctrine()->getManager()->getRepository('App:Fashionbundle')->find($idbundle);
        $order = new Order($bundle->getPrice());
        $paymentMethod=$request->request->get('payment_method_nonce');
        $gateway=new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'rfszkvmy9dny63w8',
            'publicKey' => '6m896hfk35jdcmtr',
            'privateKey' => 'c4c2da6f784477ef1879aa88274c2583'
        ]);
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $paymentMethod,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        if ($result->success || !is_null($result->transaction)) {
            $transaction = $result->transaction;
            $transactionid=$transaction->id;
            $transaction = $gateway->transaction()->find($transactionid);
            $transactionSuccessStatuses = [
                Transaction::AUTHORIZED,
                Transaction::AUTHORIZING,
                Transaction::SETTLED,
                Transaction::SETTLING,
                Transaction::SETTLEMENT_CONFIRMED,
                Transaction::SETTLEMENT_PENDING,
                Transaction::SUBMITTED_FOR_SETTLEMENT

            ];
            if (in_array($transaction->status, $transactionSuccessStatuses)) {
                $header = "Sweet Success!";
                $icon = "success";
                $message = "Le paiement a étè effecté avec succes veuillez consulter votre wardrobe";
                $order->setState(true);
                $order->setUser($this->getUser());
                $order->setBundle($bundle);
                for($i=0; $i<$bundle->getfashionbordern(); $i++)
                {
                    $fashionboard=new Fashionboard();
                    $fashionboard->setUser($this->getUser());
                    $fashionboard->setClientActivation(0);
                    $fashionboard->setAdminValidation(0);
                    $fashionboard->setFashionbundle($bundle);
                    $this->getDoctrine()->getManager()->persist($fashionboard);
                    $this->getDoctrine()->getManager()->flush();

                }
                $this->getDoctrine()->getManager()->persist($order);
                $this->getDoctrine()->getManager()->flush();
                return $this->render('default/purchaseConfirmed.html.twig',['header'=>$header,'icon'=>$icon,'message'=>$message]);
            } else {
                $header = "Transaction Failed";
                $icon = "fail";
                $message = "Your test transaction has a status of " . $transaction->status . ". See the Braintree API response and try again.";
                return $this->render('default/purchaseConfirmed.html.twig',['header'=>$header,'icon'=>$icon,'message'=>$message]);

            }
        } else {
            $errorString = "";
            $header = "Transaction Failed";
            $icon = "fail";
            $message="problème de paiement";


            return $this->render('default/purchaseConfirmed.html.twig',['message'=>$message,'header'=>$header]);


        }

        return null;

}
}
