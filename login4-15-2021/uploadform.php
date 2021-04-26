<?php include('./uploadhandler.php'); ?>
<?php include('./includes/header.php'); ?> 
<?php include('./includes/nav.php'); ?>

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
    
    <?php if(count($error) > 0) : ?> 

    <div class="error"> 
    <?php
    print(count($error)); 
    foreach($error as $error) : ?>
    <p> <?php echo $error; ?>  </p>
    <?php endforeach; ?>
    </div> <!--end error div --> 

<?php endif ?> 
        
        
    </fieldset>
</form> 

</div>



<!-- 
-create test database and try to echo into table 
-use appointments for reference 
-------------------------------
-first create disclaimer at top so you know the page 
        wrapper
        div for intro
        some p tags with statements or something

-set div for table 
-connect to sql database using select * from databaseName
-get $iconnect with the @mysqli_connect(DB_HOST, user, password , name ) or die(myerror(__FILE)); 





 -->



</body>
</html>