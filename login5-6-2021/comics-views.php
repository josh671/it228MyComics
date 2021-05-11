<?php include('./includes/config.php'); 
if(isset($_GET['id'])) { 
    $id = (int)$_GET['id']; 
    var_dump($id); 
}   else    { 

    header('Location: authors.php');

} 

include('./includes/header.php'); 
include('./includes/nav.php');  
?>

<div id="container">
<h1>Here are a list of Comics</h1> 
<div class="row">
<?php 

$sql = "SELECT * FROM Comics WHERE Comics.AuthorID = '$id'"; 
$iConn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(myerror( __File__, __LINE__, mysqli_connect_error()));
$result = mysqli_query($iConn,$sql) or die(myerror( __File__, __LINE__, mysqli_connect_error())); 

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
         echo '<p class="link"><a href="chapters-views.php?id='.$row['ComicID'].'" >Check out this Comics!</a></p>'; 
         echo '<p class="userName">' . $row['ComicTitle'] . '</p>'; 
         echo '<p class="userName">' . $row['ComicDescription'] . '</p>'; 
         echo '<p class="userName">' . $row['ComicID'] . '</p>'; 
         echo '</div></div>'; 
                          }

              }else {//what if there are no people 
                echo 'There are no Appointments'; 
            }//closing else 
            //release the web server 
            @mysqli_free_result($result); 
            //  close connection 
            @mysqli_close($iConn); 


?>




</div>
</div>
