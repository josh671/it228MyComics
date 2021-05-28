<?php 
session_start();
include('./includes/config.php'); 

//declare errors 
$error = array(); 
$pagesError = array(); 
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

   

    $AuthorID = intval($_SESSION['id']);  
    
    $file=$_FILES['file']; 
    $fileName=$_FILES['file']['name']; 
    $fileSize=$_FILES['file']['size']; 
    $fileError=$_FILES['file']['error']; 
    $fileTmpName=$_FILES['file']['tmp_name']; 
    $comicTitle=$_POST['comicName']; 
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

    if($picPageNumber!= 0){ 
        array_push($error, 'Page Number for the Chapters Cover Art has to be 0. (chapterNumber-0'); 
    }
    
//SET QUERY TO GET COMICS SHIT TO PUT INTO TABLES
    $comic_check_query = "SELECT * FROM `Comics` WHERE ComicTitle='$comicTitle'";
    $comicResults = mysqli_query($db, $comic_check_query); 
    $comics=mysqli_fetch_array($comicResults);  


    $comicID = intval($comics['ComicID']); 
    //var_dump($comicID); 
    if(Null == $comics){ 
        array_push($error, 'comic dont exist'); 
    }

    //set of if statements to check if 
        //extension allowed 
        //errors happened 
        //file size 
        //if not take temporary upload and save to images 
    if(in_array($fileActualExt, $allowed)){ //checks array $allowed to see if extensions allowed
        if($fileError == 0){ 
            if($fileSize < 10000000){ 
                // do something 
                if(isset($chapterNumber) && (int)$chapterNumber == $picChapterNumber){     
                    //added if for error count
                    if(count($error) == 0 ){
                       
                        $check_comicchapters_query="SELECT * FROM Chapters WHERE chapterNumber ='$chapterNumber' AND ComicID='$comicID' LIMIT 1"; 
                        $check_comicchapters_result= mysqli_query($db, $check_comicchapters_query); 
                        $chapters = mysqli_fetch_array($check_comicchapters_result); 
                        $fileNameNew = $fileExt[0]."-". $comicID. ".".$fileActualExt; 
                        //var_dump($chapters); 
                        //var_dump(count($chapters)); 
                        //checks if chapterNumber and comicID exists if so dont push 
                        //if not, slap that bad boy into the table son! 
                        if($chapters){ 
                            array_push($error, "This chapter already exists for this comic."); 
                        }else{ 
                            $query1="INSERT INTO `Chapters` (`AuthorID`, `chapterNumber`, `ChapterName`, `ComicID`, `ChapCoverArt`) VALUES ('$AuthorID', '$chapterNumber', '$chapterName', '$comicID', '$fileNameNew')";
                            mysqli_query($db, $query1); 
                        }
                            //var_dump($fileExt[0]);
                            //var_dump($fileName);
                            
                            
                            
                            $fileDestination = 'images/'.$fileNameNew; 
                            
                            move_uploaded_file($fileTmpName, $fileDestination); 

                      
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

//START OF NEW PAGES HANDLER ////////////////////////////////////////////////////////////////////////
if(isset($_POST['new_pages'])){ 

    if(empty($_POST['pagesCheckComicName'])){ 
        array_push($pagesError, 'You must enter the Name of the comic you wish to add pages and chapters too!'); 
    }

    if(empty($_POST['pagesChapterNumber'])){ 
        array_push($pagesError, "chapter Number is empty."); 
    }

    if(empty($_POST['pagesPageNumber']) ){ 
        array_push($pagesError, "Empty Chapter Number.");
    }

   

    //variables 
    $AuthorID = intval($_SESSION['id']); 
    $pagesFile = $_FILES['pages_file']; 
    $fileName=$_FILES['pages_file']['name']; 
    $fileSize=$_FILES['pages_file']['size']; 
    $fileError=$_FILES['pages_file']['error']; 
    $fileTmpName=$_FILES['pages_file']['tmp_name']; 
    $pagesComicTitle=$_POST['pagesCheckComicName']; 
    $pagesChapterNumber=$_POST['pagesChapterNumber']; 
    $pagesPageNumber=$_POST['pagesPageNumber'];  
    //variables for file extensions 
    $fileExt = explode('.', $fileName); 
    $fileActualExt = strtolower(end($fileExt)); //want the extension which is last item of $fileExt array; 
    $allowed = array('jpg', 'jpeg', 'png'); 
    $fileChapPageNum =$fileExt[0]; 
    //getting chapter name and file name 
    $fileChapterNameAndPages = strtolower(reset($fileExt)); 
    $chapterAndPagesArray = explode('-',$fileChapterNameAndPages); 
    $picChapterNumber = strtolower(reset($chapterAndPagesArray));
    $picPageNumber = strtolower(end($chapterAndPagesArray)); 


    if($pagesChapterNumber != $picChapterNumber){
        array_push($pagesError, "The chapter number you entered does not match the chapter number of the photo");
    }

    if($pagesPageNumber != $picPageNumber){ 
        array_push($pagesError, 'Page Number entered does not match Pic page number'); 
    }
     

    //SET QUERY TO GET COMICS SHIT TO PUT INTO TABLES
    $comic_check_query = "SELECT * FROM `Comics` WHERE ComicTitle='$pagesComicTitle'";
    $comicResults = mysqli_query($db, $comic_check_query); 
    $comics=mysqli_fetch_array($comicResults);  



    $comicID = intval($comics['ComicID']); 
    //var_dump($comicID); 
    if(Null == $comics){ 
        array_push($pagesError, 'comic dont exist'); 
    }
    if($AuthorID !== intval($comics['AuthorID'])){ 
        array_push($pagesError, 'Your ID and the Comics Author ID dont match'); 
    }
    // set of if's to check extensions, errors, filesize 
    if(in_array($fileActualExt, $allowed)){ //checks array $allowed to see if extensions allowed
        if($fileError == 0){ 
            if($fileSize < 10000000){ 
                // do something 
                var_dump($pagesChapterNumber);
                if(isset($pagesChapterNumber) && (int)$pagesChapterNumber == $picChapterNumber){     
                    var_dump($picChapterNumber); 
                    
                    //added if for error count
                    if(count($pagesError) == 0 ){
                       
                        //check if page associated with chapter and comic id exist 
                        $check_pagechapter_query = "SELECT * FROM Pages WHERE pageNumber='$picPageNumber' AND chapterNumber='$pagesChapterNumber' AND comicID='$comicID' LIMIT 1"; 
                        $check_pagechapter_result = mysqli_query($db, $check_pagechapter_query); 
                        $pages = mysqli_fetch_array($check_pagechapter_result);
                        
                        

                        //check if page associated with chapter and comic already exists 
                        //if not, add to pages table with appropriate page number, chapter number, and comicID
                        if($pages){ 
                            array_push($pagesError, "This page and chapter already exists for this comic and author"); 
                        }else{ 
                            $fileNameNew = $fileExt[0]."-". $comicID. ".".$fileActualExt; 
                            $query2="INSERT INTO `Pages` (`chapterNumber`, `pageNumber`, `imageName`, `comicID`) VALUES ('$pagesChapterNumber', '$picPageNumber', '$fileNameNew', '$comicID')"; 
                            mysqli_query($db, $query2); 
                        }

                            //var_dump($fileExt[0]);
                            //var_dump($fileName);
                            
                            
                            $fileNameNew = $fileExt[0]."-". $comicID. ".".$fileActualExt; 
                            $fileDestination = 'images/'.$fileNameNew; 
                            
                            move_uploaded_file($fileTmpName, $fileDestination); 

                      
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

}//end of isset for pages form 




//START OF NEW COMICS HANDLER///////////////////////////////////////////////////////////////////////
if(isset($_POST['new_comic'])){ 

    if(empty($_POST['checkComicName'])){ 
        array_push($comicError, 'The Comic name is empty.');
    }
    if(!strlen(trim($_POST['comicDescription']))){ 
        array_push($comicError, 'Please describe your comic.');
    }
    
    $new_comic_name = $_POST['checkComicName']; 
    $new_comic_description = $_POST['comicDescription']; 
    $AuthorID = $_SESSION['id']; 
    
    $comic_check_query = "SELECT ComicTitle FROM `Comics` WHERE ComicTitle='$new_comic_name'";
    $comicResults = mysqli_query($db, $comic_check_query); 
    $comics=mysqli_fetch_assoc($comicResults);  

    $file=$_FILES['cover_art_file']; 
    $fileName=$_FILES['cover_art_file']['name']; 
    $fileSize=$_FILES['cover_art_file']['size']; 
    $fileError=$_FILES['cover_art_file']['error']; 
    $fileTmpName=$_FILES['cover_art_file']['tmp_name']; 
    $comicTitle=$_POST['comicName']; 

    
    $fileExt = explode('.', $fileName); 
    $fileActualExt = strtolower(end($fileExt)); //want the extension which is last item of $fileExt array; 
    $allowed = array('jpg', 'jpeg', 'png'); 
    //getting chapter name and file name 
    $fileChapterNameAndPages = strtolower(reset($fileExt)); 
    $comics_coverName = explode('-',$fileChapterNameAndPages); 
    $comic_cover1=$comics_coverName[0];
    $comic_cover2=$comics_coverName[1];
    if((int)$comic_cover1 != 00){
        array_push($comicError, "Numbers need to be 00");
    }

    if((int)$comic_cover2 != 00){ 
        array_push($comicError, 'Numbers need to be ))'); 
    }
     

 if(in_array($fileActualExt, $allowed)){ //checks array $allowed to see if extensions allowed
        if($fileError == 0){ 
            if($fileSize < 10000000){ 
                // do something 
    
    if($comics){ 
        var_dump($comics);
        array_push($comicError, "The Comic Already exists");
    }else{ 
    $new_comic_description = $_POST['comicDescription']; 
        $comic_insert = "INSERT INTO `Comics` (`ComicTitle`, `AuthorID`, `ComicDescription`, `ComicCoverArt`) VALUES ('$new_comic_name', '$AuthorID', '$new_comic_description', '$fileName')";
        mysqli_query($db, $comic_insert); 
           
                   
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