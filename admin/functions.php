<?php 
	function SelectedPosts($post_id, $action){
			global $con;
			switch ($action) {
				case 'delete':
					$query = "DELETE FROM posts WHERE post_id={$post_id}";
					$delete_selected_post_query = mysqli_query($con, $query);
					confirm_query($delete_selected_post_query);
						break;

				case 'clone':
					

                                  //   $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
                                  //   //ORDER --> showing in the descending order based on comment id;

                                  //   $select_all_comments_query = mysqli_query($con, $query);
                                  //   while ($row = mysqli_fetch_assoc($select_comment_query)) {

                                  //       $comment_author = $row['comment_author'];
                                  //       $comment_date = $row['comment_date'];
                                  //       $comment_content = $row['comment_content'];
                                  //       $comment_email = $row['comment_email'];

                                  //   	$query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                                		// $query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                                		// $clone_comment_query = mysqli_query($con, $query);

                                		// confirm_query($clone_comment_query);
                                  //   }

                                    

                                    






					$query = "SELECT * FROM posts WHERE post_id={$post_id}";
					$result = mysqli_query($con, $query);
					$one_post = mysqli_fetch_assoc($result);

					$post_title = $one_post['post_title'];
					$post_category_id = $one_post['post_category_id'];
					$post_author =$one_post['post_author'];
					$post_status = $one_post['post_status'];
					$post_image = $one_post['post_image'];
					$post_tags = $one_post['post_tags'];
					$post_content = $one_post['post_content'];
					$post_date = date('d-m-y');

					$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
					$query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";

					$clone_selected_post = mysqli_query($con, $query);
					confirm_query($clone_selected_post);

						break;

				case 'draft':
					$query = "UPDATE posts SET post_status = 'draft' WHERE post_id={$post_id}";
					$draft_selected_posts_query = mysqli_query($con, $query);
					confirm_query($draft_selected_posts_query);
						break;

				case 'publish':
					$query = "UPDATE posts SET post_status = 'published' WHERE post_id={$post_id}";
					$publish_selected_posts_query = mysqli_query($con, $query);
					confirm_query($publish_selected_posts_query);
						break;

				default:
					
						break;
			}
	}
	function AllPosts($action){
			global $con;
			switch ($action) {
				case 'delete':
					$query = "DELETE * FROM posts";
					$delete_all_posts_query = mysqli_query($con, $query);
					confirm_query($delete_all_posts_query);
						break;

				case 'draft':
					$query = "UPDATE posts SET post_status = 'draft'";
					$draft_all_posts_query = mysqli_query($con, $query);
					confirm_query($draft_all_posts_query);
						break;

				case 'publish':
					$query = "UPDATE posts SET post_status = 'published'";
					$publish_all_posts_query = mysqli_query($con, $query);
					confirm_query($publish_all_posts_query);
						break;

				default:
					
						break;
			}

		}


	function refreshCommentCount($id){
		global $con;
		$post_id = $id;
		$query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
        $all_post_comments = mysqli_query($con, $query);
        $particular_comment_count = 0;
        foreach ($all_post_comments as $comment) {
            $particular_comment_count++;
        }

        $query = "UPDATE posts SET post_comment_count = $particular_comment_count WHERE post_id = $post_id";
        $update_comment_count = mysqli_query($con, $query);
        confirm_query($update_comment_count);
	}

	function findAllStatuses_without($set_status){
		$status_array = ["draft","published"];
		foreach ($status_array as $status) {
			if($status !== $set_status){
				echo "<option value='$status'>".$status."</option>";
			}
		}
	}
	function findAllRoles_without($set_role){
		$roles_array = ["admin","subscriber"];
		foreach ($roles_array as $role) {
			if($role !== $set_role){
				echo "<option value='$role'>".$role."</option>";
			}
		}
	}

	
	function showAllPosts(){

					global $con;
                    // SELECTING POSTS 	
					

					

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
							echo 	"<div class='well'>";
	                        echo    	"<h1 class='page-header'>";
	                        echo 			"<a href='index.php?source=show&post=". $post_id. "'>". $post_title . "</a>"; 
	                        echo    	"</h1>";
	                        echo    "<p class='lead'>";
	                        echo    	"by "."<a href='index.php?source=show&author=".$post_author."'>" .$post_author ."</a>";
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
                        

		
                        
                        

                    } 
	}
	function showAllPostsByAuthor($post_author){
		global $con;


                    // SELECTING POSTS 	
                    	$post_key_author = $post_author;
                        $query = "SELECT * FROM posts WHERE post_author = '{$post_key_author}'";
                        $select_all_posts_by_author_query = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($select_all_posts_by_author_query)) {
                        	$post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = substr($row['post_content'],0, 300);
                            $post_status = $row['post_status'];

	                    if($post_status == "published"){
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
                        

		
                        
                        

                    } 
	}


	function confirm_query($result){
		global $con;
		if(!$result){
			die("Error: ". mysqli_error($con));
		} 
	}
	
	function insert_category(){
		global $con;
		if (isset($_POST['submit_add'])) {
            $cat_title = $_POST['cat_title'];
            if ($cat_title == "" || empty($cat_title)) {
                echo "The field should not be empty!";
            } else {
                $query = "INSERT INTO categories(cat_title) ";
                $query .= "VALUE('{$cat_title}') ";

                $create_category_query = mysqli_query($con, $query);

                if (!$create_category_query) {
                    Die("Error: ". mysqli_error($con));
                }
            }
        }
	}

	function edit_category(){
		global $con;
		if (isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];
            include 'includes/admin_update.php'; 
        }
	}

	function find_all_categories(){
		global $con;

        $query = "SELECT * FROM categories";
        $select_categories_sidebar = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
        }
	}

	function delete_category_by_id(){
		if(isset($_GET['delete'])){
		global $con;
	     $get_cat_id = $_GET['delete'];

	     $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id}";

	     $delete_query = mysqli_query($con, $query);

	     header("Location: categories.php");

		     if(!$delete_query){
		        echo "Error occured while deleting the category: ". mysqli_error($con);
		     }

	    }
	}
	function views_counter_increase($post_id){
		global $con;
	 $query = "SELECT * FROM posts WHERE post_id={$post_id}";
	 $result = mysqli_query($con, $query);
	 $post = mysqli_fetch_assoc($result);
	 $post_views_counter = $post['post_views_counter'] + 1;

	 $query = "UPDATE posts SET post_views_counter = $post_views_counter WHERE post_id={$post_id}";
	 $update_post_views_counter_query = mysqli_query($con, $query);
	 confirm_query($update_post_views_counter_query);


	}


 ?>