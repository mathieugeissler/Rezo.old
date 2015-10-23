<?php

namespace Rezo\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository("BlogBundle:Post")->findAll();

        return $this->render('BlogBundle:Default:index.html.twig', array(
            'posts' => $posts,
        ));
    }

}
