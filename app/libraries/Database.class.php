<?php

    /*
     *  PDO Database class
     *  Connect to database
     *  Create prepared statments
     *  Bind values
     *  Return rows and results
     * 
     */

    class Database
    {
        private $_host = DB_HOST;
        private $_user = DB_USER;
        private $_pass = DB_PASS;
        private $_db_name = DB_NAME;

        private $_dbh;
        private $_stmt;
        private $_error;

        public function __construct()
        {
            // Set DSN
            $dsn = 'mysql:host=' . $this->_host . ';dbname=' . $this->_db_name;

            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // Create a new PDO Istance
            try
            {
                $this->_dbh = new PDO($dsn, $this->_user, $this->_pass, $options);
            }
            catch(PDOException $e)
            {
                $this->_error = $e->getMessage();
                echo $this->_error;
            }
        }

        // Prepare statment with query
        public function query($sql)
        {
            $this->_stmt = $this->_dbh->prepare($sql);
        }

        // Bind values
        public function bind($param, $value, $type = null)
        {
            if(is_null($type))
            {
                switch(true)
                {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }
            
            $this->_stmt->bindValue($param, $value, $type);
        }

        // Execute prepare statment
        public function execute()
        {
            return $this->_stmt->execute();
        }

        // Get results as an array of objects
        public function resultSet()
        {
            $this->execute();
            return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Get a single row
        public function single()
        {
            $this->execute();
            return $this->_stmt->fetch(PDO::FETCH_OBJ);
        }

        // Get row count
        public function rowCount()
        {
            return $this->_stmt->rowCount();
        }
    }

?>