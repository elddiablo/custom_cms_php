<?php  ?>
<div class="panel panel-default">
    <div class="panel-heading"><span style="text-transform: uppercase;font-weight: bold;">All the comments</span></div>
    <table class="table table-bordered table-hover">


                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In response to</th>
                                    <th>Content</th>
                                    
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                    $query = "SELECT * FROM comments";
                                    $select_posts_sidebar = mysqli_query($con, $query);

                                    while ($row = mysqli_fetch_assoc($select_posts_sidebar)) {  
                                        $comment_id = $row['comment_id'];
                                        $comment_post_id = $row['comment_post_id'];
                                        $comment_author = $row['comment_author'];
                                        $comment_email = $row['comment_email'];
                                        $comment_content = $row['comment_content'];
                                        $comment_status = $row['comment_status'];
                                        $comment_date = $row['comment_date'];
                                    ?>
                                        
                                        <tr>
                                            <td><?php echo $comment_id; ?></td>
                                            <td><?php echo $comment_author; ?></td>
                                            <td><?php echo $comment_post_id; ?></td>
                                            <td><?php echo $comment_email; ?></td>
                                            <td><?php echo $comment_status; ?></td>


                                            <td style="text-decoration: underline;">
                                                    
                                                    <?php 

                                                        $query = "SELECT * FROM posts WHERE post_id={$comment_post_id}";
                                                        $select_post_id_query = mysqli_query($con, $query);
                                                        while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                                                            $post_id = $row['post_id'];
                                                            $post_title = $row['post_title'];
                                                        }
                                                        
                                                     ?>
                                                     <a href='../index.php?source=show&post=<?php echo $post_id; ?>'><?php echo $post_title; ?></a>
                                                    
                                            </td>


                                            <td><?php echo $comment_content; ?></td>
                                            <td><?php echo $comment_date; ?></td>
                                            
                                            <td><a class="btn btn-sm btn-success"href="comments.php?approve=<?php echo $comment_id; ?>" style="">Approve</a></td>
                                            <td><a class="btn btn-sm btn-success" style="" href="comments.php?unapprove=<?php echo $comment_id; ?>">UnApprove</a></td>
                                            <td><a class="btn btn-sm btn-danger"href="comments.php?delete=<?php echo $comment_id; ?>" style="">Delete
                                            </a></td>
                                            <td><a class="btn btn-sm btn-warning" style="" href="posts.php?source=edit_post&edit_id=<?php echo $post_id; ?>">Edit</a></td>
                                            
                                        </tr>



    

                                     
                                       
                                 <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                <?php 
                    if(isset($_GET['approve'])){
                        $comment_id_to_unapprove = $_GET['approve'];

                        $query = "UPDATE comments SET comment_status='approved' WHERE comment_id={$comment_id_to_unapprove}";
                        $delete_comment_query = mysqli_query($con, $query);
                        confirm_query($delete_comment_query);
                        header("Location: comments.php");

                    }
                    if(isset($_GET['unapprove'])){
                        $comment_id_to_unapprove = $_GET['unapprove'];

                        $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id={$comment_id_to_unapprove}";
                        $delete_comment_query = mysqli_query($con, $query);
                        confirm_query($delete_comment_query);
                        header("Location: comments.php");

                    }

                    if(isset($_GET['delete'])){
                        $comment_id_to_delete = $_GET['delete'];

                        $query = "DELETE FROM comments WHERE comment_id={$comment_id_to_delete}";
                        $delete_comment_query = mysqli_query($con, $query);
                        confirm_query($delete_comment_query);
                        header("Location: comments.php");

                    }


                 ?>



