<?php


class Model
{

    private $table;
    private $pk;
    public $properties;

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    public function getPk()
    {
        return $this->pk;
    }


    public function setPk()
    {
        global $oDbConnector;

        $sql = 'SHOW KEYS FROM ' . $this->getTable() . ' WHERE Key_name = \'PRIMARY\'';
        $aArgs = array();
        $result = $oDbConnector->runQuery($sql, $aArgs, 'select');
        $this->pk = $result['Column_name'];

    }

    /**
     * @param object|array $data
     * @return bool
     */

    function setProperties($data)
    {

        $retVal = false;

        if(!isset($this->properties)){
            $this->properties = new stdClass();
        }

        if(is_array($data) || is_object($data)) {

            foreach ($data as $column => $value) {
                $this->properties->$column = $value;
            }

            $retVal = true;

        }

        return $retVal;

    }

    /**
     * @param string|bool $condition
     * @param array $aArgs
     * @param string|bool $order
     * @param int|bool $limit
     * @return array|int|null
     */

    function findAll($condition = false, $aArgs = array(), $order = false, $limit = false)
    {

        $sql = 'select * from ' . $this->getTable();

        if ($condition) {
            $sql .= ' where ' . $condition;
            if (!$aArgs) {
                $aArgs = array();
            }
        }

        if ($order) {
            $sql .= ' order by ' . $order;
        }

        if ($limit) {
            $sql .= ' limit ' . $limit;
        }

        global $oDbConnector;
        $retVal = $oDbConnector->runQuery($sql, $aArgs, 'select');

        return $retVal;

    }

    /**
     * @param int $pk
     * @return array|int|null
     */

    function findByPk($pk)
    {

        $sql = 'select * from ' . $this->getTable() . ' where ' . $this->getPk() . ' = :' . $this->getPk();
        $aArgs = array(':' . $this->getPk() => $pk);

        global $oDbConnector;
        $retVal = $oDbConnector->runQuery($sql, $aArgs, 'select');

        $this->setProperties($retVal);

    }

    /**
     * @return array|int|null
     */

    public function save()
    {
        $retVal = null;

        $queryType = null;
        $pk = $this->getPk();

        // if primary key is set, must be an update


        if (isset($this->properties->$pk) && $this->properties->$pk) {

            $queryType = 'update';

            $pairs = '';
            $aArgs = array();
            $i = 1;

            foreach (get_object_vars($this->properties) as $field => $value) {

                $pairs .= $field . ' = :' . $field . ', ';
                $aArgs[':' . $field] = $value;

            }

            $pairs = rtrim($pairs, ", ");
            $sql = 'update ' . $this->getTable() . ' set ' . $pairs . ' where ' . $this->getPk() . ' = :' . $this->getPk();

        } // if primary is not set, must be insert

        else {




            $queryType = 'insert';

            $columns = '';
            $values = '';
            $aArgs = array();

            foreach (get_object_vars($this->properties) as $field => $value) {

                $columns .= $field . ', ';
                $values .= ':' . $field . ', ';

                $aArgs[':' . $field] = $value;

            }

            $columns = rtrim($columns, ", ");
            $values = rtrim($values, ", ");

            $sql = 'insert into ' . $this->getTable() . ' (' . $columns . ') values (' . $values . ')';

        }

        global $oDbConnector;
        $retVal = $oDbConnector->runQuery($sql, $aArgs, $queryType);

        return $retVal;

    }

    /**
     * @return array|int|null
     */

    public function delete()
    {

        $pk = $this->getPk();

        $sql = 'delete from ' . $this->getTable() . ' where ' . $this->getPk() . ' = :' . $this->getPk();
        $aArgs = array(':' . $this->getPk() => $this->properties->$pk);

        global $oDbConnector;
        $retVal = $oDbConnector->runQuery($sql, $aArgs, 'delete');

        return $retVal;


    }


}