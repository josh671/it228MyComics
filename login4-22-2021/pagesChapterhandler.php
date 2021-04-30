<?php 
session_start();
include('./includes/config.php'); 

//declare errors 
$error = array(); 
$comicError=array(); 
 
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('initial host connection problems'); 



if(isset($_POST['upload'])){ 

    if(empty($_POST['comicName'])){ 
        array_push($error, 'You must enter the Name of the comic you wish to add pages and chapters too!'); 
    }

    if(empty($_POST['chapterName'])){ 
        array_push($error, "chapter Name is empty"); 
    }

    if(empty($_POST['chapterNumber']) ){ 
        array_push($error, "Empty Chapter Number.");
    }

    if(empty($_POST['pageNumber']) ){ 
        array_push($error, "Empty page Number. ");
    }

    $AuthorID = intval($_SESSION['id']);  
    
    $file=$_FILES['file']; 
    $fileName=$_FILES['file']['name']; 
    $fileSize=$_FILES['file']['size']; 
    $fileError=$_FILES['file']['error']; 
    $fileTmpName=$_FILES['file']['tmp_name']; 
    $comicTitle=$_POST['comicName']; 
    $chapterNumber=$_POST['chapterNumber']; 
    $chapterName=$_POST['chapterName']; 
    $pageNumber=$_POST['pageNumber'];

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

    if($pageNumber != $picPageNumber){ 
        array_push($error, 'Page Number entered does not match Pic page number'); 
    }
    
//SET QUERY TO GET COMICS SHIT TO PUT INTO TABLES
    $comic_check_query = "SELECT * FROM `Comics` WHERE ComicTitle='$comicTitle'";
    $comicResults = mysqli_query($db, $comic_check_query); 
    $comics=mysqli_fetch_array($comicResults);  


    $comicID = intval($comics['ComicID']); 
    var_dump($comicID); 
    if(Null == $comics){ 
        array_push($error, 'comic dont exist'); 
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
                if(isset($chapterNumber) && (int)$chapterNumber == $picChapterNumber){     
                    //added if for error count
                    if(count($error) == 0 ){
                       
                        //check if page associated with chapter and comic id exist 
                        $check_pagechapter_query = "SELECT * FROM Pages WHERE pageNumber='$picPageNumber' AND chapterNumber='$chapterNumber' AND comicID='$comicID' LIMIT 1"; 
                        $check_pagechapter_result = mysqli_query($db, $check_pagechapter_query); 
                        $pages = mysqli_fetch_array($check_pagechapter_result);
                        
                        //var_dump($pages); 

                        //check if page associated with chapter and comic already exists 
                        //if not, add to pages table with appropriate page number, chapter number, and comicID
                        if($pages){ 
                            array_push($error, "This page and chapter already exists for this comic and author"); 
                        }else{ 
                            $query2="INSERT INTO `Pages` (`chapterNumber`, `pageNumber`, `imageName`, `comicID`) VALUES ('$chapterNumber', '$picPageNumber', '$fileName', '$comicID')"; 
                            mysqli_query($db, $query2); 
                        }

                        $check_comicchapters_query="SELECT * FROM Pages WHERE chapterNumber ='$chapterNumber' AND ComicID='$comicID' LIMIT 1"; 
                        $check_comicchapters_result= mysqli_query($db, $check_comicchapters_query); 
                        $chapters = mysqli_fetch_array($check_comicchapters_result); 

                        var_dump($chapters); 

                        //$both_check_query = "SELECT * FROM Pages WHERE chapterNumber ='$chapterNumber' AND pageNumber='$picPageNumber' LIMIT 1"; 
                        //$result = mysqli_query($db, $both_check_query);
                        //$both = mysqli_fetch_array($result); 
                        
                        //$pages_check_query = "SELECT * FROM Pages WHERE pageNumber='$picPageNumber' LIMIT 1"; 
                        ////pageNumber='$picPageNumber'
                        //$pagesResult = mysqli_query($db, $both_check_query);
                        //$pages = mysqli_fetch_array($pagesResult);  

                        

                       
                        //if(Null == mysqli_num_rows($result)){ 
                            //if mysqli returns no rows 
                           // $query2="INSERT INTO `Pages` (`chapterNumber`, `pageNumber`, `imageName`, `comicID`) VALUES ('$chapterNumber', '$picPageNumber', '$fileName', '$comicID')"; 
                           // mysqli_query($db, $query2); 
//
                           
                            $query1="INSERT INTO `Chapters` (`AuthorID`, `chapterNumber`, `ChapterName`, `ComicID`) VALUES ('$AuthorID', '$chapterNumber', '$chapterName', '$comicID')";
                            mysqli_query($db, $query1); 
                            $fileNameNew = uniqid('', true).".".$fileActualExt; 
                            $fileDestination = 'uploads/'.$fileNameNew; 
                            
                            move_uploaded_file($fileTmpName, $fileDestination); 

                        //}else if(Null !== mysqli_num_rows($result) && Null !== mysqli_num_rows($pagesResult)){ 
                        //    //if mysqli_ returns not null
                        //    array_push($error, 'This page and chapter are already in database'); 
                        //}
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
    //header("Location: chapters.php");// to return to any page

}//end of adding chapters and pages 


if(isset($_POST['new_comic'])){ 

    if(empty($_POST['checkComicName'])){ 
        array_push($comicError, 'The Comic name is empty.');
    }
    
    $new_comic_name = $_POST['checkComicName']; 
    $AuthorID = $_SESSION['id']; 
    var_dump($AuthorID); 
    var_dump($new_comic_name);
    $comic_check_query = "SELECT ComicTitle FROM `Comics` WHERE ComicTitle='$new_comic_name'";
    $comicResults = mysqli_query($db, $comic_check_query); 
    $comics=mysqli_fetch_assoc($comicResults);  

    if($comics){ 
        var_dump($comics);
        array_push($comicError, "The Comic Already exists");
    }else{ 
        $comic_insert = "INSERT INTO `Comics` (`ComicTitle`, `AuthorID`) VALUES ('$new_comic_name', '$AuthorID')";
        mysqli_query($db, $comic_insert); 
    }

 
    

    
    }