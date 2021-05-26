<?php include('./includes/config.php'); ?> 
<?php include('./includes/header.php'); ?> 
<?php include('./includes/nav.php'); 

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('initial host connection problems'); ?>

<div id="container">
<h1 id="authors_header">Here are a list of Authors</h1> 

<div class="row">

    <?php 
      //$sql = 'SELECT Authors.AuthorID, Authors.AuthorUserName, Comics.ComicTitle FROM Authors INNER JOIN Comics on Comics.AuthorID = Authors.AuthorID '; 
     $sql = 'SELECT * FROM `Authors`'; 
     $iConn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(myerror( __File__, __LINE__, mysqli_connect_error())); 
     $result = mysqli_query($iConn,$sql) or die(myerror( __File__, __LINE__, mysqli_connect_error())); 
   //start of database table 
   
   //  
   //  
   if(mysqli_num_rows($result) > 0){ 
                 
           while ($row = mysqli_fetch_assoc($result) ){ 
             $authorid=$row['AuthorID'];
             $comic_check_query = "SELECT * FROM Comics WHERE Comics.AuthorID= $authorid;";
             $comicResults = mysqli_query($db, $comic_check_query); 
             $comics=mysqli_fetch_all($comicResults);  
              
             

             
             echo '<div id="responsive_col" class="col-4" >
             <div class="inside shadow">';
           
                echo '<img class="rounded-circle z-depth-2" alt="100x100" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg"
                   data-holder-rendered="true">';
                echo '<p class="link"><a href="comics-views.php?id='.$row['AuthorID'].'" >Check out <strong>'.$row['AuthorUserName'].'</strong> Comics!</a></p>'; 
                echo '<p class="description">'.$row['AuthorDescription'].'</p>';
                echo '<p class="comic_total">Total Comics: '.count($comics).'</p>'; 
                echo '</div></div>'; 
                                 }

                     }else {//what if there are no people 
                       echo 'There are no Appointments'; 
                   }//closing else 
                   //release the web server 
                   @mysqli_free_result($result); 
                   //  close connection 
                   @mysqli_close($iConn); 

    ///////////////////////////////////////////////////////////////////////////////
    ?>
   

</div>



</div> <!-- end container -->


</body>
</html>