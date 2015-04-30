<?php
namespace acl\ZerophpCore;

class ModuleManager
{
    static public $options;
    
    static public function getInstance($modules)
    {
        $modules = include $modules;
        foreach($modules as $moduleName)
        {           
            $name = $moduleName."\\Module";             
            $options = self::getOptions(Config::$config, $moduleName);
            $module =  $name::getInstance($options);
        }  
    }
    
    static public function getOptions($config, $moduleName)
    {
        
        $moduleOptionsName = $moduleName.'\Options\ModuleOptions'; 
        if(class_exists($moduleOptionsName))
        {    
            $moduleOptions = new $moduleOptionsName();           
            if(isset($config['Module'][__NAMESPACE__]))
            {               
                $moduleConfig = $config['Module'][__NAMESPACE__];
                foreach ($moduleConfig as $key => $value)
                {
                    $set ="set".$key;
                    $moduleOptions->$set($value);
                }
            }
        }        
        else if(isset($config['Module'][__NAMESPACE__]))
        {
            $moduleOptions = $config['Module'][__NAMESPACE__];
        }
        else 
            $moduleOptions = null;
        
        return $moduleOptions;
    }
    
}