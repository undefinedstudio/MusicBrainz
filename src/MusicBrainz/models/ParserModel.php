<?php

namespace MusicBrainz\models;

use Exception;
use MusicBrainz\MusicBrainz;

class ParserModel
{
    /**
     * @param array|null $data
     * @return static
     */
    public static function create($data = null)
    {
        if (is_array($data)) {
            $className = static::class;
            $object = new $className();
            $object->parseData($data);
            return $object;
        } else {
            return null;
        }
    }

    public static function includes()
    {
        return [
            MusicBrainz::CALL_TYPE_LOOKUP => [],
            MusicBrainz::CALL_TYPE_BROWSE => [],
            MusicBrainz::CALL_TYPE_SEARCH => [],
        ];
    }

    public static function links()
    {
        return [];
    }

    /**
     * @param array $data
     * @throws Exception
     */
    public function parseData($data)
    {
        $config = $this->config();
        foreach ($data as $key => $value) {
            if (!isset($config[$key])) {
                $this->$key = $value;
                continue;
            }
            if (!is_array($config[$key])) {
                $this->$config[$key] = $value;
                continue;
            }
            if (!isset($config[$key]['class'])) {
                throw new Exception('Class specification is missing from config array at key ' . $key);
            }
            if (isset($config[$key]['name'])) {
                $name = $config[$key]['name'];
            } else {
                $name = $key;
            }
            if (isset($config[$key]['multiple']) && $config[$key]['multiple']) {
                $this->$name = [];
                foreach ($value as $iterationValue) {
                    $this->{$name}[] = call_user_func($config[$key]['class'] . '::create', $iterationValue);
                }
                continue;
            }
            $this->$name = call_user_func($config[$key]['class'] . '::create', $value);
        }
    }

    /**
     * @return array
     */
    public function config()
    {
        return [];
    }
}
