<?php
namespace Rezo\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Rezo\Bundle\BlogBundle\Form\PostType;
use Rezo\Bundle\BlogBundle\Entity\Post;

class AdminPostController extends Controller
{

    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);

        /*$form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setAuthor($user);
            $em->persist($post);
            $em->flush();

            $this->addFlash('info', 'Ajout effectuée');
        }

        $posts = $em->getRepository("BlogBundle:Post")->findAll();*/
        if($request->isXmlHttpRequest()) {
            var_dump($request);
        }
        return $this->render(
            'AdminBundle:Blog/Post:edit.html.twig',
            array(
                'form' => $form->createView(),
                'action' => "Add",
            )
        );
    }

    public function addAction(Request $request)
    {

    }

    public function editAction(
        Post $post,
        Request $request,
        $id
    ) {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new PostType(), $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($post);
            $em->flush();

            $this->addFlash('info', 'Edition effectuée');
        }

        $posts = $em->getRepository("BlogBundle:Post")->findAll();

        return $this->render(
            'AdminBundle:Blog/Post:edit.html.twig',
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

    public function findallAction(){
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository("BlogBundle:Post")->findAll();

        return new JsonResponse(array(
            'vue' => $this->renderView(
                'AdminBundle:Blog/Post:table.html.twig', array(
                    'posts' => $posts,
                )
            )
        ));
    }
}