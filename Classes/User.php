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
                
                $database = null;
        
        
        //contructor
        
        function __construct($userId, $database) {
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

        public function setDOB($dOB) {
            $this->dOB = $dOB;
          
        }

        public function getDOB() {
            return $this->dOB;
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

    }