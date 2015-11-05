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

        if($request->isXmlHttpRequest()) {
            $form->handleRequest($request);

            $post->setAuthor($user->getId());

            $em->persist($post);
            $em->flush();

            return new JsonResponse($post);
        }

        return $this->render(
            'AdminBundle:Blog/Post:edit.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }


    /** Return all Posts
     * @return JsonResponse
     */
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