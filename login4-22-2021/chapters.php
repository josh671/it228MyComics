<?php include('./includes/config.php'); ?> 
<?php include('./includes/header.php'); ?> 
<?php include('./includes/nav.php'); ?>

<div id="wrapper">
<h1>Here are a list of my Comics</h1> 

   <!-- START OF TABLE DIV -->
   <div id="chap_table">
        <?php //start php 
              //connection to database
                $sql = 'SELECT * FROM Chapters'; 
                $iConn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(myerror( __File__, __LINE__, mysqli_connect_error())); 
                $result = mysqli_query($iConn,$sql) or die(myerror( __File__, __LINE__, mysqli_connect_error())); 
              //start of database table 
              if(mysqli_num_rows($result) > 0){ 
                
                      echo '<table id="chapters_table">'; 
                                echo '<tr>';
                                echo '<th class="th_one">Chapter Names and Numbers</th>'; 
                                echo '<th >Date Added</th>'; 
                                echo '</tr>';
                      //start of while loop 
                
                      while ($row = mysqli_fetch_assoc($result) ){ 
                                                
                                                                  echo '<tr>'; 
                                                                  echo '<td class="link"><a href="chapter-view.php?id='.$row['chapterNumber'].'" >'.$row['chapterNumber'].' '.$row['Description'].' </a>';'</td>';
                                                                  echo '</tr>';
 
                                            }

                                }


                                
                              
                        //now to show contents of result 
                       //'<tr>'; 
                       //   echo '<td><a href="chapter-view.php?id='.$row['chapterNumber'].'" >'.$row['chapterNumber'].'   '.$row['Description'].' </a>';'</td>'; 
                       //'</tr>'; 
                        
        

                ?>
                </table>

</div><!-- END TABLE -->



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