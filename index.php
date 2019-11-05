<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    
        <?php

        include_once('Classes/Database.php');
        include_once('header.html');
        // put your code here

        //including
        //require (importing)
        //create a db object
        $mydb = new Database();
         
        $result = $mydb->executeQuery("Select* from user where user_id = 99988");
        
        //loop thru the result and dump each row
        $dataIsFound = false;
        
        while ($row = $mydb->fetchRow($result)) {
            var_dump($row);
            var_dump("<br> a row was dumped <br> <br> ");
            $dataIsFound = true;
        }
        
        if ($mydb->getNumRows($result) == 0) {
            echo "<br> there is no data <br> ";
        }
        
        ?>
    </body>
</html>
