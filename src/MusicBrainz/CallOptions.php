<?php

namespace MusicBrainz;

use ReflectionClass;

class CallOptions
{
    public $authRequired = false;
    public $username = null;
    public $password = null;

    public function get()
    {
        $reflectionClass = new ReflectionClass($this);
        $properties = $reflectionClass->getProperties();
        $callOptions = [];
        foreach ($properties as $property) {
            $callOptions[$property->getName()] = $property->getValue($this);
        }
        return $callOptions;
    }

    public function isAuthRequired()
    {
        return $this->authRequired === true ? true : false;
    }

    public function isHttpAuthDoable()
    {
        return !empty($this->username) && !empty($this->password);
    }
}