<?php

namespace Rezo\Bundle\BlogBundle\Controller;

use Rezo\Bundle\BlogBundle\Entity\Post;
use Rezo\Bundle\BlogBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{

    public function viewAction(Post $post)
    {
        return $this->render(
            'BlogBundle:Post:view.html.twig',
            array(
                'post' => $post,
            )
        );
    }

    public function addAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $post = new Post();
        $form = $this->createForm(new PostType(), $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($post);
            $em->flush();

            $this->addFlash('info', 'Ajout effectué');
        }

        $posts = $em->getRepository("BlogBundle:Post")->findAll();

        return $this->render(
            'BlogBundle:Post:edit.html.twig',
            array(
                'form' => $form->createView(),
                'action' => "Add",
                'posts' => $posts,
            )
        );
    }

    public function editAction(Post $post, Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new PostType(), $post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($post);
            $em->flush();

            $this->addFlash('info', 'Edition effectuée');
        }

        $posts = $em->getRepository("BlogBundle:Post")->findAll();

        return $this->render(
            'BlogBundle:Post:edit.html.twig',
            array(
                'form' => $form->createView(),
                'action' => "Edit",
                'id' => $id,
                'posts' => $posts,
            )
        );

    }

    public function deleteAction($id)
    {

    }
}
