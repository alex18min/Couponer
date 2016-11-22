<?php

class Email extends Model
{
    public $fields;

    function __construct($data = null)
    {
        $this->properties = new stdClass();
        $this->setTable('email');
        $this->setPk();

        if ($data) {
            $this->setProperties($data);
        }
    }

}