<?php 
session_start(); 
include('./includes/config.php'); 

$Reg_error = array(); 
$Log_error=array(); 
$email =''; 
$userName=''; 
$password1 =''; 
$password2 =''; 
$extensions=''; 
$success = 'you are now logged in'; 

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('initial host connection problems'); 

//if register_user form has submitted post
if(isset($_POST['register_user'])){ 
    $email = $_POST['email']; 
    $extensions=$_POST['extensions']; 
    $userName = $_POST['userName']; 
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $at = "@";

//check if form fields are EMPTY
    if(empty($email)){ 
        array_push($Reg_error, "Enter the first part of your email"); 
    } 

    if(preg_match("/{$at}/i", $email)){ 
        array_push($Reg_error, "Remove @ and every thing after. Just list the first part of your email");
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

   
    $fullemail = $email . $extensions;
    
        
// if form fields are not empty, email is set, and passwords match 
$reg_check_query="SELECT * FROM `Authors` WHERE `AuthorUserName` = '$userName' OR `AuthorEmail` = '$fullemail' LIMIT 1"; 

$result = mysqli_query($db, $reg_check_query); 
$user = mysqli_fetch_assoc($result); 
//var_dump($user); 
if($user){
    if($user['AuthorUserName'] === $userName || $user['AuthorEmail'] === $fullemail){ 
        array_push($Reg_error, "That User Name has already been chosen"); 
        
    }
    
    if($user['AuthorEmail'] === $fullemail){ 
        array_push($Reg_error, "This email already exists with a user"); 
    }

    if($password1 != $password2){ 
        array_push($Reg_error, 'Pw do not match 2 '); 
    } 
}

if(count($Reg_error) === 0){ 
    
        $safe_password = md5($password1); 
        $query = "INSERT INTO `Authors` (`AuthorUserName`, `AuthorEmail`, `Password`) VALUES ('$userName', '$fullemail', '$safe_password')";
        mysqli_query($db, $query); 

        $_SESSION['AuthroUserName']=$userName; 
        $_SESSION['$success']=$success; 
        //header('location: login.php'); 
    
}

       //INSERT INTO `Admin` (`AdminEmail`, `AdminUser`, `Adminpw`)VALUES ('', '', '');
        
}//end isset 

//////////////////////////////////////////////////////////////////////////////////////////////

//Login for registered users 
if(isset($_POST['login_user'])){ 
    $userName = mysqli_real_escape_string($db, $_POST['userName']); 
    $password1 = mysqli_real_escape_string($db,$_POST['password']); 

    if(empty($userName)){ 
        array_push($Log_error, "Please Enter Your User Name.");
    }

    if(empty($password1)){ 
        array_push($Log_error, "Please Enter Your Password.");
    } 

    if(count($Log_error) == 0){ 
        $password = md5($password1);  
        
        $query = "SELECT * FROM `Authors` WHERE `AuthorUserName` = '$userName' AND `Password` = '$password' LIMIT 1"; 
        $results = mysqli_query($db, $query); 
        if(mysqli_num_rows($results) == 1){ 
           //var_dump(mysqli_num_rows($results));
           //var_dump($results);
           /////////////////////////////////////////
            $getID= "SELECT `AuthorID` FROM `Authors` WHERE `AuthorUserName` = '$userName' LIMIT 1";  
            $IDresult = mysqli_query($db, $getID);
            if(mysqli_num_rows($IDresult) > 0){ 
                $row=mysqli_fetch_assoc($IDresult);
                $id=$row['AuthorID']; 
                var_dump($id);
                $_SESSION['id'] = $id; 
                $_SESSION['AuthorUserName'] = $userName; 
                $_SESSION['success'] = $success;
            }
/////////////////////////////////////////////////////////////////////
            header('Location: uploadform.php');
             //sends to homepage if logins successful
         } else {
            array_push($Log_error, 'Wrong User Name or Password');
         }
      } //end of error count;

}//end login isset 