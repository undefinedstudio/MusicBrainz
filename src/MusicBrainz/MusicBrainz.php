<?php

namespace MusicBrainz;

use Exception;
use GuzzleHttp\Client;
use MusicBrainz\models\BrowseResponse;
use MusicBrainz\models\CallOptions;
use MusicBrainz\models\EntityType;
use MusicBrainz\models\Includes;
class MusicBrainz
{
    public $wsUrl = "http://musicbrainz.org/ws/2/";

    private $_username = null;
    private $_password = null;
    private $_userAgent = null;
    /** @var Client|null */
    private $_client = null;

    const CALL_TYPE_LOOKUP = 'lookup';
    const CALL_TYPE_BROWSE = 'browse';
    const CALL_TYPE_SEARCH = 'search';

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
        return $this;
    }

    public function getHttpAuth()
    {
        if (!$this->isHttpAuthDoable()) {
            throw new Exception("Authorization not possibile with given info.");
        }
        return [$this->_username, $this->_password, 'digest'];
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
        return $this;
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
        return $this;
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

    // TODO: wrapper functions lookupArtist() lookupRelease() etc.

    public function lookup($entityType, $mbid, $includes = [], CallOptions $options = null)
    {
        if (!Utilities::isValidLookupEntityType($entityType)) {
            throw new Exception("EntityType " . $entityType . " is not valid.");
        }

        if (!in_array($entityType, EntityType::nonMBIDFormat) && !Utilities::isValidMbid($mbid)) {
            throw new Exception("MusicBrainz ID " . $mbid . " is not valid.");
        }

        if (empty($options)) {
            $options = new CallOptions();
        }

        if ($this->isHttpAuthDoable() && !$options->isHttpAuthDoable()) {
            $options->setHttpAuth($this->_username, $this->_password);
        }

        $includes = Includes::validate($entityType, $includes, $options, self::CALL_TYPE_LOOKUP);
        $path = $entityType . "/" . $mbid;
        $query = [
            'inc' => implode('+', $includes),
            'fmt' => 'json'
        ];

        $callResponse = $this->call($path, $query, $options);
        $callResponseDecoded = json_decode($callResponse, true);
        $responseObject = $this->buildResponseObject($entityType, $callResponseDecoded, self::CALL_TYPE_LOOKUP);

        return $responseObject;
    }

    public function browse($entityType, $referenceEntityType, $referenceMbid, $includes = [], CallOptions $options = null)
    {
        if (!Utilities::isValidBrowseEntityType($entityType)) {
            throw new Exception("EntityType '" . $entityType . "' is not valid.");
        }

        if (!Utilities::isValidEntityType($referenceEntityType)) {
            throw new Exception("EntityType '" . $referenceEntityType . "' is not valid.");
        }

        if (!in_array($referenceEntityType, EntityType::nonMBIDFormat) && !Utilities::isValidMbid($referenceMbid)) {
            throw new Exception("MusicBrainz ID '" . $referenceMbid . "' is not valid.");
        }

        if (empty($options)) {
            $options = new CallOptions();
        }

        if ($this->isHttpAuthDoable() && !$options->isHttpAuthDoable()) {
            $options->setHttpAuth($this->_username, $this->_password);
        }
        $modelMap = EntityType::modelMap;
        $links = call_user_func($modelMap[$entityType] . '::links');
        if (!in_array($referenceEntityType, $links)) {
            throw new Exception("EntityType '" . $referenceEntityType . "' is not a valid link for EntityType '" . $entityType . "'.");
        }

        $includes = Includes::validate($entityType, $includes, $options, self::CALL_TYPE_BROWSE);

        $path = $entityType;
        $query = [
            $referenceEntityType => $referenceMbid,
            'inc' => implode('+', $includes),
            'fmt' => 'json'
        ];

        $callResponse = $this->call($path, $query, $options);
        $callResponseDecoded = json_decode($callResponse, true);
        $responseObject = $this->buildResponseObject($entityType, $callResponseDecoded, self::CALL_TYPE_BROWSE);

        return $responseObject;
    }

    public function call($path, $query, CallOptions $options = null)
    {
        if (empty($options)) {
            $options = new CallOptions();
        }

        $query = array_merge($query, $options->getQueryParameters());

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
        if ($options->isAuthRequired()) {
            if ($options->isHttpAuthDoable()) {
                $clientOptions['auth'] = $options->getHttpAuth();
            } elseif ($this->isHttpAuthDoable()) {
                $clientOptions['auth'] = $this->getHttpAuth();
            } else {
                throw new Exception("Authentication is required. Please set username and password.");
            }
        }
        $response = $this->getClient()->get($path, $clientOptions);
        return (string)$response->getBody();
    }

    public function buildResponseObject($entityType, $callResponse, $callType)
    {
        if ($callType == self::CALL_TYPE_BROWSE) {
            $className = BrowseResponse::class;
        } else if ($callType == self::CALL_TYPE_LOOKUP) {
            $modelMap = EntityType::modelMap;
            if (!isset($modelMap[$entityType])) {
                throw new Exception("No model map found for " . $entityType . " EntityType.");
            }

            if (!is_array($callResponse)) {
                throw new Exception("A null response was received.");
            }

            $className = $modelMap[$entityType];
        }

        return call_user_func($className . '::create', $callResponse);

    }
}
