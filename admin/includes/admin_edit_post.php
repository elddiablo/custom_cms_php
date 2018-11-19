<?php 

	if(isset($_GET['edit_id'])){

		$edit_post_id = $_GET['edit_id'];

		// Find the post
		$query = "SELECT * FROM posts WHERE post_id={$edit_post_id}";
		$edit_get_data_to_query = mysqli_query($con, $query);
		confirm_query($edit_get_data_to_query);

		// get the data out of the found post
		while ($row = mysqli_fetch_assoc($edit_get_data_to_query)) {
		    $post_title = $row['post_title'];
			$post_category_id = $row['post_category_id']; //int
			$post_author = $row['post_author'];
			$post_status = $row['post_status'];

			$post_image = $row['post_image'];


			$post_tags = $row['post_tags'];
			$post_content = $row['post_content'];
			$post_date = $row['post_date']; 
			$post_comment_count = $row['post_comment_count']; //int
		}

	}

	
 ?>
<?php 

	if(isset($_POST['edit_post'])){


		$post_title = $_POST['post_title'];
		$post_category_id = $_POST['post_category_id']; //int
		$post_author = $_POST['post_author'];
		$post_new_status = $_POST['post_status'];
		$post_image_new = $_FILES['post_image']['name'];
		$post_image_temp_new = $_FILES['post_image']['tmp_name'];
		move_uploaded_file($post_image_temp_new, "../images/$post_image_new");
		
		if(empty($post_image_new)){
			$query = "SELECT * FROM posts WHERE post_id={$edit_post_id}";
			$select_image = mysqli_query ($con, $query);
			while ($row = mysqli_fetch_assoc($select_image)) {
			    $post_image_new = $row['post_image'];
			}
		}
		

		

		$post_tags = $_POST['post_tags'];
		$post_content = $_POST['post_content'];


		$query = "UPDATE posts SET ";
		$query .= "post_title = '{$post_title}', ";
		$query .= "post_category_id = {$post_category_id}, ";
		$query .= "post_date = now(), ";
		$query .= "post_author = '{$post_author}', ";
		$query .= "post_status = '{$post_new_status}', ";
		$query .= "post_content = '{$post_content}', ";
		$query .= "post_image = '{$post_image_new}' ";
		$query .= "WHERE post_id = {$edit_post_id}";

		$edit_query_done = mysqli_query($con, $query);

		if (!$edit_query_done) {
			die("Error: ". mysqli_error($con));
		}

		confirm_query($edit_query_done);

		?>
	
	

 
<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Successfuly Updated!</strong> try to <a href="../index.php?source=show&post=<?php echo $edit_post_id; ?>" class="alert-link">View the updated post</a>
	</div>
	
<?php } ?>

<div class="container">
	<div class="jumbotron">
		<h1>Edit The Post</h1>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
			  <label for="post_title">Post title</label>
			  <input type="text" class="form-control" placeholder="title" name="post_title" value="<?php echo $post_title; ?>">
			</div>
			<div class="form-group">
				<label for="post_category_id">Post Category Id</label>
				<select name="post_category_id" id="post-category" class="form-control">
					<?php 
						$query = "SELECT * FROM categories";
				        $select_categories_sidebar = mysqli_query($con, $query);

				        while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
					        $cat_id = $row['cat_id'];
					        $cat_title = $row['cat_title'];
					        echo "<option value='{$cat_id}'>{$cat_title}</option>";
				        }
					 ?>
						

				</select>
			  
			  <!-- <input type="text" class="form-control" placeholder="title" name="post_category_id" value=""> -->
			</div>
			<div class="form-group">
			  <label for="post_author">Post Author</label>
			  <input type="text" class="form-control" placeholder="title" name="post_author" value="<?php echo $post_author; ?>">
			</div>
			<div class="form-group">
			  <select name="post_status" id="select_status">
			  	<option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
			  	<?php 

			  		findAllStatuses_without($post_status);

			  	 ?>
			  </select>
			</div>
			<div class="form-group">
			  <label for="post_image">Post img</label>
			  <input type="file" name="post_image">
			  	<div class="row">
			  		<div class="col-lg-4">
			  			<img src="../images/<?php echo $post_image; ?>" alt="" class="thumbnail" style="width: 100%">
			  		</div>
			  	</div>
			  
			</div>
			<div class="form-group">
			  <label for="post_tags">Post Tags</label>
			  <input type="text" class="form-control" placeholder="title" name="post_tags" value="<?php echo $post_tags; ?>">
			</div>
			<div class="form-group">
			  <label for="post_content">Post Content</label>
			  <textarea name="post_content" class="form-control"id="body" cols="30" rows="10"><?php echo $post_content; ?></textarea>
			</div>
			<input type="submit" class="btn btn-primary btn-md " value="Edit a post" name="edit_post">
		</form>
	</div>
</div>
	

	<!-- style="border: 1px solid rgba(0,0,0,0.2); padding: 2em; border-radius: 20px" -->	