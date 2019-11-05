<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of General
 *
 * @author apple
 */
class General {
    //put your code here
    
    
    /**
     * returns an encryoted hash
     * @param type $textToHash
     * @return type
     */
  public  function  getEncryptedHash($textToHash) {
     // $hash1 = hash("sha512", $textToHash);
        return hash("sha512", $textToHash);
    }
    
    
    
    public function func2() {
        return "Hello World";
    }
}
