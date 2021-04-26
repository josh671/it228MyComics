<?php 
session_start();
include('./includes/config.php'); 

 
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

if(isset($_POST['submit'])){ 
    $file=$_FILES['file']; 
    $fileName=$_FILES['file']['name']; 
    $fileSize=$_FILES['file']['size']; 
    $fileError=$_FILES['file']['error']; 
    $fileTmpName=$_FILES['file']['tmp_name']; 
    //print_r($file); 
    $name=$_POST['chapName']; 
    $description = $_POST['description']; 

    print($description); 
    print_r($name);
    //getting array of filename and extension
    //getting extension from array
    print_r($fileName);

    $fileExt = explode('.', $fileName); 
    $fileActualExt = strtolower(end($fileExt)); //want the extension which is last item of $fileExt array; 
    print_r($fileExt); 
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


               //if name is set add to sql tables
                    $query1 = "INSERT INTO `Pages` (`pageID`, `chapterNumber`, `pageNumber`, `imageName`, `dateAdded`)
                    VALUES ('$pageNumber', '$chapterNumber', '$pageNumber', '$fileName', CURRENT_TIMESTAMP)"; 

                    $query2="INSERT INTO `Chapters` (`chapID`, `pageID`, `Description`)
                    VALUES ('$chapterNumber', '$pageNumber', '$description')"; 
                    mysqli_query($db, $query1); 
                    mysqli_query($db, $query2); 

                
                


                

                $fileNameNew = uniqid('', true).".".$fileActualExt; 
                $fileDestination = 'uploads/'.$fileNameNew; 
                
                move_uploaded_file($fileTmpName, $fileDestination); 
                //header("Location: uploadform.php?uploaded=success"); to return to any page
                }
            }
        }else { 
            echo 'No errors happened'; 
        }
    }else { 
        echo 'Format not allowed'; 
    }
}