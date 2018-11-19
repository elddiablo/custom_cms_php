<?php  ?>
<div class="panel panel-default">
    <div class="panel-heading"><span style="text-transform: uppercase;font-weight: bold;">All the users</span></div>
    <table class="table table-bordered table-hover">


                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Role</th>
                                    <th>to AD</th>
                                    <th>to SUB</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                    $query = "SELECT * FROM users";
                                    $select_posts_sidebar = mysqli_query($con, $query);

                                    while ($row = mysqli_fetch_assoc($select_posts_sidebar)) {  
                                        $user_id = $row['user_id'];
                                        $user_username = $row['username'];
                                        $user_firstname = $row['user_firstname'];
                                        $user_lastname = $row['user_lastname'];
                                        $user_email = $row['user_email'];
                                        $user_image = $row['user_image'];
                                        $user_role = $row['user_role'];
                                    ?>
                                        
                                        <tr>
                                            <td><?php echo $user_id; ?></td>
                                            <td><?php echo $user_username; ?></td>
                                            <td><?php echo $user_firstname; ?></td>
                                            <td><?php echo $user_lastname; ?></td>
                                            <td><?php echo $user_email; ?></td>


                                            


                                            <td><?php echo $user_image; ?></td>
                                            <td><?php echo $user_role; ?></td>
                                            
                                            <td><a class="btn btn-sm btn-info" style="" href="users.php?user_id=<?php echo $user_id; ?>&to_admin=1">Admin</a></td>
                                            <td><a class="btn btn-sm btn-info"href="users.php?user_id=<?php echo $user_id; ?>&to_subscriber=1" style="">Subscriber
                                            </a></td>
                                            <td><a class="btn btn-sm btn-warning" style="" href="users.php?source=edit_user&edit_id=<?php echo $user_id; ?>">Edit</a></td>
                                            <td><a class="btn btn-sm btn-danger"href="users.php?delete=<?php echo $user_id; ?>" style="">Delete
                                            </a></td>
                                            
                                            
                                        </tr>



    

                                     
                                       
                                 <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                <?php 
                    if(isset($_GET['to_admin'])){
                        $user_id = $_GET['user_id'];

                        $query = "UPDATE users SET user_role='admin' WHERE user_id={$user_id}";
                        $update_role_user_query = mysqli_query($con, $query);
                        confirm_query($update_role_user_query);
                        header("Location: users.php");

                    }
                    if(isset($_GET['to_subscriber'])){
                        $user_id = $_GET['user_id'];

                        $query = "UPDATE users SET user_role='subscriber' WHERE user_id={$user_id}";
                        $update_role_user_query = mysqli_query($con, $query);
                        confirm_query($update_role_user_query);
                        header("Location: users.php");

                    }
                    if(isset($_GET['delete'])){
                        $user_id_to_delete = $_GET['delete'];

                        $query = "DELETE FROM users WHERE user_id={$user_id_to_delete}";
                        $delete_user_query = mysqli_query($con, $query);
                        confirm_query($delete_user_query);
                        header("Location: users.php");

                    }


                 ?>



