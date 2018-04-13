<?php

class Auth
{
    protected $allowed = 0;

    public function __toString()
    {
        return ($this->allowed == 1) ? $_ENV['CHALLENGE5_FLAG'] : '';
    }
}

?>