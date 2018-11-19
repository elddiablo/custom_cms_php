<?php 

	if(isset($_POST['create_user'])){
		$username = $_POST['username'];
		$user_password = $_POST['user_password'];
		$user_role = $_POST['user_role'];
		$user_firstname = $_POST['user_firstname'];
		$user_lastname = $_POST['user_lastname'];

		// $user_image = $_FILES['user_image']['name'];
		// $user_image_temp = $_FILES['user_image']['tmp_name'];

		$user_email = $_POST['user_email'];
		// $post_date = date('d-m-y');
		// $post_comment_count = 4;

		// move_uploaded_file($post_image_temp, "../images/$post_image");

		$query = "INSERT INTO users(username, user_password, user_role, user_email, user_firstname, user_lastname) ";
		$query .= "VALUES('{$username}','{$user_password}','{$user_role}','{$user_email}','{$user_firstname}','{$user_lastname}' ) ";


		$create_new_user_query = mysqli_query($con, $query);

		confirm_query($create_new_user_query);

		header("Location: users.php");

	}

	
 ?>


<div class="container">
	<div class="jumbotron">
		<h1>Create A User</h1>
		<form action="" method="post" enctype="multipart/form-data">
			
			<div class="form-group">
			  <label for="post_title">username</label>
			  <input type="text" class="form-control" placeholder="username" name="username">
			</div>
			<div class="form-group">
			  <label for="post_author">user_password</label>
			  <input type="password" class="form-control" placeholder="user_password" name="user_password">
			</div>
			<div class="form-group">
			  <label for="user_role">user_role</label>
			  <select name="user_role" id="user_role">

				
				<option value="subscriber">Select role</option>
				<option value="admin">Admin</option>
				<option value="subscriber">Subscriber</option>
				
			  </select>
			</div>
			<div class="form-group">
			  <label for="post_status">user_firstname</label>
			  <input type="text" class="form-control" placeholder="user_firstname" name="user_firstname">
			</div>
			<div class="form-group">
			  <label for="post_tags">user_lastname</label>
			  <input type="text" class="form-control" placeholder="user_lastname" name="user_lastname">
			</div>
			<div class="form-group">
			  <label for="post_image">User logo img</label>
			  <input type="file" name="post_image">
			</div>
			<div class="form-group">
			  <label for="post_content">user_email</label>
			  <input type="text" class="form-control" placeholder="user_email" name="user_email">
			</div>
			<input type="submit" class="btn btn-primary btn-md " value="Create a new User" name="create_user">
		</form>
	</div>
</div>
	



	<!-- style="border: 1px solid rgba(0,0,0,0.2); padding: 2em; border-radius: 20px" -->	