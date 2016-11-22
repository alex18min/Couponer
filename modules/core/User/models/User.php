<?php


class User extends Model
{
    function __construct($data = null)
    {
        $this->properties = new stdClass();
        $this->setTable('users');
        $this->setPk();

        if ($data) {
            $this->setProperties($data);
        }
    }

    /**
     * @return bool
     */

    function authenticate()
    {

        $inputUser = $this->properties->utente_username;
        $inputPassword = $this->properties->utente_password;
        $aArgs = array(':user_name' => $inputUser);

        $dbUser = $this->findAll('utente_username = :user_name', $aArgs);

        if (!$dbUser) {
            return false;
        } else {
            $dbPassword = $dbUser['utente_password'];
            if (password_verify($inputPassword, $dbPassword)) {
                $this->setProperties($dbUser);
                unset($this->properties->utente_password);
                return true;
            } else {
                return false;
            }

        }

    }

}