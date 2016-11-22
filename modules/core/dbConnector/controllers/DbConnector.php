<?php

/**
 * Interface dbConnectorInterface
 */
interface DbConnectorInterface
{
    public function __construct($host = NULL, $user = NULL, $password = NULL, $db = NULL);

    public function connect();

}

/**
 * Class dbConnector
 */
class DbConnector implements DbConnectorInterface
{
    private $host;
    private $user;
    private $password;
    private $db;
    private $dbType;

    /**
     * @param string|null $host
     * @param string|null $user
     * @param string|null $password
     * @param string|null $db
     * @param string|null $dbType
     */

    function __construct($host = NULL, $user = NULL, $password = NULL, $db = NULL, $dbType = NULL)
    {
        if (!$host) {
            $this->setHost('localhost');
        } else {
            $this->setHost($host);
        }

        if (!$user) {
            $this->setUser('root');
        } else {
            $this->setUser($user);
        }

        if (!$password) {
            $this->setPassword('');
        } else {
            $this->setPassword($password);
        }

        if (!$db) {
            $this->setDb('servs_platform');
        } else {
            $this->setDb($db);
        }

        if (!$dbType) {
            $this->setDbType('mysql');
        } else {
            $this->setDbType($dbType);
        }

    }


    /**
     * @throws Exception
     * @throws ExceptionManager
     */

    function connect()
    {
        $biExcWrongConnection = 'Wrong connection!';
        $methodName = 'dbConnect';
        $dbh = null;

        try {
            $retVal = null;

            switch ($this->getDbType()) {

                case 'mysql':
                    $dbh = new PDO('mysql:host=' . $this->getHost() . ';dbname=' . $this->getDb(), $this->getUser(), $this->getPassword());
                    break;

                case 'postgres':
                    // echo 'pgsql:host='.$this->getHost().'; port=5432; dbname='.$this->getDb().'; user='.$this->getUser().'; password='.$this->getPassword().';<br>';
                    $dbh = new PDO('pgsql:host=' . $this->getHost() . '; port=5432; dbname=' . $this->getDb() . '; user=' . $this->getUser() . '; password=' . $this->getPassword() . ';');
                    break;

            }

            if ($dbh) {
                $retVal = $dbh;
            } else {
                throw new ExceptionManager ($biExcWrongConnection, 300, 3);
            }
            return $retVal;

        } catch (ExceptionManager $e) {
            throw $e;
        } catch (PDOException $ePdo) {
            throw new ExceptionManager ($ePdo->getMessage(), 304, 3);
        }

    }

    /**
     * @param string $sql
     * @param array $aArgs
     * @param string $type
     * @return array|int|null
     * @throws ExceptionManager
     */

    function runQuery($sql, $aArgs, $type)
    {
        $retVal = null;

        if (!$type) {
            $type = 'select';
        }

        $conn = $this->connect();
        $sth = $conn->prepare($sql);
        $result = $sth->execute($aArgs);

        if ($result) {

            switch ($type) {

                case 'select':
                    $retVal = $sth->fetchAll(PDO::FETCH_ASSOC);
                    if ($retVal && count($retVal) < 2) {
                        $retVal = $retVal[0];
                    }
                    break;

                case 'insert':
                    $retVal = $conn->lastInsertId();
                    break;

                case 'update':
                    $retVal = $sth->rowCount();
                    break;

                case 'delete':
                    $retVal = $sth->rowCount();
                    break;
            }
        }

        return $retVal;


    }

    // GETTERS AND SETTERS

    /**
     * @return string
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param string $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getDbType()
    {
        return $this->dbType;
    }

    /**
     * @param mixed $dbType
     */
    public function setDbType($dbType)
    {
        $this->dbType = $dbType;
    }


}


