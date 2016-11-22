<?php

/**
 * Class usersController
 */
class usersController extends Controller
{

    /**
     * usersController constructor.
     * @param object|bool $object
     */

    function __construct($object = null)
    {
        parent::__construct('User', $object);
    }

    /**
     * @return mixed
     */

    function getAllUsers()
    {

        $allUsers = $this->getModel()->findAll();

        if ($allUsers) {
            if (isset($allUsers[0]) && is_object($allUsers[0])) {
                foreach ($allUsers as $singleUser) {
                    unset($singleUser->properties->utente_password);
                }
            } else {
                unset($allUsers['utente_password']);
            }
        }

        return $allUsers;

    }

    /**
     * @param int $id
     * @return bool|mixed
     */

    function getUserByID($id)
    {

        $retVal = false;

        $this->getModel()->findByPK($id);

        if (!empty($this->getModel()->properties)) {
            unset($this->getModel()->properties->utente_password);
            $retVal = $this->getModel()->properties;
        }

        return $retVal;

    }

    /**
     * @return mixed
     */

    function login()
    {
        $retVal = false;

        if ($this->getModel()->authenticate()) {
            $anagrafica = new Anagraphic();
            $anagrafica->findByPK($this->getModel()->properties->fk_anagrafica);
            $this->getModel()->properties->anagraphics = $anagrafica->properties;
            $retVal = $this->getModel()->properties;

        }

        return $retVal;

    }

    /**
     * @return bool
     */


    function isUserUnique()
    {

        $retVal = false;

        $duplicates = $this->getModel()->findAll('user_name = :username', array(':username' => $this->getModel()->properties->user_name));

        if (!$duplicates || empty($duplicates)) {
            $retVal = true;
        }

        return $retVal;

    }

    /**
     * @param string $email
     * @return bool
     */


    function passwordRecovery($email)
    {

        $retVal = false;

        $user = $this->getModel()->findAll('user_email = :email', array(':email' => $email));

        if ($user) {
            $this->getModel()->setProperties($user);

            $anagrafica = new Anagraphics();
            $anagrafica->findAll('father_key = :userid', array(':userid' => $this->getModel()->properties->id_user));
            $anagrafica->setProperties($anagrafica->findAll('father_key = :userid', array(':userid' => $this->getModel()->properties->id_user)));
            $this->getModel()->properties->anagraphics = $anagrafica->properties;

            $hasher = new PasswordRecovery();
            $this->getModel()->properties->hash = $hasher->setHash($this->getModel()->properties->id_user);

            $email = new emailController();
            $retVal = $email->sendPwdRecEmail($this->getModel()->properties);

        }

        return $retVal;

    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */

    function setNewPwd($password, $hash)
    {

        $retVal = false;

        $hasher = new PasswordRecovery();
        $userData = $hasher->findAll('richiesta_hash = :hash', array(':hash' => $hash));

        if ($userData) {
            $hasher->setProperties($userData);
            $this->getModel()->findByPK($hasher->properties->father_key);
            $this->getModel()->properties->user_password = password_hash($password, PASSWORD_DEFAULT);
            $retVal = $this->getModel()->save();
        }

        return $retVal;

    }

    function authenticate($username, $password)
    {

        $retVal = false;

        $this->setModel();
        $user = $this->getModel();


        $user->setProperties($user->findAll('utente_username = :username', array(':username' => $username)));
        if ($password == $user->properties->utente_password) {
            unset($user->properties->utente_password);
            $retVal = $user->properties;
            unset($user);
        }


        return $retVal;


    }

}