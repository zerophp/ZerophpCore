<?php
namespace acl\ZerophpCore\Interfaces;

interface OptionAwareInterface
{
    public function setOptions($option);
    
    public function getOptions();
}