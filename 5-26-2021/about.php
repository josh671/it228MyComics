<?php include('./includes/config.php'); 
      include('./includes/header.php'); 
      include('./includes/nav.php'); ?>

<div class="about_container">
    <h1>Welcome to MyComics</h1> 
    <div id='mission_statement'>
        <p>Here at MyComics we pride ourselves at being the first free site for both amatuer and professional Comic Writers. 
Whether your new to comic writing or just looking for a platform to post personal work then MyComics is the place for you. 
Our easy to use registration and upload system will ensure that the comics you want to share are placed on the internet with ease. 
Our simple system will allow you to post as many differenct comics with as many pages as you want.</p>
    </div>
<div id="about_instructions">
    <div id="about_instructions_nav">
        <ul> 
            <li class="instructions_nav_active" id="reg">Register</li> 
            <li id="upl">Upload</li> 
            <li id="warn">Warnings</li> 
        </ul>
    </div>

    <div id="one" class="column instructions_active">
        <h2>Registering as A User</h2>
        <p>In order to post a new comic you must first register the Comic with our 'Comics Form'. </p> 
        <p>After Registering with MyComics you will be taken to a log in page. Please remember your login and password as it is the only way to access the upload form. 
            This form will allow you to register your comics and upload the chapters and pages associated with that comic. For more information 
            please see the "Upload Instructions" by clicking the tab above.</p>

    </div>
    <div id="two" class="column">
    <h2>Registering a New Comic</h2>
    <p> If you are looking to add a New Comic to Your account, you must first register the comic with the "Register Comic" form. 
        The form will take the name of your comic and save it to our database. Please Note that the form is both space and caps sensitive. 
        So if your Comics Name is "heroes" it will not recognize "Heroes" or "hErOes". Numbers are okay and special characters are okay. 
        
    <h2>Adding a New Chapter to Your Comic</h2>
    <p>If you are looking to add a new chapter to a registered comic or starting your first chapter to the registered
					comcic, you must first fill out the new chapter form. The form will ask that you list the name of the comic,
					the chapter Number that you wish to enter, followed by the cover art for the chapter. </p>
    
    <p>Please note that the file name for the chapters cover art must be a specific format. It goes "chapter Number": "Page Number". 
        All page numbers for cover art must be 00. <strong>Example:</strong> "01-00.jpg". This example refrences chapter 1 and page 00. If the format 
        is not the same as the one listed, you will recieve a warning explaining what went wrong. </p>

    <h2>Adding pages for each chapter</h2>
    <p> As listed above, the form for adding pages and their comic strips are the same. You must first list the chapter number followed by the 
        page number. <strong>Example</strong>"01-01.jpg" The example refers to chapter 1 page 1 and the file type is jpg. Due to the many number 
        of picture extensions we have decided to limit ours to only .jpg, .jpeg, and png. The form will ask for the case sensitive comic name, 
        the chapter it is associated with, and the page number you are uploading. Each part must match with the image being uploaded. If you are uploading 
        an image that is 01-01.jpg then the chapter number you must enter will be 1 and the page number you must enter will also be 1. This is to ensure that each 
        chapter and their pages are matched to the respective photos in our database. 
    </div>
    <div id="three" class="column">
    <h2>Warnings</h2>
    <p>When adding Comics, Chapters, or Pages; please follow the instructions above. Failure to do so will result in nothing being saved and will trigger a list of warnings. 
        Each warning will display the corrections needed in order to upload your files. The instructions are fairly simple and will save you from uploading uncessary files and 
        pictures. </p>
    </div>

</div><!--End of about instructions  -->
<div id="registration_link">
<h2>Would you Like to register as a New User?</h2> 
<a href="registerform.php">Register Here!</>


</div>


</div><!--END of about-container  -->





</body>
</html>