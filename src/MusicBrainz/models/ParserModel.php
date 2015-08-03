<?php

namespace MusicBrainz\models;

abstract class ParserModel
{
    /**
     * @param object|null $data
     * @return static
     */
    public static function create($data = null) {
        if (is_object($data)) {
            $className = static::class;
            $object = new $className();
            $object->parseData($data);
            return $object;
        } else {
            return null;
        }
    }

    /**
     * @param object $data
     */
    abstract function parseData($data);
}
