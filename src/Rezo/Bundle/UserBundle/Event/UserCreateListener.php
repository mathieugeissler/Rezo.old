<?php


namespace Rezo\Bundle\UserBundle\Event;


use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserCreateListener implements EventSubscriberInterface
{

    protected $em;
    protected $user;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSucces',
        );
    }

    public function onRegistrationSucces(FormEvent $event)
    {
        $this->user = $event->getForm()->getData();
        $group_name = 'User';
        $entity = $this->em->getRepository('UserBundle:Group')->findOneByName($group_name);
        $this->user->addGroup($entity);
        $this->em->flush();
    }
}