<div class="col-md-4">
                


    
                <?php if(!isset($_SESSION['username'])){ ?>
                 <div class="well">
                    <h4>Login</h4>
                    
                        <form action="includes/login.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="username">
                            </div>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" placeholder="password">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" name="login" type="submit">
                                        Submit
                                    </button>
                                </span>
                            </div>
                        </form>
                        
                    <!-- /.input-group -->
                </div>
            <?php } ?>
            

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    
                        <form action="search.php" method="post">
                            <div class="input-group">

                            <input type="text" class="form-control" name="search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                            </div>
                        </form>
                        
                    <!-- /.input-group -->
                </div>
    



                <!-- Blog Categories Well -->
                <div class="well">
                        
                        


                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php 

                                    $query = "SELECT * FROM categories";
                                    $select_all_categories_sidebar = mysqli_query($con, $query);
                                    
                                    while ($row = mysqli_fetch_assoc($select_all_categories_sidebar)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    echo "<li><a class='' href='index.php?source=show&category=". $cat_id ."'>". $cat_title. "</a></li>";
                                    }

                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include 'widget.php'; ?>

            </div>