<?php
namespace acl\ZerophpCore;

class Config
{
 
    public static $config;

    static public function readConfig($config)
    {
        self::readModules($config);
        
        $globalFile = ROOT_PATH.'/configs/global.php';
        $localFile = ROOT_PATH.'/configs/local.php';
        
        if(!file_exists($globalFile))
            die("No existe el archivo de configuracion");
        
        if(file_exists($localFile))
        {
            $globalFile = include $globalFile;
            $localFile = include $localFile;
            $config = array_merge($globalFile,$localFile);
            
            self::$config = $config;
            return $config;        
        }
        else
        {
            $globalFile = include $globalFile;
            self::$config = $globalFile;
            return $globalFile;
        } 
    }
    
    static function readModules($config)
    {
        $config = include ($config);
        echo "<pre>";
        print_r($config);
        echo "</pre>";
        
           foreach ($config as $module)
           {
               $globalfile = ROOT_PATH."/configs/autoload/".$module.".global.php";
               if(file_exists($globalfile))
                   $globalfile = include (ROOT_PATH."/configs/autoload/".$module.".global.php");
               
               $localfile = include (ROOT_PATH."/configs/autoload/".$module.".local.php");
               
               echo "<pre>";
               print_r($configmodule);
               echo "</pre>";
               
               
           }
    }

}
