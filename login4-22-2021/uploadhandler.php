<?php 
session_start();
include('./includes/config.php'); 

//declare errors 
$error = array(); 
 
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('initial host connection problems'); 

var_dump($_SESSION['AuthorUserName'], 
var_dump($_SESSION['AuthorID']));

if(isset($_POST['submit'])){ 

    if(empty($_POST['chapterName'])){ 
        array_push($error, "chapter Name is empty"); 
    }

    if(empty($_POST['chapterNumber']) ){ 
        array_push($error, "Empty Chapter Number or Number does not match Pic Chapter Number");
    }
    

    $file=$_FILES['file']; 
    $fileName=$_FILES['file']['name']; 
    $fileSize=$_FILES['file']['size']; 
    $fileError=$_FILES['file']['error']; 
    $fileTmpName=$_FILES['file']['tmp_name']; 
    $chapterNumber=$_POST['chapterNumber']; 
    $chapterName=$_POST['chapterName']; 
    $fileExt = explode('.', $fileName); 
    $fileActualExt = strtolower(end($fileExt)); //want the extension which is last item of $fileExt array; 
    $allowed = array('jpg', 'jpeg', 'png'); 
    
    //getting chapter name and file name 
    $fileChapterNameAndPages = strtolower(reset($fileExt)); 
    $chapterAndPagesArray = explode('-',$fileChapterNameAndPages); 
    $picChapterNumber = strtolower(reset($chapterAndPagesArray));
    $picPageNumber = strtolower(end($chapterAndPagesArray));  

    if($chapterNumber != $picChapterNumber){
        array_push($error, "The chapter number you entered does not match the chapter number of the photo");
    }
  
    //set of if statements to check if 
        //extension allowed 
        //errors happened 
        //file size 
        //if not take temporary upload and save to uploads 
    if(in_array($fileActualExt, $allowed)){ //checks array $allowed to see if extensions allowed
        if($fileError == 0){ 
            if($fileSize < 10000000){ 
                // do something 
                if(isset($chapterNumber) && (int)$chapterNumber == $picChapterNumber /*&& $pageNumber == $picPageNumber*/){     
                    //added if for error count
                    if(count($error) == 0 ){
                        $both_check_query = "SELECT * FROM Pages WHERE chapterNumber ='$chapterNumber' AND pageNumber='$picPageNumber' LIMIT 1"; 
                        $result = mysqli_query($db, $both_check_query);
                        $both = mysqli_fetch_array($result); 
                        
                        $pages_check_query = "SELECT * FROM Pages WHERE pageNumber='$picPageNumber' LIMIT 1"; 
                        $pagesResult = mysqli_query($db, $both_check_query);
                        $pages = mysqli_fetch_array($pagesResult); 
                        
                      
                      
                        if(Null == mysqli_num_rows($result)){ 
                            //if mysqli returns no rows 
                            var_dump($_SESSION['userName']); 
                            $query2="INSERT INTO `Pages` (`chapterNumber`, `pageNumber`, `imageName`) VALUES ('$chapterNumber', '$picPageNumber', '$fileName')"; 
                            mysqli_query($db, $query2); 
                            
                            $query1="INSERT INTO `Chapters` (`chapterNumber`, `Description`) VALUES ('$chapterNumber', '$chapterName')";
                            mysqli_query($db, $query1); 
                            $fileNameNew = uniqid('', true).".".$fileActualExt; 
                            $fileDestination = 'uploads/'.$fileNameNew; 
                            
                            move_uploaded_file($fileTmpName, $fileDestination); 

                        }else if(Null !== mysqli_num_rows($result) && Null !== mysqli_num_rows($pagesResult)){ 
                            //if mysqli_ returns not null
                            array_push($error, 'This page and chapter are already in database'); 
                        }
                    }//end if error count
                }//end if name
            }//end if filesize
        }else { 
            array_push($error, 'No errors happened'); 
            
        }//end else
    }else { 
        array_push($error,'No File Selected or File Type Not Allowed'); 
        //echo 'Format not allowed'; 
        
    }//end format
    //header("Location: uploadform.php");// to return to any page
}