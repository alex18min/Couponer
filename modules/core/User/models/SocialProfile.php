<?php


class SocialProfile extends Model
{
    function __construct($data = null)
    {
        $this->properties = new stdClass();
        $this->setTable('users_social');
        $this->setPk();

        if ($data) {
            $this->setProperties($data);
        }
    }

}