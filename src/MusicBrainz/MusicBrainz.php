<?php

namespace MusicBrainz;

use Exception;
use GuzzleHttp\Client;
use MusicBrainz\models\CallOptions;

class MusicBrainz
{
    public $wsUrl = "http://musicbrainz.org/ws/2/";

    private $_username = null;
    private $_password = null;
    private $_userAgent = null;
    /** @var Client|null */
    private $_client = null;

    public function __construct($username = null, $password = null)
    {
        if (!empty($username) && !empty($password)) {
            $this->setHttpAuth($username, $password);
        }
        $this->clientSetup();
    }

    public function clientSetup()
    {
        $this->_client = new Client();
    }

    #region Get/Set

    public function setHttpAuth($username, $password)
    {
        if (empty($username) || empty($password)) {
            throw new Exception("Both username and password are required in the authorization process.");
        }
        $this->_username = $username;
        $this->_password = $password;
    }

    public function getClient()
    {
        if (empty($this->_client)) {
            throw new Exception("Client is not initialized. Please set it using clientSetup().");
        }
        return $this->_client;
    }

    public function getWsUrl()
    {
        if (empty($this->wsUrl)) {
            throw new Exception("Web services url is not defined. Please set it using setWsUrl().");
        }
        return $this->wsUrl;
    }

    public function setWsUrl($wsUrl)
    {
        $this->wsUrl = $wsUrl;
    }

    public function setUserAgent($application, $version, $contact = null)
    {
        if (empty($application) || empty($version)) {
            throw new Exception("Application name and version are required to be present in the user agent.");
        }
        $userAgent = $application . "/" . $version;
        if (!empty($contact)) {
            $userAgent .= " (" . $contact . ")";
        } else {
            trigger_error("Including contact information in the user agent is strongly encouraged.");
        }
        $this->_userAgent = $userAgent;
    }

    public function getUserAgent()
    {
        if (empty($this->_userAgent)) {
            throw new Exception("User agent information not defined. Please set it using setUserAgent().");
        }
        return $this->_userAgent;
    }

    #endregion

    #region Validators

    public function isHttpAuthDoable()
    {
        return !empty($this->_username) && !empty($this->_password);
    }

    #endregion

    public function lookup($entityType, $mbid, $includes = [])
    {
        if (!Utilities::isValidEntityType($entityType)) {
            throw new Exception("EntityType " . $entityType . " is not valid.");
        }
        if (!Utilities::isValidMbid($mbid)) {
            throw new Exception("MusicBrainz ID " . $mbid . " is not valid.");
        }
        //TODO
        //$this->getClient()->get();
    }

    public function call($path, $query, CallOptions $options = null)
    {
        if (empty($options)) {
            $options = new CallOptions();
        }

        $clientOptions = [
            'base_uri' => $this->getWsUrl(),
            'query' => $query,
            'headers' => [
                'User-Agent' => $this->getUserAgent(),
                'Accept'     => 'application/json',
            ]
        ];

        // If authorization is required, first checks for username and password in the CallOptions object,
        // then in the main MusicBrainz object.
        // Login information should ideally always be defined in the main object, please set them in the
        // CallOptions object only to override the default behaviour.
        if ($options->isAuthRequired()) {
            if ($options->isHttpAuthDoable()) {
                $clientOptions['auth'] = [$options->username, $options->password, 'digest'];
            } elseif ($this->isHttpAuthDoable()) {
                $clientOptions['auth'] = [$this->_username, $this->_password, 'digest'];
            } else {
                throw new Exception('Authentication is required. Please set username and password.');
            }
        }
        $response = $this->getClient()->get($path, $clientOptions);
        return (string)$response->getBody();
    }
}
