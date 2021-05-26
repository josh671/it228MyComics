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
<div class="row" id="chapRowContainer">
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
      

      
         echo '<div class="w3-col l3 m3 s12" id="chapRows">
         <div class=" shadow chapter_number_containers">';
         
         echo '<p class="chapDisplay">' . $row['chapterNumber'] .': '. $row['ChapterName'] .  '</p>'; 
         echo '<div class="chapDisplay"><img src="images/'.$row['ChapCoverArt'].'"></div>'; 
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
<h2 id="chapters_header">Checkout this Chapters pages</h2>
<!-- START OF PAGES FOR COMIC -->
<?php 
$sql ="SELECT * FROM `Pages` WHERE `comicID` = '$comicID' ORDER BY `chapterNumber`, `pageNumber` "; 
$iConn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(myerror( __File__, __LINE__, mysqli_connect_error()));
$result = mysqli_query($iConn,$sql) or die(myerror( __File__, __LINE__, mysqli_connect_error())); 
//var_dump($result);
if(mysqli_num_rows($result) > 0){ 
                 
    while ($row = mysqli_fetch_assoc($result) ){ 
      $comicID=(int)$row['ComicID'];
     
      
        echo '<div id="images_boxes"  >
              <div class=" shadow">';
         echo '<p class="userName">Chapter: ' . $row['chapterNumber'] . ':'. $row['pageNumber'].'</p>'; 
         echo '<div id="image_container">';
         echo '<img id="comic_page_image" src="images/'.$row['imageName'].'">';
         echo '</div>'; 
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
