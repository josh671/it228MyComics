<?php include('./uploadhandler.php');
//if(!isset($_SESSION['userName'])){            //if username has not been set
//      $_SESSION['msg'] = 'You must log in first';              //You must log in first 
//      header('Location: login.php');                           //redirect to log in page 
//  } 
//  
//  if(isset($_GET['logout'])){                                 //if we want them to log out they must be redirected to logout
//      session_destroy();                                      //we destroy the session 
//      unset($_SESSION['userName']);                           //unset sessions username 
//      header('Location: index.php');                          //redirect to the login page now that username session has ended
//  
//  } 
      include('./includes/header.php'); 
      include('./includes/nav.php'); 

      
?>


<!-- /////////////////////////// START OF HTML FOR UPLOADFORM ///////////////////////////////////////////// -->

<div id="loggedon">
<?php 
 //   if(isset($_SESSION['userName'])) : ?> 
    <h3> Welcome, 
        <?php
           echo  $_SESSION['userName']; ?>
   </h3>
    <br> 
<!-- position on left side -->
  <p><a href="chapters.php ">Log out</a></p>
    
    <?php  //endif     ?> 
<div id="uploadwrapper">
<h1>Here is where you will be able to upload your comic files</h1> 

<!-- enctype="multipart/form-data" allows us to pass on multi forms of data like images, files, etc-->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data"> 
    <fieldset>
        <label>Chapter Name</label> 
        <input type="text" name="chapterName" value="<?php if(isset($_POST['chapterName'])) echo  $_POST['chapterName']  ?>"> 
    
        <label>Chapter Number</label> 
        <input type="number" name="chapterNumber" value="<?php if(isset($_POST['chapterNumber'])) echo  $_POST['chapterNumber']  ?>"> 
        
        <label>Page Number</label> 
        <input type="number" name="pageNumber" value="<?php if(isset($_POST['pageNumber'])) echo  $_POST['pageNumber']  ?>"> 
        

        


        <input type="file" name="file">
        <button type='submit' name="submit">Upload File</button>
    
    <!-- <?php if(count($error) > 0) : ?> 

    <div class="error"> 
    <?php
    
    print(count($error)); 
    foreach($error as $error) : ?>
    <p> <?php echo $error; ?>  </p>
    <?php endforeach; ?>
    </div> end error div  -->

<?php endif ?> 
        
        
    </fieldset>
</form> 

</div>




</body>
</html>