<?php include 'includes/admin_header.php'; ?>

    <div id="wrapper">
    
        <?php include 'includes/admin_navigation.php'; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Profile
                            <small>

                            <?php 

                                if (isset($_SESSION['username'])) {
                                    echo $_SESSION['username'];
                                    $session_username = $_SESSION['username'];
                                }

                             ?>
                                 
                             </small>
                        </h1>

                        <?php 


                                // Find the user
                                $query = "SELECT * FROM users WHERE username='{$session_username}'";
                                $edit_get_data_to_query = mysqli_query($con, $query);
                                confirm_query($edit_get_data_to_query);

                                // get the data out of the found user
                                while ($row = mysqli_fetch_assoc($edit_get_data_to_query)) {
                                    $username = $row['username'];
                                    $user_password = $row['user_password'];
                                    $user_firstname = $row['user_firstname'];
                                    $user_lastname = $row['user_lastname'];
                                    $user_email = $row['user_email'];
                                    $user_role = $row['user_role']; 
                                }
                                    
                                

                            
                         ?>


                        <div class="container">
                            <div class="jumbotron">
                                <h1>User: <?php echo $username ?></h1>
                                <form action="" method="post" enctype="multipart/form-data">
                                    
                                    <div class="form-group">
                                      <label for="post_title">username</label>
                                      <input type="text" class="form-control" placeholder="username" name="username" value="<?php echo $username; ?>">
                                    </div>
                                    <div class="form-group">
                                      
                                      <select name="user_role" id="user_role">

                                        
                                        
                                        <option value="<?php echo $user_role; ?>">
                                            <?php 
                                                    echo $user_role;
                                             ?>
                                         </option>
                                        
                                            <?php 
                                                findAllRoles_without($user_role);
                                             ?>
                                        
                                        
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="post_status">user_firstname</label>
                                      <input type="text" class="form-control" placeholder="user_firstname" name="user_firstname" value="<?php echo $user_firstname; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="post_tags">user_lastname</label>
                                      <input type="text" class="form-control" placeholder="user_lastname" name="user_lastname" value="<?php echo $user_lastname; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="post_image">User logo img</label>
                                      <input type="file" name="post_image" value="<?php echo $user_image; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="post_content">user_email</label>
                                      <input type="text" class="form-control" placeholder="user_email" name="user_email" value="<?php echo $user_email; ?>">
                                    </div>
                                     <div class="form-group">
                                      <label for="post_content">user_password</label>
                                      <input id="user_password" style="width: 95%; display: inline-block;" type="password" class="form-control" placeholder="user_password" name="user_password" value="<?php echo $user_password; ?>" >
                                      <span style="width: 5%;" id="show_button">Show</span>
                                    </div>

                                    <input type="submit" class="btn btn-primary btn-md " value="Update a Profile" name="edit_profile_user">
                                </form>
                            </div>
                        </div>
                            
                        <?php 

                            if(isset($_POST['edit_profile_user'])){


                                $username = $_POST['username'];
                                $user_role = $_POST['user_role'];
                                $user_firstname = $_POST['user_firstname'];
                                $user_lastname = $_POST['user_lastname'];
                                $user_email = $_POST['user_email'];
                                $user_password = $_POST['user_password'];




                                $query = "SELECT user_randSalt FROM users";

                                $select_randSalt_query = mysqli_query($con, $query);

                                confirm_query($select_randSalt_query);

                                $row = mysqli_fetch_array($select_randSalt_query);
                                
                                $salt = $row['user_randSalt'];

                                $hashed_password = crypt($user_password, $salt);

                                // ======FOR==IMAGE====== // 

                                // $user_image_new = $_FILES['user_image']['name'];
                                // $user_image_temp_new = $_FILES['user_image']['tmp_name'];
                                // move_uploaded_file($user_image_temp_new, "../images/$user_image_new");
                                
                                // if(empty($user_image_new)){
                                //  $query = "SELECT * FROM users WHERE user_id={$edit_user_id}";
                                //  $select_image = mysqli_query ($con, $query);
                                //  while ($row = mysqli_fetch_assoc($select_image)) {
                                //      $user_image_new = $row['user_image'];
                                //  }


                                $query = "UPDATE users SET ";
                                $query .= "username = '{$username}', ";
                                $query .= "user_role = '{$user_role}', ";
                                $query .= "user_firstname = '{$user_firstname}', ";
                                $query .= "user_lastname = '{$user_lastname}', ";
                                $query .= "user_password = '{$hashed_password}', ";
                                $query .= "user_email = '{$user_email}' WHERE username = '{$session_username}'";

                                $edit_user_query = mysqli_query($con, $query);

                                confirm_query($edit_user_query);

                                header("Location: profile.php");
                            }
                            

                         ?>




    
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>



<script>
    var isClicked = true;
    document.getElementById("show_button").addEventListener('click', () => {
            
        if (isClicked) {
            document.getElementById("user_password").setAttribute('type', 'text');
            document.getElementById("show_button").innerHTML = "Hide";
            isClicked = false;
        } else if(!isClicked){
            document.getElementById("user_password").setAttribute('type', 'password');
            document.getElementById("show_button").innerHTML = "Show";
            isClicked = true; 
        }
        
        // console.log("clicked");
    }) ;
</script>
        <!-- /#page-wrapper -->
<?php include 'includes/admin_footer.php'; ?>