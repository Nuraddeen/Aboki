<?php

    class Database {
        
        private  
                $user = "root",
                $host = "localhost",
                $databaseName = "Aboki",
                $password = "nura",
                $connection = null
                ;
        
        
        //constructor
        
        function __construct($connection = null) {
            //auto db connect
            $this->connect();
            
        }
       
        
        
        
        public function connect() {
            //connecting to the database
            try{
                 $this->connection = new mysqli($this->host, $this->user, $this->password, $this->databaseName);//, $database);

            } catch (Exception $ex) {
                die ("Error in db connection ".$ex->getMessage());

            }

        }
        
        //getters and setters
        
        public function executeQuery($sqlCode) {
             
                  
                //check if query was executed succesfully
                    if($result = mysqli_query( $this->connection, $sqlCode)){
                        return $result;  
                            
                    }
                    
                    else {
                        throw new Exception("<br> Oops! A Database Error Has Occured  $sqlCode  ");
                
                    }
        }
        
        
        
        
        
        public function executeUpdate($sqlCode) {
                    if(mysqli_query( $this->connection, $sqlCode)){
                       return true;     
                    }
                    
                    else {
                        throw new Exception("<br> Oops! A Database Error Has Occured " . $sqlCode ."  ");
                
                    }
                    
                    return false;
        }
        
        
        
        
        public function fetchRow($resultSet) {
            try{
                return mysqli_fetch_assoc($resultSet);
                
            } catch (Exception $ex) {

            }
           
        }
        
        
        
        
        /**
         * returns the number of rows in a database query result
         * @param mysqli_result $resultSet a resultset fetched from db query
         * @return int the number of rows the result has (or 0 if it has none)
         */
        public function getNumRows(mysqli_result $resultSet) {
            
            return mysqli_num_rows($resultSet); 
             
        }
        
        
        
        
        public function gotoRow(mysqli_result $resultSet, int $row=0){

            if ((!is_int($row)||$row<0) ||  (!mysqli_data_seek($resultSet, $row))) {

                    echo Master::showExceptionMessage (" Oops! A Database Error Has Occured (ER sdata) ");

        }

}
        
       
        
        

    }