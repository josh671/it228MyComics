<?php include('./handlers/registerhandler.php'); ?>
<?php include('./includes/header.php'); ?> 

<div id="login-form-container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
        <fieldset>
                <label>Email</label>
                <input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"> 

                <label>Email Type</label> 
                <select id="extensions" name="extensions">
                <option value="">No value</option>
                     <option value="@outlook.com">@outlook.com</option>
                     <option value="@gmail.com">@gmail.com</option>
                     <option value="@yahoo.com">@yahoo.com</option>
                </select>
                
                <label>User Name</label>
                <input type="text" name="userName" value="<?php if(isset($_POST['userName'])) echo $_POST['userName'];?>"> 
                
                <label>Password</label>
                <input type="text" name="password1" value="<?php if(isset($_POST['password1'])) echo $_POST['password1'];?>"> 
                
                <label>Confirm Password</label>
                <input type="text" name="password2" value="<?php if(isset($_POST['password2'])) echo $_POST['password2'];?>">

                <button type='submit' name="register_user">Register Now!</button>

 
    <?php if(count($Reg_error) > 0) : ?> 

                <div class="error"> 
                <?php
                print(count($Reg_error)); 
                foreach($Reg_error as $error) : ?>
                <p> <?php echo $error; ?>  </p>
                <?php endforeach; ?>
                </div> <!--end error div --> 

    <?php endif ?> 
        </fieldset>
    </form>





</div>








</body>
</html>