<?php

namespace MusicBrainz;

class MusicBrainz
{
    private $_user = null;
    private $_password = null;

    public function __contruct($user = null, $password = null)
    {
        if (!empty($user) && !empty($password)) {
            $this->setBasicAuth($user, $password);
        }
    }

    public function setBasicAuth($user, $password)
    {
        $this->_user = $user;
        $this->_password = $password;
    }
}
