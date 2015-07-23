<?php

namespace MusicBrainz\HttpAdapters;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use MusicBrainz\Exception;

/**
 * Guzzle Http Adapter
 */
class GuzzleHttpAdapter extends AbstractHttpAdapter
{
    /**
     * The Guzzle client used to make cURL requests
     *
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * Initializes the class.
     *
     * @param \GuzzleHttp\Client $client The Guzzle client used to make requests
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Perform an HTTP request on MusicBrainz
     *
     * @param  string  $path
     * @param  array   $params
     * @param  array   $options
     * @param  boolean $isAuthRequired
     *
     * @throws \MusicBrainz\Exception
     * @return array
     */
    public function call($path, array $params = array(), array $options = array(), $isAuthRequired = false)
    {
        if ($options['user-agent'] == '') {
            throw new Exception('You must set a valid User Agent before accessing the MusicBrainz API');
        }

        $options = [
            'base_uri' => self::URL,
            'query' => $params,
            'headers' => [
                'User-Agent' => $options['user-agent'],
                'Accept'     => 'application/json',
            ]
        ];

        if ($isAuthRequired) {
            if ($options['user'] != null && $options['password'] != null) {
                $options['auth'] = ['username', 'password', 'digest'];
            } else {
                throw new Exception('Authentication is required');
            }
        }
        $response = $this->client->get($path, $options);
        return $response->getBody();
/*
        $this->client->setBaseUrl(self::URL);
        $this->client->setConfig(
                     array(
                         'data' => $params
                     )
        );

        $request = $this->client->get($path . '{?data*}');
        $request->setHeader('Accept', 'application/json');
        $request->setHeader('User-Agent', $options['user-agent']);

        if ($isAuthRequired) {
            if ($options['user'] != null && $options['password'] != null) {
                $request->setAuth($options['user'], $options['password'], CURLAUTH_DIGEST);
            } else {
                throw new Exception('Authentication is required');
            }
        }

        $request->getQuery()->useUrlEncoding(false);

        // musicbrainz throttle
        sleep(1);

        return $request->send()->json();*/
    }
}
