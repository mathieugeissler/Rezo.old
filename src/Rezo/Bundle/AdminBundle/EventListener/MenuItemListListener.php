<?php


namespace Rezo\Bundle\AdminBundle\EventListener;

use Avanzu\AdminThemeBundle\Model\MenuItemModel;
use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Symfony\Component\HttpFoundation\Request;

class MenuItemListListener
{

    public function onSetupMenu(SidebarMenuEvent $event) {

        $request = $event->getRequest();

        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }

    }

    protected function getMenu(Request $request) {
        // Build your menu here by constructing a MenuItemModel array
        $rarg = array();
        $menuItems = array(
            // Menu Item
            $menuitem = new MenuItemModel('menuitem', 'Menu Items', 'admin_menuitem', $rarg, 'fa fa-dashboard'),

            // Admin Blog
            $blog = new MenuItemModel('blog', 'Blog', '', $rarg, 'fa fa-dashboard'),
            $blog->addChild(new MenuItemModel('blog_posts', 'Posts', 'admin_blog_post', $rarg, 'fa fa-dashboard')),

        );

        return $this->activateByRoute($request->get('_route'), $menuItems);
    }

    protected function activateByRoute($route, $items) {

        foreach($items as $item) {
            if($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            }
            else {
                if($item->getRoute() == $route) {
                    $item->setIsActive(true);
                }
            }
        }

        return $items;
    }

}

