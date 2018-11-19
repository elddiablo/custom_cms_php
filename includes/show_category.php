<?php 

		$query = "SELECT * FROM posts WHERE post_category_id  = {$category_id}";

		$result = mysqli_query($con, $query);

		while($row = mysqli_fetch_assoc($result)){

					$post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0, 300);

                        

		
                        echo 	"<div class='well'>";
                        echo    	"<h1 class='page-header'>";
                        echo 			"<a href='index.php?source=show&post=". $post_id. "'>". $post_title . "</a>"; 
                        echo    	"</h1>";
                        echo    "<p class='lead'>";
                        echo    	"by "."<a href='#'>" .$post_author ."</a>";
                        echo    "</p>";
                        echo    "<p><span class='glyphicon glyphicon-time'></span>". "Posted on ". $post_date;
                        echo   	"</p>";
                        echo    "<hr>";
                        echo    "<img class='img-responsive' src='images/". $post_image ."'>";
                        echo    "<hr>";
                        echo    "<p>" .$post_content ."</p>";
                        echo    "<a class='btn btn-primary' href='index.php?source=show&post=". $post_id. "'>"."Read 			More". "<span class='glyphicon glyphicon-chevron-right'></span></a>";
                        echo 	"</div>";
		}

 ?>