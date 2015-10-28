<?php
namespace Rezo\Bundle\UserBundle\Controller;

use Rezo\Bundle\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class UserController extends Controller
{

    public function indexAction(User $user)
    {
        if(is_null($user)) {
            $user = $this->getUser();
        }
        dump($user->getRoles());
        return $this->render('UserBundle:User:index.html.twig', array(
            'user' => $user,
        ));
    }

}