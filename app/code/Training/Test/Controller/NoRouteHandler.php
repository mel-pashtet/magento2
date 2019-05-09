<?php
/**
 * Created by PhpStorm.
 * User: pavelmelnichuk
 * Date: 5/9/19
 * Time: 7:35 PM
 */

namespace Training\Test\Controller;


class NoRouteHandler extends \Magento\Framework\App\Router\NoRouteHandlerList
{
    public function process(\Magento\Framework\App\RequestInterface $request)
    {
        $moduleName = 'cms';
        $controllerPath = 'index';
        $controllerName = 'index';
        $request->setModuleName($moduleName)
            ->setControllerName($controllerPath)
            ->setActionName($controllerName);
        return true;
    }

}