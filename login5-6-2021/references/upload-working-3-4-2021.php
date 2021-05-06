<?php 

if(isset($_POST['submit'])){ 
    //first need to get information of the file/////////////////////////
    $file = $_FILES['file']; //name on uploadform, 
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];//temporary location of file before upload
    $fileSize = $_FILES['file']['size']; //size of file
    $fileError = $_FILES['file']['error'];  //errors if any
    $fileType = $_FILES['file']['type']; //file type/extension
    print_r($file); //shows array of file information
    //print_r('here it is '.$fileName); prints file name
    
    //getting the name of file and extension. explode() seperates strings on '.'
    $fileExt = explode('.', $fileName);//print_r($fileExt); returns array 
    $fileActualExt = strtolower(end($fileExt)); //end() gets last item of array 

    //create array of file extensions we want to allow in website///////////
    $allowed = array('jpg', 'jpeg', 'png', 'pdf'); 

    //if() to check if files uploaded are what we allow 
    //create array in if() that takes two parameters and checks if the $fileActualExt is inside the $allowed array
    if(in_array($fileActualExt, $allowed)){ 
        //nested if statement to check if there were errors 
        if($fileError == 0){ 
            //if() to check file size
            if($fileSize < 1000000){ 
                //where we upload file if extension allowed, errors = 0, size is enough
                //get unique file name
                $fileNameNew = uniqid('', true).".".$fileActualExt; //gets time format in microseconds
                //tell where to upload after we have unique file name
                $fileDestination = "uploads/" . $fileNameNew;
                /*
                    now creating function that takes the uploaded file from its 
                   file from its temperary location that we stored in $fileTmpName, and store it in its location 
                   that we have designated in $fileDestination. 
                */
                move_uploaded_file($fileTmpName, $fileDestination); //where file is stored, and where we want to store new file
                header("Location: comics.php?upload=success");
            
            }else{ 
                echo 'your file is to big';
            }//END OF FILE SIZE CHECK
        }else { 
            echo "There was an error uploading your file"; 
        }//END OF ERROR CHECK
    }else{ 
        //echo's message if $fileActualExt does not match the extensions in the $allowed array
        echo 'you can not upload files of this type'; 
    }//END OF EXTENSION CHECK

    
}//END POST