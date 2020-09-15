<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\User;
use App\Entity\Shipping;
use App\Form\ShippingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\RouterInterface;

class ShippingController extends AbstractController
{
    /**
     * @Route("/shipping", name="shipping")
     */
    public function index(Request $request)
    {
		$entityManager = $this->getDoctrine()->getManager();
		$shipping = new Shipping();
		$form = $this->createForm(ShippingType::class , $shipping);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid())
		{
			$shippingPostData = $form->get('mobile_number')->getData();
			if ($shippingPostData)
			{	
				$user = $entityManager->getRepository(User::class)->find($request->getSession()->get('user_id'));
				$shipping->setUser($user);
				$entityManager->persist($shipping);
				$entityManager->flush();
				return $this->redirect('/order/details');
			}
		}
        return $this->render('shipping/index.html.twig', ['form' => $form->createView()]);
    }
}
