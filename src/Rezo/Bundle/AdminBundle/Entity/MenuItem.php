<?php

namespace Rezo\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MenuItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MenuItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label_name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $labelName;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $route;

    /**
     * @var array
     *
     * @ORM\Column(name="routeArgs", type="array")
     */
    private $routeArgs;

    /**
     * @var integer
     *
     * @ORM\Column(name="children", type="integer")
     */
    private $children;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent", type="integer")
     */
    private $parent;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=255)
     */
    private $icon;

    /**
     * @var boolean
     *
     * @ORM\Column(name="badge", type="boolean")
     */
    private $badge;

    /**
     * @var string
     *
     * @ORM\Column(name="badgeColor", type="string", length=255)
     */
    private $badgeColor;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set labelName
     *
     * @param string $labelName
     *
     * @return MenuItem
     */
    public function setLabelName($labelName)
    {
        $this->labelName = $labelName;

        return $this;
    }

    /**
     * Get labelName
     *
     * @return string
     */
    public function getLabelName()
    {
        return $this->labelName;
    }

    /**
     * Set route
     *
     * @param string $route
     *
     * @return MenuItem
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set routeArgs
     *
     * @param array $routeArgs
     *
     * @return MenuItem
     */
    public function setRouteArgs($routeArgs)
    {
        $this->routeArgs = $routeArgs;

        return $this;
    }

    /**
     * Get routeArgs
     *
     * @return array
     */
    public function getRouteArgs()
    {
        return $this->routeArgs;
    }

    /**
     * Set children
     *
     * @param integer $children
     *
     * @return MenuItem
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Get children
     *
     * @return integer
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param integer $parent
     *
     * @return MenuItem
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return MenuItem
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set badge
     *
     * @param boolean $badge
     *
     * @return MenuItem
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * Get badge
     *
     * @return boolean
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * Set badgeColor
     *
     * @param string $badgeColor
     *
     * @return MenuItem
     */
    public function setBadgeColor($badgeColor)
    {
        $this->badgeColor = $badgeColor;

        return $this;
    }

    /**
     * Get badgeColor
     *
     * @return string
     */
    public function getBadgeColor()
    {
        return $this->badgeColor;
    }
}

