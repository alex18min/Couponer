<?php

/**
 * Class Form
 */

class Form
{

    private $columns;

    function __construct($model)
    {

        $columns = array();

        $model = new $model();

        global $oDbConnector;

        $dbh = $oDbConnector->connect();

        $rs = $dbh->query('SELECT * FROM '.$model->getTable().' LIMIT 0');

        if($rs && $rs->columnCount() > 0) {

            for ($i = 0; $i < $rs->columnCount(); $i++) {
                $col = $rs->getColumnMeta($i);
                $columns[] = $col;
            }

            $this->setColumns($columns);

            return true;
        }
        else {
            return false;
        }

    }

    /**
     * @return mixed
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param mixed $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }





}