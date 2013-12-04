<?php

namespace Vadim\GuestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vadim\GuestBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vadim\GuestBundle\Form\Type\PostType;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $post = new Post();

        $form =$this->createForm(new PostType(), $post);

        $form->handleRequest($request);

        if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();

                return $this->redirect($this->generateUrl('vadim_create'));
        }

        return $this->render('VadimGuestBundle:Default:index.html.twig', array(
            'form' => $form->createView(), ));
    }

    public function createAction()
    {

        return new Response('Show product id  product name ');
    }
}
