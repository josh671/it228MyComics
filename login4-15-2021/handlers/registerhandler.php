<?php 
session_start(); 
include('./includes/config.php'); 

$Reg_error = array(); 
$email =''; 
$userName=''; 
$password1 =''; 
$password2 =''; 
$extensions='';

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('initial host connection problems'); 

//if register_user form has submitted post
if(isset($_POST['register_user'])){ 
    $email = $_POST['email']; 
    $extensions=$_POST['extensions']; 
    $userName = $_POST['userName']; 
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $at = "@";

    if(empty($email)){ 
        array_push($Reg_error, "Enter the first part of your email"); 
    } 

    if(preg_match("/{$at}/i", $email)){ 
        array_push($Reg_error, "Remove @. Just list the first part of your email");
    }

    if(empty($extensions)){ 
        array_push($Reg_error, "Choose an Email Extension"); 
    }


    if(empty($userName)){ 
        array_push($Reg_error, "Please Choose a User Name");
    } 

    if(empty($password1)){ 
        array_push($Reg_error, "Please Choose a Password");
    }

    if(empty($password2)){ 
        array_push($Reg_error, "Please Re-enter Password");
    }

    if($password1 !== $password2 ){ 
        array_push($Reg_error, "Passwords do not Match.");
    }
    //checks if email is valid
   
   // $emailArray=""; 
   // $emailArray = explode("@", "$email");
   // if(empty(checkdnsrr(array_pop($emailArray), "MX"))){
   //     array_push($Reg_error, "Email is incomplete");
   //     
   // }elseif(checkdnsrr(array_pop($emailArray), "MX")){ 
   //    print "valid email"; 
   // }else{ 
   //    array_push($Reg_error, "invalid domain"); 
   // }
   //      
        
       
        
}//end isset