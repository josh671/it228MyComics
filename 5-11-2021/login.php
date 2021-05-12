<?php include('./handlers/registerhandler.php'); ?>
<?php include('./includes/header.php'); ?> 
<header>
</header>

<h1>Login form</h1> 
<div id="login_form">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>" method="post"> 
        <fieldset>
            <label>Enter your User Name</label>
            <input type="text" name="userName" value="<?php if(isset($_POST['userName'])) echo  $_POST['userName'] ?>"> 

            <label>Password</label>
            <input type="password" name="password"> 

            <button type="submit" name="login_user">login</button>
        </fieldset>
    </form>

</div> 

<?php if(count($Log_error) > 0) : ?> 

<div class="error"> 
<?php
print(count($Log_error)); 
foreach($Log_error as $error) : ?>
<p> <?php echo $error; ?>  </p>
<?php endforeach; ?>
</div> <!--end error div --> 

<?php endif ?> 

</body> 
</html> 