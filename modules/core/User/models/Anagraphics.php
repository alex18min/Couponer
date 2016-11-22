<?php


class Anagraphics extends Model
{
    function __construct($data = null)
    {
        $this->properties = new stdClass();
        $this->setTable('users_info');
        $this->setPk();

        if ($data) {
            $this->setProperties($data);
        }
    }

}