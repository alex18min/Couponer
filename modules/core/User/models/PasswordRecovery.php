<?php

/**
 * Class PasswordRecovery
 */

class PasswordRecovery extends Model
{
    public $fields;

    function __construct($data = null)
    {
        $this->properties = new stdClass();
        $this->setTable('password_recovery');
        $this->setPk();

        if ($data) {
            $this->setProperties($data);
        }
    }

    /**
     * @param int $user
     * @return string|bool
     */

    function setHash($user){

        $retVal = false;

        $this->properties->fk_utente = $user;
        $this->properties->richiesta_hash = uniqid('', true).uniqid('', true);

        if($this->save()){
            $retVal = $this->properties->richiesta_hash;
        }

        return $retVal;

    }

}