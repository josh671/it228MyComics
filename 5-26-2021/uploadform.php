<?php include('./pagesChapterhandler.php');
      

if(!isset($_SESSION['id'])){            //if username has not been set
      $_SESSION['msg'] = 'You must log in first';              //You must log in first 
      header('Location: login.php');                           //redirect to log in page 
  } 
  
  if(isset($_GET['logout'])){                                 //if we want them to log out they must be redirected to logout
      session_destroy();                                      //we destroy the session 
      unset($_SESSION['id']);                           //unset sessions username 
      header('Location: index.php');                          //redirect to the login page now that username session has ended
  
  } 
      include('./includes/header.php'); 
      include('./includes/nav.php'); 

      
?>


<!-- /////////////////////////// START OF HTML FOR UPLOADFORM ///////////////////////////////////////////// -->

<div id="loggedon">
<?php 
 //   if(isset($_SESSION['userName'])) : ?> 
    <h3> Welcome, 
        <?php
           echo  $_SESSION['id'] . '<br>'; 
           echo  $_SESSION['AuthorUserName']; ?>
   </h3>
    <br> 
<!-- position on left side -->
  <p><a href="index.php">Log out</a></p>
    
    <?php  //endif     ?> 
<div class="form_container">
<!-- enctype="multipart/form-data" allows us to pass on multi forms of data like images, files, etc-->
<div class="row">

<!-- start of register comics form -->
<div class="col-4">
<form id="upload_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data"> 
    <fieldset>
    <h2>Starting a new Comic?</h2>
        <label>Comic Name</label> 
        <input type="text" name="checkComicName" value="<?php if(isset($_POST['checkComicName'])) echo  $_POST['checkComicName']  ?>" required> 
        
        <label>Description of Comic</label> 
        <textarea type="text" name="comicDescription" value="<?php if(isset($_POST['comicDescription'])) echo  $_POST['comicDescription']  ?>" required> </textarea> 

        <label>Cover art tag for Photo (must be one word)</label> 
        <input type="text" name="coverArt" value="<?php if(isset($_POST['coverArt'])) echo  $_POST['coverArt']  ?>" required> 

        <label>Comics Cover Art</label>
        <input type="file" name="cover_art_file">
        
    <button type='submit'  name="new_comic">Create new Comic</button>
    <?php if(count($comicError) > 0) : ?> 

    <div class="error"> 
        <?php

         foreach($comicError as $error) : ?>
    <p> <?php echo $error; ?>  </p>
        <?php endforeach; 
        ?>
    </div>   
        <?php endif ?> 

    </fieldset>
</form> 
</div>




<div class="col-4">
<form id="upload_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data"> 
    <fieldset>
    <h2>Adding Chapters Cover Art.</h2>
        <label>Comic Name</label> 
        <input type="text" name="comicName" value="<?php if(isset($_POST['comicName'])) echo  $_POST['comicName']  ?>"> 

        <label>Chapter Name</label> 
        <input type="text" name="chapterName" value="<?php if(isset($_POST['chapterName'])) echo  $_POST['chapterName']  ?>"> 
    
        <label>Chapter Number</label> 
        <input type="number" name="chapterNumber" value="<?php if(isset($_POST['chapterNumber'])) echo  $_POST['chapterNumber']  ?>"> 
        
        <label>Chapters Cover Art</label>
        <input type="file" name="file">
        <button type='submit' name="upload">Upload File</button>
    
                <?php if(count($error) > 0) : ?> 

            <div class="error"> 
                <?php

                 foreach($error as $error) : ?>
            <p> <?php echo $error; ?>  </p>
                <?php endforeach; 
                ?>
            </div>   
                <?php endif ?> 
    </fieldset>
</form> 
</div>

<!-- START OF PAGES FORM  -->
<div class="col-4">
<form id="upload_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data"> 
    <fieldset>
    <h2>Adding New Pages to Existing Comics?</h2>
        <label>Comic Name</label> 
        <input type="text" name="pagesCheckComicName" value="<?php if(isset($_POST['pagesCheckComicName'])) echo  $_POST['pagesCheckComicName']  ?>" > 
        
        <label>Chapter Number</label> 
        <input type="text" name="pagesChapterNumber" value="<?php if(isset($_POST['pagesChapterNumber'])) echo  $_POST['pagesChapterNumber']  ?>" > </inpur>
        
        <label>Page Number</label> 
        <input type="text" name="pagesPageNumber" value="<?php if(isset($_POST['pagesPageNumber'])) echo  $_POST['pagesPageNumber']  ?>" > </inpur>
        

        <input type="file" name="pages_file">
        <button type='submit' name="new_pages">Upload File</button>
        
       
    
    <?php if(count($pagesError) > 0) : ?> 

    <div class="error"> 
        <?php

         foreach($pagesError as $error) : ?>
    <p> <?php echo $error; ?>  </p>
        <?php endforeach; 
        ?>
    </div>   
        <?php endif ?> 

    </fieldset>
</form> 
</div>



</div>
</div>


</body>
</html>