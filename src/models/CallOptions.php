<?php

namespace undefinedstudio\MusicBrainz\models;

use ReflectionClass;
use Exception;

class CallOptions
{
    public $queryParamenters = [];
    public $authRequired = false;
    private $_username = null;
    private $_password = null;

    public function setQueryParameters($parameters)
    {
        if (!is_array($parameters)) {
            throw new Exception("Query parameters must be an array of strings ('key' => 'value').");
        }
        foreach ($parameters as $key => $value) {
            $this->setQueryParameter($key, $value);
        }
        return $this;
    }

    public function setQueryParameter($key, $value)
    {
        if (!is_string($key) || !is_string($value)) {
            throw new Exception("Query parameter key and value must be strings.");
        }
        $this->queryParamenters[$key] = $value;
        return $this;
    }

    public function getQueryParameters()
    {
        return $this->queryParamenters;
    }

    public function getQueryParameter($key, $defaultValue = null)
    {
        if (isset($this->queryParamenters[$key])) {
            return $this->queryParamenters[$key];
        }
        if (is_null($defaultValue)) {
            throw new Exception("Query parameter '" . $key . "' is not defined and no default value is given.");
        }
        return $default;
    }

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

    public function setHttpAuth($username, $password)
    {
        if (empty($username) || empty($password)) {
            throw new Exception("Both username and password are required in the authorization process.");
        }
        $this->_username = $username;
        $this->_password = $password;
        return $this;
    }

    public function getHttpAuth()
    {
        if (!$this->isHttpAuthDoable()) {
            throw new Exception("Authorization not possibile with given info.");
        }
        return [$this->_username, $this->_password, 'digest'];
    }

    public function isAuthRequired()
    {
        return $this->authRequired === true ? true : false;
    }

    public function isHttpAuthDoable()
    {
        return !empty($this->_username) && !empty($this->_password);
    }
}