<?php include('./includes/config.php'); 
if(isset($_GET['id'])) { 
    
    $id = (int)$_GET['id']; 
 
}   else    { 

    header('Location: authors.php');

} 

include('./includes/header.php'); 
include('./includes/nav.php');  
?>

<div id="container">
<h1>Here are the chapters</h1> 
<div class="row">
<?php 

$sql = "SELECT * FROM Chapters WHERE ComicID = '$id'"; 
$iConn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(myerror( __File__, __LINE__, mysqli_connect_error()));
$result = mysqli_query($iConn,$sql) or die(myerror( __File__, __LINE__, mysqli_connect_error())); 
//var_dump($result);
if(mysqli_num_rows($result) > 0){ 
                 
    while ($row = mysqli_fetch_assoc($result) ){ 
      $comicID=(int)$row['ComicID'];
      $comic_check_query = "SELECT * FROM `Chapters` WHERE Chapters.ComicID= '$comicID'";
      $comicResults = mysqli_query($db, $comic_check_query); 
      $comics=mysqli_fetch_all($comicResults);  
       //var_dump($comics); 
      

      
         echo '<div class="col-sm-3" >
         <div class="inside shadow chapter_number_containers">';
         echo '<p class="userName">' . $row['chapterDescription'] . '</p>'; 
         echo '<p class="userName">' . $row['chapterNumber'] .': '. $row['ChapterName'] .  '</p>'; 
         echo '<p class="userName"><img src="uploads/'.$row['ChapCoverArt'].'"></p>'; 
         echo '</div></div>'; 
                          }

              }else {//what if there are no people 
                echo 'There chapters for this comic. '; 
            }//closing else 
            //release the web server 
            @mysqli_free_result($result); 
            //  close connection 
            @mysqli_close($iConn); 

?>
</div>
</div>

<div class="contain">
<div class="row chapters_pages">
<?php 

$sql ="SELECT * FROM `Pages` WHERE `comicID` = '$comicID' ORDER BY `chapterNumber`, `pageNumber` "; 
$iConn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(myerror( __File__, __LINE__, mysqli_connect_error()));
$result = mysqli_query($iConn,$sql) or die(myerror( __File__, __LINE__, mysqli_connect_error())); 
//var_dump($result);
if(mysqli_num_rows($result) > 0){ 
                 
    while ($row = mysqli_fetch_assoc($result) ){ 
      $comicID=(int)$row['ComicID'];
     
      
      echo '<div id="images_boxes"  >
      <div class="inside shadow">';
    
         
         echo '<p>Checkout this Chapters pages></p>'; 
         echo '<p class="userName">' . $row['chapterNumber'] . '</p>'; 
         echo '<p class="userName">' . $row['pageNumber'] . '</p>'; 
         echo '<img src="uploads/'.$row['imageName'].'">';
         echo '</div></div>'; 
                          }

              }else {//what if there are no people 
                echo 'There are Pages for This Chapter Yet!'; 
            }//closing else 
            //release the web server 
            @mysqli_free_result($result); 
            //  close connection 
            @mysqli_close($iConn); 


?>




</div>
</div>










</body> 
</html>
