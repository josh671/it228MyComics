<?php 
session_start();
include('./includes/config.php'); 

//declare errors 
$error = array(); 
 
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('initial host connection problems'); 

if(isset($_POST['submit'])){ 
    $file=$_FILES['file']; 
    $fileName=$_FILES['file']['name']; 
    $fileSize=$_FILES['file']['size']; 
    $fileError=$_FILES['file']['error']; 
    $fileTmpName=$_FILES['file']['tmp_name']; 
    //print_r($file); 
    $name=$_POST['chapName']; 
    $description = $_POST['description']; 

    //print($description); 
    //print_r($name);
    //getting array of filename and extension
    //getting extension from array
    //print_r($fileName);
    //print('<br><p>space</p>');

    $fileExt = explode('.', $fileName); 
    $fileActualExt = strtolower(end($fileExt)); //want the extension which is last item of $fileExt array; 
    //print_r($fileExt); 
    $allowed = array('jpg', 'jpeg', 'png'); 
    
    
    //getting chapter name and file name 
    $fileChapterNameAndPages = strtolower(reset($fileExt)); 
    //print_r($fileChapterName.'<br/>'); 
    $chapterAndPagesArray = explode('-',$fileChapterNameAndPages); 
    $chapterNumber = strtolower(reset($chapterAndPagesArray));
    $pageNumber = strtolower(end($chapterAndPagesArray)); 
    //print_r($chapterNumber.'<br/>'); 
    //print_r($pageNumber); 



  
    //set of if statements to check if 
        //extension allowed 
        //errors happened 
        //file size 
        //if not take temporary upload and save to uploads 
    if(in_array($fileActualExt, $allowed)){ //checks array $allowed to see if extensions allowed
        if($fileError == 0){ 
            if($fileSize < 10000000){ 
                // do something 
                if(isset($name)){
                    $user_check_query = "SELECT * FROM Chapters WHERE chapID ='$chapterNumber' AND pageID='$pageNumber' LIMIT 1"; 
                    $result = mysqli_query($db, $user_check_query);
                    $user = mysqli_fetch_assoc($result); 

                    
                  
                    $userCHID = strval($user_check_query.'chapID');
                    $userPID = strval($user_check_query.'pageID');


                   //var_dump($chapterNumber, $user_check_query);
                   // die; 

                    if($user){
                        //if chapExist and pagenum exists echo message or add query. 
                        if( $userCHID == $chapterNumber){ 
                            array_push($error, 'chapters page already exists'); 
                        }else { 

                        }
                        if($userPID  == $pageNumber){ 
                            array_push($error, 'Page chapters page already exists'); 
                        }
                    }
                    //added if for error count
                    if(count($error) == 0){
               //if name is set add to sql tables
                    $query1 = "INSERT INTO `Chapters` (`chapID`, `pageID`, `Description`) VALUES ('$chapterNumber', '$pageNumber', '$description')"; 
                    //print($pageNumber);
                    $query2="INSERT INTO `Pages` (`chapterNumber`, `pageNumber`, `imageName`) VALUES ('$chapterNumber', '$pageNumber', '$fileName')"; 

                    //use to check for myqli errors 
                        if(false === mysqli_query($db, $query2)){ 
                            echo mysqli_errno($db);
                        }
                        if(false === mysqli_query($db, $query1)){ 
                            echo mysqli_errno($db);
                        }
                   
                $fileNameNew = uniqid('', true).".".$fileActualExt; 
                $fileDestination = 'uploads/'.$fileNameNew; 
                
                move_uploaded_file($fileTmpName, $fileDestination); 
                
                    }//end if error count
                }//end if name
            }//end if filesize
        }else { 
            echo 'No errors happened'; 
        }//end else
    }else { 
        echo 'Format not allowed'; 
    }//end format
    header("Location: uploadform.php?success=success");// to return to any page
}