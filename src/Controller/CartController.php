<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Product;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Cart;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function cart(Request $request)
    {
	$entityManager = $this->getDoctrine()->getManager();
	$cart_products =  $entityManager->getRepository(Cart::class)->findAll(['session_id'=>$request->getSession()->get('session_id')]);
	return $this->render('cart/cart.html.twig', ['cart_data'=>$cart_products,'total'=>$request->getSession()->get('TotalPrice')]);
    }
	 /** 
   * @Route("/cart/product/remove") 
	*/
    public function removeAction(Request $request)
    {
	$prod_id = $request->request->get('id');
	$entityManager = $this->getDoctrine()->getManager();
	$cart_products =  $entityManager->getRepository(Cart::class)->findOneBy(['session_id'=>$request->getSession()->get('session_id'),'product_id'=>$prod_id]);
	$result = $entityManager->remove($cart_products);
	$entityManager->flush();
	return new JsonResponse(['html' => $this->renderView('cart/cart.html.twig', ['cart_data' => $request->getSession()->get('cart')])]);
}

  /** 
   * @Route("/cart/qty/update") 
	*/

public function updateAction(Request $request)
    {
	$quantity = 0;
	$totalPrice = 0;
	$prod_id_exploded_value = explode("_",$request->request->get('id'));
	$prod_id = $prod_id_exploded_value[2];
	$entityManager = $this->getDoctrine()->getManager();
	$cart_products =  $entityManager->getRepository(Cart::class)->findOneBy(['session_id'=>$request->getSession()->get('session_id'),'product_id'=>$prod_id]);
	$cart_products->setQuantity($request->request->get('qty'));
	$entityManager->flush();
	$cart_products_all =  $entityManager->getRepository(Cart::class)->findAll(['session_id'=>$request->getSession()->get('session_id')]);
	for($i = 0; $i < count ( $cart_products_all ); $i ++) {
		
			$totalPrice +=$cart_products_all[$i]->getPrice() * $cart_products_all [$i]->getQuantity();
	}
	for($p = 0; $p < count ( $cart_products_all ); $p ++) {
		
			$cart_products_all[$p]->setTotal($totalPrice);
	}
	$entityManager->flush();
	$request->request->set('TotalPrice',$totalPrice);
	$request->getSession()->set('TotalPrice',$totalPrice);
	return new JsonResponse($request->request->get('TotalPrice'));
}
}
