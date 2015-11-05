<?php


namespace Rezo\Bundle\AdminBundle\Controller;


use Rezo\Bundle\AdminBundle\Entity\MenuItem;
use Rezo\Bundle\AdminBundle\Form\MenuItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MenuItemController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $menuItem = new MenuItem();

        $form = $this->createForm(new MenuItemType(), $menuItem, array(
            'action' => $this->generateUrl('admin_menuitem'),
        ));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($menuItem);
            $em->flush();

            return $this->redirectToRoute('admin_menuitem');
        }

        return $this->render(
            'AdminBundle:MenuItem:index.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }
}