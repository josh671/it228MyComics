<?php include('./includes/config.php'); ?> 
<?php include('./includes/header.php'); ?>



<div class="wrapper">
<div id="appointment-intro">
<h1><?php echo $mainHeadline; ?></h1>
<p class='disclaimer'>"Please Note that the Names displayed are based on User Name. In order to view your appointment you must click on your <strong> User Name</strong>."</p>
<p class='disclaimer'>"If you have not set an appointment, Please visit our <a href="setAppt.php">Click Here!</a></p>
</div>



<div class="setAppointments">
<main>
<?php
$sql = 'SELECT * FROM BonkaiAppt'; //select from sql people table in database

$iConn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(myerror( __File__, __LINE__, mysqli_connect_error())); 
//we extract data here 

$result = mysqli_query($iConn,$sql) or die(myerror(__File__, __LINE__, mysqli_error()));
//if statement asking if we have rows. Do we have more than 0 rows, show me the records
if(mysqli_num_rows($result) > 0){ 
    //show the records 
    echo '<table id="people-table">'; //OPENNING OF TABLE
                echo '<tr>';
                echo '<th>User Name</th>'; 
                echo '<th>Details</th>';
                echo '</tr>';
    while($row = mysqli_fetch_assoc($result)){ 
        //this array will display the contents of your row 

                echo '<tr>'; 
                    echo '<td><a href="appointments-view.php?id='.$row['UserID'].' ">'.$row['UserName'].' </a>';'</td>';
                    echo '<td>'.$row['Date'].'</td>';
                echo '</tr>';
    }//closing the while();

//close the if statement
} else {//what if there are no people 
    echo 'There are no Appointments'; 
}//closing else 
//release the web server 
@mysqli_free_result($result); 
//  close connection 
@mysqli_close($iConn); 
                echo '</table>';    //END OF TABLE
?>

</main> 
<aside> 
<h3> Please note that all appointments are subject to change by videographer or photographer.</h3> 
</aside> 

</div><!--End of Appointments--> 




</div> <!--END WRAPPER-->     


<?php include('includes/footer.php'); ?>