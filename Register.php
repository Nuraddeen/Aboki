<?php 

//import the required classes
require_once("Classes/Database.php");
require_once("Classes/User.php");
require_once("Classes/General.php");
$mydb = new Database();
        
        



 

//capturing the data
if (isset($_POST["register"])) {
    //echo " You have submitted a contact form ";
    //lets capture the data

    $filters = array(
        "fullname" => FILTER_SANITIZE_STRING,
        "password" => FILTER_SANITIZE_STRING,
        "confpassword" => FILTER_SANITIZE_STRING,
        "email" => FILTER_VALIDATE_EMAIL,
        "phone_number" => FILTER_VALIDATE_STRING,
        "gender" => FILTER_VALIDATE_STRING,
        "address" => FILTER_SANITIZE_STRING,
        "DOB" => FILTER_VALIDATE_DATE
    );
    
    $filtered_inputs = filter_input_array(INPUT_POST, $filters);
    
    $errors = array();
 

    //pswd must be >=6 xters
    if (strlen($filtered_inputs["password"]) < 6) {
        $errors [] = "- Your password is too short";
    } else if ($filtered_inputs["password"] != $filtered_inputs["confpassword"]) {
        $errors [] = "- Your passwords does not match"; 
    }

    //phone number (numeric, atleast 11 xters)
    if (strlen($filtered_inputs["phone_number"]) < 11 || !is_numeric($filtered_inputs["phone_number"]) ) {
        $errors [] = "- Your phone number is invalid ";
    }

    //email must be valid email address
    if ($filtered_inputs["email"] == false) {
        $errors [] = "- Your email is invalid ";
    }
    

    //fullname must be alphabetic
    if(!preg_match("/^([a-zA-Z' ]+)$/",$filtered_inputs["fullname"])){
        $errors [] = "- Your full name is invalid ";
    } 

    //address should not be empty
    if (!$filtered_inputs["address"]) { //null ""
        $errors [] = "- Your address is invalid ";
    }

     //gender must be Male or Female
   /*  $filtered_inputs["gender"] != "Male" 
     && $filtered_inputs["gender"] != "Female"
    */
    if ( !in_array($filtered_inputs["gender"], ["Male", "Female"]) ) {
             $errors [] = "- Your gender is invalid ";
    
    }
    
    //dob
    if ($filtered_inputs["DOB"] == null) {
        $errors [] = "- Your DOB is invalid ";

    }


    //check if there is errors 

    if (!$errors) {
        
        //np error, lets save
        //create a user object
        $user = new User($mydb);

        //assing valuse to the user

        $user->setFullName($filtered_inputs["fullname"]);
        $user->setGender($filtered_inputs["gender"]);
        $user->setDOB($filtered_inputs["DOB"]);
        $user->setAddress($filtered_inputs["address"]);
        $user->setPassword($filtered_inputs["password"]);
        $user->setEmail($filtered_inputs["email"]);
        $user->setPhoneNumber($filtered_inputs["phone_number"]);

        //try to register
        if ($user->anotherDataExists($filtered_inputs["email"], $filtered_inputs["phone_number"])) {
            $errors [] = "- The email pr phone number you supplied was already taken ";
            
        }

        else if ($user->register() == true) {
            $succesText = "- Your registration was successfull. You can now login. Thank you";
                    
        }
        else {
            $errors [] = "- Your registration was not successful ";
                    
        }
        
        
        //unset($_POST);
    }


}//end reg form was sent
      
      



// user login
else if (isset($_POST["login"])) {
    //echo " You have submitted a contact form ";
    //lets capture the data

    $filters = array(
        "password" => FILTER_SANITIZE_STRING,
        "email" => FILTER_VALIDATE_EMAIL 
    );

     
    
    //filter and validate the inputs
    $filtered_inputs = filter_input_array(INPUT_POST, $filters);
    
    $errors = array();
 

    //pswd must be >=3 xters
    
    if (!$filtered_inputs["password"]) {
        $errors [] = "- Your password is required. ";
    }

     

    //email must be valid email address
    if ($filtered_inputs["email"] == false) {
        $errors [] = "- Your email is invalid ";
    }
      
    //check if there is errors 

    if (count($errors) == 0 ) {

        if ($data = infoExists($con, $filtered_inputs["email"], $filtered_inputs["password"])) {
            //$succesText = " You are logged in ";

            //redirect user to userhome page
            //using php
            //header("Location: UserHome.php");

           // header("Location: http://www.bing.com");

           //using javascript 

           //method 1
         /*  echo "
                <script> window.location = 'UserHome.php'; </script>
           "; */
           //method 1
           ?>

            <script> window.location = 'UserHome.php?userid='; </script>

           <?php

        }

        else {
            $errors [] = "- No user with such details was found ";
        }
        
        /*//np error, lets save
            //check if the email and the pswd exists
            $query_code = "SELECT *  FROM userstable  WHERE email = '".$filtered_inputs["email"]."' AND password = '".$filtered_inputs["password"]."' ";
                  
            //check if query was executed succesfully
                if($result = mysqli_query( $con, $query_code)){
                      
                        //get the data
                        $data = mysqli_fetch_assoc($result);

                        if ($data) {
                            $succesText = " You are logged in ";
                        }
                        else {
                            $errors [] = "- No user with such details was found ";
                        }
 
                        
                }
                
                else {
                    throw new Exception("<br> Oops! A Database Error Has Occured " . $query_code ." @ db");
            
                }
                */
 
    }


}//end reg form was sent
      
      
     

?>


<html> 
    <head>
        <title>
            Aboki | Register
        </title>

        <!-- import js and boostrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/styles/bootstrap.min.css">
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

        <style>
             
        </style>

    </head>
<body> 
         <h1 class = "jumbotron"> Welcome to Aboki </h1>
        
         <div class = "container">

 
            <?php 

            
                //check if there is errors and display them here
                if (isset($errors) && count($errors) > 0){
                    echo "<div class = 'alert alert-danger' > ";

                    //loop thru the array and display each errros

                    foreach($errors as $errorText) {
                        echo "$errorText <br> ";
                    }
                    
                    echo "</div> ";
                }

                //show success text

                if (isset($succesText) && $succesText ) {
                    echo "<div class = 'alert alert-success'>  $succesText </div> ";
                }

            ?>


            
    <hr/> 
     
    <form action="Register.php" method="POST"  style = " width: 100%;">
         <div class="row"  >
 
             <div class="col-sm-2 col-md-2">
                 
             </div>
             
             <div class="col-sm-10 col-md-10 bg-light">
                 <div class="row">
                     
                 
                        <div class="col-sm-5 " >
                       <div class="form-group" >
                            <label for = "email" > Email * </label>  
                            <input type ="email" name="email" id="email" class = "form-control" required/>
                        </div>
                    </div>

                   <div class="col-sm-4 " >
                       <div class="form-group" >
                           <label for = "password" >  Password * </label>
                           <input type ="password" name="password" id="password" class = "form-control"  required/>
                       </div>
                   </div>

                    <div class="col-sm-3 " >
                               <br>
                              <input type="submit" value="Login" class = "btn btn-info"  name="login">
                    </div>
                     
                     </div>
             </div>
            
            </div>
        </form>
     
        
    <br>
    
    <hr/>
        
    <div class = "row"class = "bg-light" >
        
        <div class = "col-md-6 col-md-pull-6"" class = "bg-light" >
            <h1>
                Site Logo, Info Adverts Etc
                <?php 
                
                //$gen = new General ();
                    $pswd = "1234"; 
                    echo "<br> ". General::func2($pswd)."<br> nn ";
                
                ?>
            </h1>
        </div>
        
        
        <div class = "col-md-6  col-md-push-6 bg-light" >
            <h2> Create an account </h2>

            <form action="Register.php" method="POST"  style = " width: 100%">
            
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="fullname"> Full name * </label>
                                <input type ="text" name="fullname" class = "form-control" id="fullname" value="<?php 

                                if (isset($_POST["fullname"])) {
                                    echo $_POST["fullname"]; 
                                }

                                ?>" required/>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-6">
                        
                         <div class="form-group">
                            <label for="email"> Email * </label>
                            <input type ="email" name="email" id="email" class = "form-control"  value="<?php 

                            if (isset($_POST["email"])) {
                                echo $_POST["email"]; 
                            }

                            ?>" required/>
                        </div>
                        
                    </div>
                    
                </div>
                
                
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password"> Password (at least 6 xters) * </label>
                            <input type ="password" name="password" id="password" class = "form-control"  required/>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-6">
                        
                         <div class="form-group">
                            <label for="confpassword"> Confirm Password * </label>
                            <input type ="password" name="confpassword" id="confpassword"  class = "form-control"  required/>
                        </div>
                        
                    </div>
                    
                </div>
                
                 
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number"> Phone Number *</label>
                            <input type ="text" name="phone_number" id="phone_number" class = "form-control"  value="<?php 
                    
                                if (isset($_POST["phone_number"])) {
                                    echo $_POST["phone_number"]; 
                                }

                                ?>" required/>
                         </div>
                        
                    </div>
                    
                    <div class="col-md-6">
                        
                         <div class="form-group">
                            <label for="gender"> Gender </label>
                            <select id="gender" name="gender" class = "form-control">
                                <option value=""> </option>
                                <option value="Male"> Male </option>
                                <option value="Female"> Female </option>
                            </select>
                        </div>
                        
                    </div>
                    
                </div>
                
                  
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number"> Date of birth *</label>
                            <input type ="date" name="DOB" id="DOB" class = "form-control"  value="<?php 
                    
                                if (isset($_POST["DOB"])) {
                                    echo $_POST["DOB"]; 
                                }

                                ?>" required/>
                         </div>
                        
                    </div>
                    
                    <div class="col-md-6">
                        
                         <div class="form-group">
                            <label for="confpassword"> Address * </label>
                             <input type ="text" name="address" id="address" class = "form-control"  value="<?php 
                    
                                if (isset($_POST["address"])) {
                                    echo $_POST["address"]; 
                                }

                                ?>" required/>
                        </div>
                        
                    </div>
                    
                </div>
                
                   
                    <br/>
                    <input style="float: right" type="submit" value="Submit" class = "btn btn-info"  name="register">
                  
                    <br> <br>
                </form>

        </div>


 



    </div>
 


    </div> <!-- container -->

    <br> <br>
    
    
</body>
</html>