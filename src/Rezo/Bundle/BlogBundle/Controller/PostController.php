<?php

namespace Rezo\Bundle\BlogBundle\Controller;

use Proxies\__CG__\Rezo\Bundle\UserBundle\Entity\User;
use Rezo\Bundle\BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
