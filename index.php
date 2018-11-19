<?php include 'includes/header.php'; ?>

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->



            <div class="col-md-8">
                <?php  
                    if(isset($_GET['source'])){
                        $val = $_GET['source'];

                        if($val == 'show'){
                            if(isset($_GET['post'])){
                                $post_id = $_GET['post'];
                                include 'includes/show_page.php';
                            }
                            if(isset($_GET['author'])){

                                include 'includes/show_page.php';
                            }
                            if(isset($_GET['category'])){
                                $category_id = $_GET['category'];
                                include 'includes/show_category.php';
                            }


                        } 

                        
                    }else {
                        // if(!isset($_GET['page'])){

                        //     $page = 1;
                            
                        // } else if(isset($_GET['page'])){

                        //    $page = $_GET['page']; 
                        // }

                        

                        // if ($page == "" || $page == 1) {
                        //     $page_1 = 0;
                        // } else {
                        //     $page_1 = ($page * 2) - 2;
                        // }

                        // $query = "SELECT * FROM posts LIMIT $page_1, 5";

                        $query = "SELECT * FROM posts";
                        $select_all_posts_query = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {

                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0, 300);
                        $post_status = $row['post_status'];

                        if($post_status == "published"){
                        

                        echo    "<div class='well'>";
                        echo        "<h1 class='page-header'>";
                        echo            "<a href='index.php?source=show&post=". $post_id. "'>". $post_title . "</a>"; 
                        echo        "</h1>";
                        echo    "<p class='lead'>";
                        echo        "by "."<a href='index.php?source=show&author=".$post_author."'>" .$post_author ."</a>";
                        echo    "</p>";
                        echo    "<p><span class='glyphicon glyphicon-time'></span>". "Posted on ". $post_date;
                        echo    "</p>";
                        echo    "<hr>";
                        echo    "<img class='img-responsive' src='images/". $post_image ."'>";
                        echo    "<hr>";
                        echo    "<p>" .$post_content ."</p>";
                        echo    "<a class='btn btn-primary' href='index.php?source=show&post=". $post_id. "'>"."Read            More". "<span class='glyphicon glyphicon-chevron-right'></span></a>";
                        echo    "</div>";



    
                            




                        
                    } } 

                            // $query = "SELECT * FROM posts";
                            // $find_count_array = mysqli_query($con, $query);
                            // $count = mysqli_num_rows($find_count_array);
                            // // echo $count;
                            // $count = $count / 2;

                            // $count = ceil($count);
                            // echo "<ul class='pagination'>";

                            // for($i = 1; $i <= $count; $i++){
                            //     echo "<li><a href='index.php?page={$i}'>". $i. "</a></li>";
                            // }
                            
                            // echo "</ul>";
                    }



            ?>


                
               
                
                      

        



            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

        

       <?php include 'includes/footer.php'; ?>