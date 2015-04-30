<?php
namespace acl\ZerophpCore;

class Hydrator
{
   
    public function extract($entity)
    {
        $array=array();
        foreach($entity as $key => $value)
        {
            $array[$key]=$value;
        }   
        return $array;
    }
    
    public function hydrate($data, $entity)
    {
        
        foreach($entity as $key => $value)
        {
            $entity->$key = $data[$key];
        }
        return $entity;  // Hydrated
    }
    
    public function hydrateC($data, $collection)
    {
        $entityName =get_parent_class($collection);        
        foreach ($data as $element)
        {
            $entity = new $entityName();
            $currentEntity = $this->hydrate($element, $entity);
            $id = $currentEntity->iduser;
            $collection->$id = $currentEntity;
        }
        return $collection;
    }
    
}