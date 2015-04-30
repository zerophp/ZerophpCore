<?php
namespace acl\ZerophpCore;

class Config
{
 
    public static $config;

    static public function readConfig($config)
    {
        $configmodule = self::readModules($config);

        
        $globalFile = ROOT_PATH.'/configs/global.php';
        $localFile = ROOT_PATH.'/configs/local.php';
        
        if(!file_exists($globalFile))
            die("No existe el archivo de configuracion");
        
        if(file_exists($localFile))
        {
            $globalFile = include $globalFile;
            $localFile = include $localFile;
            $config = array_merge($globalFile,$localFile);
            
            
            $config['Module']=$configmodule;
            self::$config = $config;
            return $config;        
        }
        else
        {
            $globalFile = include $globalFile;
            
            $globalFile['Module']=$configmodule;
            self::$config = $globalFile;
            return $globalFile;
        } 
    }
    
    static function readModules($config)
    {
        $config = include ($config);
        
        
        $configmodule=[];
        
           foreach ($config as $module)
           {
                $globalfile = ROOT_PATH."/configs/autoload/".$module.".global.php";
                if(file_exists($globalfile))
                    $globalfile = include (ROOT_PATH."/configs/autoload/".$module.".global.php");
               
                $localfile = ROOT_PATH."/configs/autoload/".$module.".local.php";
                if(file_exists($localfile))
                    $localfile = include (ROOT_PATH."/configs/autoload/".$module.".local.php");
               
      
                if(is_array($localfile))
                    $configmodule[$module] = array_merge($globalfile,$localfile);
                else if(is_array($globalfile))
                    $configmodule[$module] = $globalfile;
               
               
                
           }
           
           return $configmodule;
    }

}
