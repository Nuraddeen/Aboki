<?php

    class User {
        
        private $userId = null,//default value is null
                /**
                 * the users <b> full name </b> 
                 */
                $fullname = null,
                $DOB = null,
                $gender = null,
                $phoneNumber = null,
                $email = null,
                $password = null,
                $address = null,
                $actStatus = "Active",
                $actType = "Normal",
                $dateCreated = null,
                $dateeUpdateted = null,
                $lastLoggedIn = null,
                $dbTableName = "user",
                
                $database = null;
        
        
        //contructor
        
        function __construct($database, $userId = 0) {
            $this->setUserId($userId);
            $this-> database = $database; 
             
        }
        
        
        //getters and setters
        
        public function getUserId() {
            return $this->userId;
        }
        
        public function setUserId($userId) {
            $this->userId = $userId;
        }
        

        public function setFullName($fullname) {
            $this->fullname = $fullname;
            
        }

        public function getFullName() {
            return $this->fullname;
        }

        public function setDOB($DOB) {
            $this->DOB = $DOB;
          
        }

        public function getDOB() {
            return $this->DOB;
        }

        public function setGender($gender) {
            $this->gender = $gender;
             
        }

        public function getGender() {
            return $this->gender;
        }

        public function setPhoneNumber($phoneNumber) {
            $this->phoneNumber = $phoneNumber;
            
        }

        public function getPhoneNumber() {
                return $this->phoneNumber;
        }

        public function setEmail($email) {
            $this->email = $email;
         
        }

        public function getEmail() {
            return $this->email;
        }

        public function setPassword($password) {
            $this->password = $password;
        
        }

        public function getPassword() {
            return $this->password;
        }

        public function setAddress($address) {
            $this->address = $address;
         
        }

        public function getAddress() {
            return $this->address;
        }

        public function setActStatus($actStatus) {
            $this->actStatus = $actStatus;
        
        }

        public function getActStatus() {
            return $this->actStatus;
        }

        public function setActType($actType) {
            $this->actType = $actType;
       
        }

        public function getActType() {
            return $this->actType;
        }

        public function setDateCreated($dateCreated) {
            $this->dateCreated = $dateCreated;
       
        }

        public function getDateCreated() {
            return $this->dateCreated;
        }

        public function setDateeUpdateted($dateeUpdateted) {
            $this->dateeUpdateted = $dateeUpdateted;
        
        }

        public function getDateeUpdateted() {
            return $this->dateeUpdateted;
        }

        public function setLastLoggedIn($lastLoggedIn) {
            $this->lastLoggedIn = $lastLoggedIn;
             
        }

        public function getLastLoggedIn() {
            return $this->lastLoggedIn;
        } 

        
        
        //init method
        
        /**
         * this method fetched the user infto from the db and initializes its attibutes
         */
        public function init() {
            
        }
        
        
        public function register() {
            
                $sqlQuery = "INSERT INTO  ". $this->dbTableName
                        . "(fullname, address, email, password, phone_number, DOB, gender, account_status, account_type)"
                        . "VALUES ('".$this->getFullName()."', '".$this->getAddress()."', '".$this->getEmail()."' ,"
                        . " '".$this->getPassword()."', '".$this->getPhoneNumber()."', '".$this->getDOB()."', '".$this->getGender()."', 
                        '".$this->getActStatus()."', '".$this->getActType()."'  "
                        . ")";

                        //execute query
                        return $this->database->executeUpdate($sqlQuery);
                
        }
        
        
        public function sendMessage($msg, $receiver) {
            
        }
        
        public function searchFriends($searhKeyword){
            
        }
        
        
        public function sendRequest($userId) {
            
        }
        
        public function receiveRequest() {
            
        }
        
        
        public function update() {
            
        }
        
        public function delete() {
            
        }
        
        
        public function block() {
            
        }
        
        
        
        public function isBlocked() {
           if ($this->getActStatus() == "Blocked"){
               return true;
           } 
           //else {
               return false;
         //  }
           
           // return $this -> egtActStatus() == "Blocked";
        }


        /**
         * checks the db and see whether the user exists, using his id
         */
        public function exists() {
            //select fullName from user hwere user_id = this->getUserId()
        }



        public function anotherDataExists($email=null, $phoneNum =null, $userId = 0) {
             
            $sqlQuery = "";

            if ( $email != null) {//email was provided
                $sqlQuery = " email = '$email' ";
            }
            //do same for phone number
            if ( $phoneNum != null) {//email was provided

                if ($sqlQuery) {
                    $sqlQuery .= " OR ";
                }
                $sqlQuery .= " phone_number = '$phoneNum' ";
            } 

            //check if either email or phone num was set 
            if ($sqlQuery) {
                //go ahead and execute the query

                //do same for user id
                if ( $userId != 0 && is_numeric($userId)) {//email was provided
                    $sqlQuery = "(" . $sqlQuery . ") AND user_id != '$userId' ";
                }

                //execute the query using our database class
                $sqlQuery = " SELECT * FROM ". $this->dbTableName. " WHERE $sqlQuery";
                $result = $this->database->executeQuery($sqlQuery);
 
                if ($this->database->getNumRows($result) >=1){
                    return true;
                }
                 
                return false;
            }
           

        }

    }