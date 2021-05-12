<?php 
ob_start(); //- wont transfer header form login to index
define('THIS_PAGE', basename($_SERVER['PHP_SELF'])); 
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL); 


define('DEBUG', 'FALSE'); 

include('./includes/credentials.php'); 
//setting what page we are on with THIS_PAGE
//tried to add error messages



//using switch statement for condidtions of pages 
switch(THIS_PAGE){ 
    case 'index.php': 
        $title = 'Home'; 
        $mainHeadline = ''; 
        $center = ''; 
        $body = 'Home'; 
    break; 
    case 'about.php': 
        $title = 'About'; 
        $mainHeadline = ''; 
        $center = ''; 
        $body = 'About'; 
    break; 
    case 'contacts.php': 
        $title = 'Contacts'; 
        $mainHeadline = ''; 
        $center = ''; 
        $body = 'Contacts'; 
    break; 
    case 'authors.php': 
        $title = 'authors'; 
        $mainHeadline = ''; 
        $center = 'authors'; 
        $body = 'authors'; 
    break; 
    case 'uploadform.php': 
        $title = 'File Upload Page'; 
        $mainHeadline = ''; 
        $center = ''; 
        $body = 'uploads'; 
    break; 
    case 'registerform.php': 
        $title = 'register'; 
        $mainHeadline = ''; 
        $center = ''; 
        $body = 'register'; 
    break; 
    case 'comics-views.php': 
        $title = 'comics'; 
        $mainHeadline = ''; 
        $center = ''; 
        $body = 'comics'; 
    break; 
    case 'chapters-views.php': 
        $title = 'chapters'; 
        $mainHeadline = ''; 
        $center = ''; 
        $body = 'chapters'; 
    break; 
     
   

}//end of switch, total 4
 
//nav array, total 4
$nav['index.php'] = "Home"; 
$nav['about.php'] = "About"; 
$nav['contact.php'] = "Contact"; 
$nav['authors.php'] = "Authors";  

//start of navigation function 
function makelinks($nav){ 
    $myReturn=''; 
    foreach($nav as $key => $value){ 
        if(THIS_PAGE == $key){ 
            $myReturn .= '<li><a href="'.$key.'" class="active">'.$value.'</a></li>';
        }else{ 
            $myReturn .= '<li><a href="'.$key.'">'.$value.'</a></li>'; 
        }
    }
    return $myReturn;
}
//END NAVIGATION 


function myerror($myFile, $myLine, $errorMsg) { //define myerror function
    if(defined('DEBUG')  && DEBUG){ 
        echo 'Error in file: <b> ' .$myFile. '</b> on line: <b>' .$myLine. '</b>'; 
        echo 'Error message: <b> ' .$errorMsg. '</b>'; 
        die(); //stops program
    }else { 
        echo 'Houston We Gots A Problem.'; 
        die(); //stops program 
    }


}
?>