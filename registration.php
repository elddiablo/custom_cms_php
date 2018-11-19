<?php include 'includes/header.php'; ?>

<!------ Include the above in your HEAD tag ---------->
<?php include 'includes/navigation.php'; ?>


<?php 

      if (isset($_POST['sign_up'])) {
        

          $new_username = $_POST['username'];
          $new_email = $_POST['email'];
          $new_password = $_POST['password'];
          $new_password_confirm = $_POST['password_confirm'];

          $new_username = mysqli_real_escape_string($con, $new_username);
          $new_email = mysqli_real_escape_string($con, $new_email);
          $new_password = mysqli_real_escape_string($con, $new_password);
          $new_password_confirm = mysqli_real_escape_string($con, $new_password_confirm);


          $query = "SELECT user_randSalt FROM users";

          $select_randSalt_query = mysqli_query($con, $query);

          confirm_query($select_randSalt_query);

          while ($row = mysqli_fetch_array($select_randSalt_query)) {
              $salt = $row['user_randSalt'];
              $new_password = crypt($new_password, $salt);
          }


          $query = "INSERT INTO users(username, user_password, user_email, user_role) "; 

          $query .= "VALUES ('$new_username', '$new_password', '$new_email', 'subscriber')";

          $create_user_query = mysqli_query($con, $query);

          confirm_query($create_user_query);

          



      }
  

 ?>


<div class="container" style="width: 40em;">

  <?php if(isset($_POST['sign_up'])){ ?>

    <div class="alert alert-success" role="alert">User has been successfully created</div>

  <?php } ?>

  <div class="well no_transition"  style="margin: 0 auto; margin-bottom: 4em;">

    <form class="form-horizontal" action='' method="POST" class="registration_form">
      
        <div id="legend">
          <h1>Register</h1>
          <hr>
        </div>
        <div class="control-group">
          <!-- Username -->
          <label class="control-label"  for="username">Username</label>
          <div class="controls">
            <input type="text" id="username" name="username" placeholder="" class="form-control" required>
            <p class="help-block">Username can contain any letters or numbers, without spaces</p>
          </div>
        </div>
     
        <div class="control-group">
          <!-- E-mail -->
          <label class="control-label" for="email">E-mail</label>
          <div class="controls">
            <input type="text" id="email" name="email" placeholder="" class="form-control" required>
            <p class="help-block">Please provide your E-mail</p>
          </div>
        </div>
     
        <div class="control-group">
          <!-- Password-->
          <label class="control-label" for="password">Password</label>
          <div class="controls">
            <input type="password" id="password" name="password" placeholder="" class="form-control" required>
            <p class="help-block">Password should be at least 4 characters</p>
          </div>
        </div>
     
        <div class="control-group">
          <!-- Password -->
          <label class="control-label"  for="password_confirm">Password (Confirm)</label>
          <div class="controls">
            <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="form-control" required>
            <p class="help-block">Please confirm password</p>
          </div>
        </div>
     
        <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <button class="btn btn-success btn-lg" name="sign_up">Register</button>
          </div>
        </div>
      
    </form>
  </div>
</div>
<?php include 'includes/footer.php'; ?>