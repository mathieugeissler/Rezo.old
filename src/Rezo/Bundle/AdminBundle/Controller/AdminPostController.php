<?php
namespace Rezo\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Rezo\Bundle\BlogBundle\Form\PostType;
use Rezo\Bundle\BlogBundle\Entity\Post;

class AdminPostController extends Controller
{

    public function indexAction()
    {
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);

        return $this->render(
            'AdminBundle:Blog/Post:index.html.twig'
        );
    }

    public function editAction(Request $request, Post $post, $id)
    {
        if ($request->isXmlHttpRequest()) {

            $form = $this->createForm(
                new PostType(),
                $post,
                array(
                    'action' => $this->generateUrl(
                        'admin_blog_post_edit',
                        array(
                            'id' => $id,
                        )
                    ),
                )
            );

            $form->handleRequest($request);

            if ($form->isValid()) {
                $user = $this->getUser();
                $em = $this->getDoctrine()->getManager();
                $post->setAuthor($user);
                $em->persist($post);
                $em->flush();

                return new JsonResponse(
                    array(
                        'message' => 'Success',
                    ), 200
                );
            }

            return new JsonResponse(
                array(
                    'form' => $this->renderView(
                        'AdminBundle:Blog/Post:form.html.twig',
                        array(
                            'form' => $form->createView(),
                        )
                    ),
                )
            );
        }
        return false;
    }

    /** Return all Posts
     * @return JsonResponse
     */
    public function loadAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository("BlogBundle:Post")->findAll();

        $post = new Post();
        $form = $this->createForm(new PostType(), $post);

        return new JsonResponse(
            array(
                'table' => $this->renderView(
                    'AdminBundle:Blog/Post:table.html.twig',
                    array(
                        'posts' => $posts,
                    )
                ),
                'form' => $this->renderView(
                    'AdminBundle:Blog/Post:form.html.twig',
                    array(
                        'form' => $form->createView(),
                    )
                ),
            )
        );
    }
}