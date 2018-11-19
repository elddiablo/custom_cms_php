                            
                            
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="cat_title">Edit Categories</label>
                                        <?php 
                                            if (isset($_GET['edit'])) {
                                                $cat_id_edit = $_GET['edit'];
                                                $query = "SELECT * FROM categories WHERE cat_id = {$cat_id_edit}";
                                                $select_categories_id = mysqli_query($con, $query);

                                                    while ($row = mysqli_fetch_assoc($select_categories_id)) {
                                                    $cat_id = $row['cat_id'];
                                                    $cat_title = $row['cat_title'];
                                                    ?>
        
                                                    <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" name="update_category" class="form-control" id="cat_title">
            
                                                <?php }} ?>

                                                <?php 

                                                    if(isset($_POST['update_category'])){

                                                    $update_category_title = $_POST['update_category'];


                                                    $query = "UPDATE categories SET cat_title = '{$update_category_title}' WHERE cat_id = {$cat_id}";

                                                    $update_query = mysqli_query($con, $query);

                                                        if(!$update_query){
                                                            echo "Error occured while updating the category: ". mysqli_error($con);
                                                        }

                                                    }


                                                 ?>

                                            
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Edit Category">
                                        </div>
                                    </form>