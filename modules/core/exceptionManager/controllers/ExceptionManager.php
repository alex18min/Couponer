<?php

/**
 * Class ExceptionManager
 * @param string $message [optional] The Exception message to throw.
 * @param int $code [optional] The Exception code.
 * @param int $severity [optional] The severity level of the exception.
 * @param string $filename [optional] The filename where the exception is thrown.
 * @param int $lineno [optional] The line number where the exception is thrown.
 * @param Exception $previous [optional] The previous exception used for the exception chaining.
 */
class ExceptionManager extends ErrorException
{

    /**
     * @return string
     */

    public function getCustomMessage()
    {
        $this->message = '<b>' . $this->getMessage() . '</b><br>error code: ' . $this->getCode() . '<br>error severity : ' . $this->getSeverity() . '<br>';
        $errorMsg = $this->getMessage() . 'on line ' . $this->getLine() . ' of file ' . $this->getFile() . '<br>';
        return $errorMsg;
    }

    /**
     * @return string
     */

    public function printCustomMessage()
    {
        echo $this->getCustomMessage();
    }

    /**
     * @return string
     */
    public function toJson(){
        $retVal = json_encode(array(
            'error' => array(
                'msg'  => $this->getMessage() . 'on line ' . $this->getLine() . ' of file ' . $this->getFile(),
                'code' => $this->getCode(),
            ),
        ));
        return $retVal;
    }

    /**
     * ERROR SEVERITY
     * 0 - WARNING
     * 1 - FATAL
     * 2 - INFO
     * 3 - DATABASE
     *
     * ERROR CODES
     * 001 - UNCAUGHT EXCEPTION
     * 100 - SCRIPT ERROR
     * 101 - NO CLASS FOUND
     * 200 - MISSING USERNAME
     * 201 - MISSING PASSWORD
     * 202 - WRONG AUTHENTICATION DATA
     * 300 - NO CONNECTION
     * 301 - NO SQL
     * 302 - BAD SQL
     * 303 - BAD SQL EXECUTION
     * 304 - PDO EXCEPTION
     *
     */

}

