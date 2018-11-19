









<?php 

                    // SHow the particular Post
                    if(isset($_GET['post'])){

                        $post_id = $_GET['post'];

                        $query = "SELECT * FROM posts WHERE post_id={$post_id}";

                        $particular_post = mysqli_query($con, $query);

                        views_counter_increase($post_id);

                        while($row = mysqli_fetch_assoc($particular_post)){

                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];

                         ?>
                            
                            <h1><?php echo $post_title; ?></h1>
                            <p class="lead">
                            by <a href="#"><?php echo $post_author; ?></a>
                            </p>
                            <p>
                                <span class="glyphicon glyphicon-time">                        
                                </span> Posted in <?php echo $post_date; ?>
                            </p>
                            <!-- Preview Image -->
                            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

                            <hr>

                            <!-- Post Content -->
                            <p class="lead"><?php echo $post_content; ?></p>

                            <hr>


                            <div class="well">
                                <h4>Leave a Comment:</h4>
                                    <form role="form" method="post" action="">
                                        <div class="form-group">
                                            <label for="author">Author</label>
                                            <input type="text" class="form-control" rows="3" name="comment_author" id="author" required>
                                        </div>
                                          <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control"name="comment_email" id="email" required>
                                        </div>
                                          <div class="form-group">
                                            <label for="comment_content">Comment</label>
                                            <textarea class="form-control" rows="3" name="comment_content" id="comment_content"></textarea>
                                        </div>
                                        <input type="submit" class="btn btn-primary" name="create_comment" value="Submit" required>
                                    </form>
                            </div>
                            <!-- Posted Comments -->
                                <?php 

                                    $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                                    $query .= "AND comment_status = 'approved' "; // condition 'AND';
                                    $query .= "ORDER BY comment_id DESC "; 
                                    //ORDER --> showing in the descending order based on comment id;

                                    $select_comment_query = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_assoc($select_comment_query)) {
                                        $comment_author = $row['comment_author'];
                                        $comment_date = $row['comment_date'];
                                        $comment_content = $row['comment_content'];
                                    ?>
                                    <!-- Comment -->
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                                <small><?php echo $comment_date; ?></small>
                                            </h4>
                                            <?php echo $comment_content; ?>
                                        </div>
                                    </div>

                                <?php } ?>
                                

                            <hr>

                            


                        <?php }

                    } else if (isset($_GET['author'])) {
                        $post_author = $_GET['author'];

                        $query = "SELECT * FROM posts WHERE post_author = '{$post_author}'";
                        $select_all_posts_by_author_query = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($select_all_posts_by_author_query)) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];


                            showAllPostsByAuthor($post_author);
                                ?>
                            

                        <?php } } ?>

            

                <?php 
                                if (isset($_POST['create_comment'])) {

                                    $comment_author = $_POST['comment_author'];
                                    $comment_email = $_POST['comment_email'];
                                    $comment_content = $_POST['comment_content'];

                                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                                    $query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                                    $create_comment_query = mysqli_query($con, $query);
                                    confirm_query($create_comment_query);
                                }

                                refreshCommentCount($post_id);
                ?>


                                
