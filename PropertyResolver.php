<?php

include 'ResolvedProperty.php';

class PropertyResolver
{
    public function resolve($object, $propertyPath)
    {
        $parts = $this->getParts($propertyPath);
        $property = null;
        $key = null;
        $failed = false;
        foreach($parts as $part) {
    
            if (null !== $key && array_key_exists($key, $object->{$property}) && is_object($object->{$property}[$key])) {
                $object = $object->{$property}[$key];
                $property = null;
                $key = null;
            }
    
            if (null !== $property && is_object($object->{$property})) {
                $object = $object->{$property};
                $property = null;
            }
    
            if (null !== $property && is_array($object->{$property}) && array_key_exists($part, $object->{$property})) {
                $key = $part;
                continue;
            }
    
            if (property_exists($object, $part)) {
                $property = $part;
            } else {
                $failed = true;
            }
        }  
        
        return $failed ? null : $this->buildResult($object, $property, $key);
    }
    
    protected function getParts($propertyPath)
    {
        $matches = [];
        preg_match_all('/(\w+)/', $propertyPath, $matches);
        
        return $matches[0];
    }
    
    protected function buildResult($object, $property, $key)
    {
        $result = new ResolvedProperty;
        $result->object = $object;
        $result->property = $property;
        $result->key = $key;
        $result->value = $key ? $object->{$property}[$key] : $object->{$property};
        
        return $result;
    }
}

