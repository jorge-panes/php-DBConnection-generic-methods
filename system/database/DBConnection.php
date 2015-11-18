<?php

    class DBConnection 
    {
        private $con;
        
        function __construct() 
        {
            require_once('../config.php'); 
            $this->con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
            mysqli_select_db($this->con, DB_DATABASE) or die(mysqli_error());
        }

        function __destruct() 
        {
            $this->close();
        }

        function beginTransaction()
        {
            mysqli_begin_transaction($this->con);
        }

        function commit()
        {
            mysqli_commit($this->con);
        }

        function rollback()
        {
            mysqli_rollback($this->con);
        }

        function query($query)
        {
            return mysqli_query($this->con, $query);
        }

        function select($table, $data = null)
        {
            $query = 'SELECT * FROM ' . $table;

            if (isset($data)){
                foreach ($data as $key => $value) {
                    $values[] = '"'.$value.'"';
                    if ($value != NULL) {
                        $where[] = "`$key`".' = "'.$value.'"';
                    }
                }
                $query = $query . ' WHERE ' . implode(", ", $where); 
            }

            $result = $this->query($query);
            while($row = $result->fetch_array(MYSQL_ASSOC)) {
                    $myArray[] = $row;
            }
            return json_encode($myArray);
        }

        function insertOrUpdate($table, $data){
            foreach ($data as $key => $value) {
                $cols[] = "`$key`";
                $values[] = '"'.$value.'"';
                if ($value != NULL) {
                    $updateCols[] = "`$key`".' = "'.$value.'"';
                }
            }

            $sql = 'INSERT INTO '.$table.' ('.implode(", ", $cols).') VALUES ('.implode(", ",  $values).') ON DUPLICATE KEY UPDATE '.implode(", ", $updateCols);
    
            return $this->query($sql);
        }

        function close() 
        {
            mysqli_close($this->con);
        }
    }
?>