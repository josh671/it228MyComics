<?php include ('./upload.php'); ?>
<?php include('./includes/header.php'); ?> 

<div id="wrapper">
<h1>Here is where you will be able to upload your comic files</h1> 

<!-- enctype="multipart/form-data" allows us to pass on multi forms of data like images, files, etc-->
<form action="upload.php" method="POST" enctype="multipart/form-data"> 

    <label>Chapter Name</label> 
    <input type="text" name="chapName" value="<?php if(isset($_POST['chapName'])) echo  $_POST['chapName']  ?>"> 

    <label>Description</label> 
    <input type="text" name="description" value="<?php if(isset($_POST['chapName'])) echo  $_POST['description']  ?>"> 
    
    
    <input type="file" name="file">
    <button type='submit' name="submit">Upload File</button>


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