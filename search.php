
<?php include 'includes/header.php'; ?>

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->



            <div class="col-md-8">
                <?php  

                     
                
                    if(isset($_POST['submit'])){

                        $search = $_POST['search'];

                        $query = "SELECT * FROM posts";
                        $query .= " WHERE post_tags LIKE '%$search%'";

                        $search_query = mysqli_query($con, $query);
                        if (!$search_query) {
                            die("Query failed: ". mysqli_error($con));
                        } 



                        $count = mysqli_num_rows($search_query);
                        if($count == 0){
                            echo "<h1> No Results </h1>";  
                        } else {
                            

                            // displaying all found posts on the screen
                       
                        while ($row = mysqli_fetch_assoc($search_query)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];

                        ?>


                        <div class="well">
                            <h1 class="page-header">
                            <?php echo $post_title ?>
                            
                            </h1>
                            <p class="lead">
                                by <a href="#"><?php echo $post_author ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on 
                                    <?php echo $post_date ?>
                            </p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                            <hr>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        

                   <?php } 

                          }




                    } ?>




                    
               

                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

       <?php include 'includes/footer.php'; ?>