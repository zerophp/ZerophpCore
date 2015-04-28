<?php
namespace acl\ZerophpCore;

class Config
{
 
    public static $config;

    static public function readConfig($config)
    {
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

}
