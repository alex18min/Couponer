<?php

class Coupon extends Model
{
    public $fields;

    function __construct($data = null)
    {
        $this->properties = new stdClass();
        $this->setTable('coupons');
        $this->setPk();

        if ($data) {
            $this->setProperties($data);
        }
    }

}