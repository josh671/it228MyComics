<?php include('./includes/config.php'); ?> 
<?php include('./includes/header.php'); ?> 
<?php include('./includes/nav.php'); 

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('initial host connection problems'); ?>

<div id="container">
<h1>Here are a list of my Comics</h1> 

   <!-- START OF TABLE DIV -->
   <div id="auth_table">
        <?php //start php 
         //    //connection to database
         //      $sql = 'SELECT * FROM Authors'; 
         //      $iConn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(myerror( __File__, __LINE__, mysqli_connect_error())); 
         //      $result = mysqli_query($iConn,$sql) or die(myerror( __File__, __LINE__, mysqli_connect_error())); 
         //    //start of database table 
         //    if(mysqli_num_rows($result) > 0){ 
         //      
         //            echo '<table id="authors_table">'; 
         //                      echo '<tr>';
         //                      echo '<th class="th_one">Chapter Names and Numbers</th>'; 
         //                      echo '<th >Date Added</th>'; 
         //                      echo '</tr>';
         //            //start of while loop 
         //      
         //            while ($row = mysqli_fetch_assoc($result) ){ 
         //                                      
         //                               echo '<tr>'; 
         //                               echo '<td class="link"><a href="chapter-view.php?id='.$row['AuthorID'].'" > '.$row['AuthorUserName'].' </a>';'</td>';
         //                               echo '</tr>';
 
         //                                  }

         //                      }
        

         //      ?>
                </table>

</div><!-- END TABLE -->


<div class="row">
    <div class="col-sm-3" >
          <div class="inside shadow">
          <img class="rounded-circle z-depth-2" alt="100x100" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg"
          data-holder-rendered="true">
          <p class='userName'>User Name.</p>
          <p class='description'>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a . </p>
          <p class='comic_total'>Amount of Comics: 2</p> 
          </div>
    </div>




<!-- END OF TEST COL-SM-3 -->
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
              
             

             
             echo '<div class="col-sm-3" >
             <div class="inside shadow">';
           
                echo '<img class="rounded-circle z-depth-2" alt="100x100" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg"
                   data-holder-rendered="true">';
                echo '<p class="link"><a href="chapter-view.php?id='.$row['AuthorID'].'" >Check out this Authors Comics!</a></p>'; 
                echo '<p class="userName">' . $row['AuthorUserName'] . '</p>'; 
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
    <div class="col-sm-3" style="background-color:lavenderblush;"> 
        <div class="inside">
        </div>.col-sm-3
    </div>

    <div class="col-sm-3" style="background-color:lavender;">
          <div class="inside">
          </div>.col-sm-3
    </div>

    <div class="col-sm-3" style="background-color:lavenderblush;">
      <div class="inside"></div>.col-sm-3
      </div>
    </div>

</div>



</div> <!-- end wrapper -->











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