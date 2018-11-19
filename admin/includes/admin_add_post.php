<?php 

	if(isset($_POST['create_post'])){
		$post_title = $_POST['post_title'];
		$post_category_id = $_POST['post_category_id'];
		$post_author = $_POST['post_author'];
		$post_status = $_POST['post_status'];

		$post_image = $_FILES['post_image']['name'];
		$post_image_temp = $_FILES['post_image']['tmp_name'];

		$post_tags = $_POST['post_tags'];
		$post_content = $_POST['post_content'];
		$post_date = date('d-m-y');
		// $post_comment_count = 4;

		move_uploaded_file($post_image_temp, "../images/$post_image");

		$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
		$query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";


		$create_new_post_query = mysqli_query($con, $query);

		confirm_query($create_new_post_query);

		header("Location: posts.php");

	}

	
 ?>


<div class="container">
	<div class="jumbotron">
		<h1>Add A Post</h1>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
			  <label for="post_title">Post title</label>
			  <input type="text" class="form-control" placeholder="title" name="post_title">
			</div>
			<div class="form-group">
			  <label for="post_category_id">Post Category Title</label>
			  

						
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

			  <!-- <input type="text" class="form-control" placeholder="title" name="post_category_id"> -->
			</div>
			<div class="form-group">
			  <label for="post_author">Post Author</label>
			  <input type="text" class="form-control" placeholder="title" name="post_author">
			</div>
			<div class="form-group">
			  <label for="post_status">Post Status</label>
			  <!-- <input type="text" class="form-control" placeholder="title" name="post_status"> -->
			  <select name="post_status" id="post_status" class="form-control">
			  	<option value="draft">Draft</option>
			  	<option value="published">Publish</option>
			  </select>
			</div>
			<div class="form-group">
			  <label for="post_image">Post img</label>
			  <input type="file" name="post_image">
			</div>
			<div class="form-group">
			  <label for="post_tags">Post Tags</label>
			  <input type="text" class="form-control" placeholder="title" name="post_tags">
			</div>
			<div class="form-group">
			  <label for="post_content">Post Content</label>
			  <textarea name="post_content" id="body" cols="30" rows="10"></textarea>
			</div>
			<input type="submit" class="btn btn-primary btn-md " value="Add a post" name="create_post">
		</form>
	</div>
</div>
	



	<!-- style="border: 1px solid rgba(0,0,0,0.2); padding: 2em; border-radius: 20px" -->	