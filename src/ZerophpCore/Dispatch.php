<?php
namespace acl\ZerophpCore;

use acl\ZerophpCore\Interfaces\OptionAwareInterface;

class Dispatch
{
    static function dispatch($request)
    {        
        $className = $request['module']."\\Controller\\".$request['controller'];
        $controller = new $className();
        if($controller instanceof  OptionAwareInterface)
        {   
            $moduleName = $request['module']."\\Module";
            $module = $moduleName::getInstance();
            $options = $module->getOptions();
            $controller->setOptions($options);
        }
        $content  = $controller->$request['action']();
        
        return array('layout'=>$controller->layout, 
                     'content'=> $content
                    );       
    }
}