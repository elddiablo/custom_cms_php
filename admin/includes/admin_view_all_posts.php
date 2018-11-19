<?php  ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <span style="text-transform: uppercase;">All the posts</span>
       
        <span style="text-transform: uppercase;margin-left: 3em;"> Actions to Selected:</span>
        <form action="" method="post" style="display: inline-block;">
            <select name="action_to_selected" id="select_actions">
                <option value="">Select</option>
                <option value="delete">Delete</option>
                <option value="draft">Draft</option>
                <option value="publish">Publish</option>
                <option value="clone">Clone</option>
            </select>
            <button name="apply_to_selected" class="btn btn-success btn-xs" style="margin-left: 1em;">Apply</button>
        
        <?php 

           if(isset($_POST['action_to_selected'])){

                $action = $_POST['action_to_selected'];

                if (isset($_POST['checkBoxArray'])) {

                    foreach ($_POST['checkBoxArray'] as $checkbox_post_id) {
                        $query = "SELECT * FROM posts WHERE post_id = {$checkbox_post_id}";
                        $get_selected_post_query = mysqli_query($con, $query);
                        while ($result = mysqli_fetch_assoc($get_selected_post_query)) {
                            $sel_post_id = $result['post_id'];
                            SelectedPosts($sel_post_id, $action);
                        }
                    }

                } else if(isset($_POST['selectAllBoxes'])){

                    AllPosts($action);

                }
                
            }

         ?>

    </div>

    <table class="table table-bordered table-hover">


                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="selectAllBoxes" id="selectAllBoxes"></th>
                                    <th>Id<a href="posts.php?filter=id" class="arrow_down"><i class="fas fa-arrow-circle-down "></i></a></th>
                                    <th>Author <a href="posts.php?filter=author" class="arrow_down"><i class="fas fa-arrow-circle-down "></i></a></th>
                                    <th>Title<a href="posts.php?filter=title" class="arrow_down"><i class="fas fa-arrow-circle-down "></i></a></th>
                                    <th>Category<a href="posts.php?filter=category_id" class="arrow_down"><i class="fas fa-arrow-circle-down "></i></a></th>
                                    <th>Status<a href="posts.php?filter=status" class="arrow_down"><i class="fas fa-arrow-circle-down "></i></a></th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments<a href="posts.php?filter=comment_count" class="arrow_down"><i class="fas fa-arrow-circle-down "></i></a></th>
                                    <th>Views</th>
                                    <th>Delete</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                    // filtering by the author;
                                if (isset($_GET['filter'])) {
                                    $filter_key = $_GET['filter'];

                                    $order_statement = "post_" . $filter_key;
                                    $order_way = "ASC";
                                    if($order_statement == "post_comment_count"){
                                        $order_way = "DESC";

                                    }

                                    $query = "SELECT * FROM posts ORDER BY ". $order_statement . " ". $order_way;

                                } else {

                                    $query = "SELECT * FROM posts";
                                }
                                    


                                    
                                    $select_posts_sidebar = mysqli_query($con, $query);
                                    confirm_query($select_posts_sidebar);

                                    while ($row = mysqli_fetch_assoc($select_posts_sidebar)) {  
                                        $post_id = $row['post_id'];
                                        $post_author = $row['post_author'];
                                        $post_title = $row['post_title'];
                                        $post_category_id = $row['post_category_id'];
                                        $post_status = $row['post_status'];
                                        $post_image = $row['post_image'];
                                        $post_tags = $row['post_tags'];
                                        $post_comment_count = $row['post_comment_count'];
                                        // $post_date = $row['post_date'];
                                        $post_views_count = $row['post_views_counter'];
                                    ?>
                                        
                                        <tr>
                                            <td> 
                                                    <input 
                                                    class="checkBoxes" type="checkbox" 
                                                    name="checkBoxArray[]" value="<?php echo $post_id; ?>" >


                                            </td>
                                            <td><?php echo $post_id; ?></td>
                                            <td><?php echo $post_author; ?></td>
                                            <td><?php echo $post_title; ?></td>


                                                    <?php 

                                                        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                                                        $select_categories_by_id = mysqli_query($con, $query);

                                                        while ($row = mysqli_fetch_assoc($select_categories_by_id)) {
                                                            $cat_id = $row['cat_id'];
                                                            $cat_title = $row['cat_title'];
                                                        }


                                                     ?>



                                            <td><?php echo $cat_title; ?></td>





                                            <td><?php echo $post_status; ?></td>
                                            <td><img src="../images/<?php echo $post_image; ?>" class="img-hover" alt="" style="width:100px"></td>
                                            <td><?php echo $post_tags; ?></td>
                                            <?php refreshCommentCount($post_id) ?>
                                            <td><?php echo $post_comment_count; ?></td>
                                            <td><?php echo $post_views_count; ?></td>
                                            <td><a class="btn btn-sm btn-danger"href="posts.php?delete=<?php echo $post_id; ?>" style="text-transform: uppercase;">Delete</a></td>
                                            <td><a class="btn btn-sm btn-info" style="text-transform: uppercase;" href="../index.php?source=show&post=<?php echo $post_id; ?>">View</a></td>
                                            <td><a class="btn btn-sm btn-warning" style="text-transform: uppercase;" href="posts.php?source=edit_post&edit_id=<?php echo $post_id; ?>">Edit</a></td>
                                            
                                        </tr>



    

                                     

                                 <?php } ?>
                                
                            </tbody>
                        </form>
                        </table>
                    </div>
                <?php 

                    if(isset($_GET['delete'])){
                        $id_to_delete = $_GET['delete'];

                        $query = "DELETE FROM posts WHERE post_id = {$id_to_delete}";

                        $delete_query = mysqli_query($con, $query);

                        header("Location: posts.php");
                    }


                 ?>

<script>
    var checkArray = document.querySelectorAll('input.checkBoxes');
    var isChecked = false;
    document.getElementById('selectAllBoxes').addEventListener('click', ()=>{
        
        if(!isChecked){
            for(var i = 0; i < checkArray.length; i++){
                checkArray[i].checked = true;
                isChecked = true;
            }
        } else if(isChecked){
            for(var i = 0; i < checkArray.length; i++){
                checkArray[i].checked = false;
                isChecked = false;
            }
        }
    });

</script>

