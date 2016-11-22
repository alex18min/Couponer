<?php

/**
 * Created by PhpStorm.
 * User: Marask
 * Date: 30/09/2015
 * Time: 19:13
 */
class restAPI
{

    private $class;
    private $classArgs;
    private $method;
    private $methodArgs;

    function __construct($class, $classArgs = null, $method = null, $methodArgs = null)
    {

        $this->setClass($class);

        if ($classArgs) {
            if(is_array($classArgs[0])){
                $this->setClassArgs($classArgs[0]);
            }
            else {
                $this->setClassArgs($classArgs);
            }
        }


        if ($method) {
            $this->setMethod($method);
        }

        if ($methodArgs) {
            if(is_array($methodArgs[0])){
                $this->setMethodArgs($methodArgs[0]);
            }
            else {
                $this->setMethodArgs($methodArgs);
            }
        }

    }

    /**
     * @return null
     */

    function call()
    {
        $retVal = null;

        $class = $this->getClass();

        if ($this->getClassArgs()) {
            $instance = new $class(...$this->getClassArgs());
        } else {
            $instance = new $class;
        }

        if ($this->getMethod()) {

            $method = $this->getMethod();

            if ($this->getMethodArgs()) {
                $retVal = $instance->$method(...$this->getMethodArgs());
            } else {
                $retVal = $instance->$method();
            }

        } else {
            $retVal = $instance;
        }

        return $retVal;

    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getClassArgs()
    {
        return $this->classArgs;
    }

    /**
     * @param mixed $classArgs
     */
    public function setClassArgs($classArgs)
    {
        $this->classArgs = $classArgs;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getMethodArgs()
    {
        return $this->methodArgs;
    }

    /**
     * @param mixed $methodArgs
     */
    public function setMethodArgs($methodArgs)
    {
        $this->methodArgs = $methodArgs;
    }


}