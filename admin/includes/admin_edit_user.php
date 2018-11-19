
<?php 

	if(isset($_GET['edit_id'])){

		$edit_user_id = $_GET['edit_id'];

		// Find the user
		$query = "SELECT * FROM users WHERE user_id={$edit_user_id}";
		$edit_get_data_to_query = mysqli_query($con, $query);
		confirm_query($edit_get_data_to_query);

		// get the data out of the found user
		while ($row = mysqli_fetch_assoc($edit_get_data_to_query)) {
			$username = $row['username'];
			$user_password = $row['user_password'];
			$user_firstname = $row['user_firstname'];
			$user_lastname = $row['user_lastname'];
			$user_email = $row['user_email'];
			$user_role = $row['user_role']; 
		}

	}

	
 ?>
<?php 

	if(isset($_POST['edit_user'])){


		$username = $_POST['username'];
		$user_role = $_POST['user_role'];
		$user_firstname = $_POST['user_firstname'];
		$user_lastname = $_POST['user_lastname'];
		$user_email = $_POST['user_email'];

		// ======FOR==IMAGE====== // 

		// $user_image_new = $_FILES['user_image']['name'];
		// $user_image_temp_new = $_FILES['user_image']['tmp_name'];
		// move_uploaded_file($user_image_temp_new, "../images/$user_image_new");
		
		// if(empty($user_image_new)){
		// 	$query = "SELECT * FROM users WHERE user_id={$edit_user_id}";
		// 	$select_image = mysqli_query ($con, $query);
		// 	while ($row = mysqli_fetch_assoc($select_image)) {
		// 	    $user_image_new = $row['user_image'];
		// 	}


		$query = "UPDATE users SET ";
		$query .= "username = '{$username}', ";
		$query .= "user_role = '{$user_role}', ";
		$query .= "user_firstname = '{$user_firstname}', ";
		$query .= "user_lastname = '{$user_lastname}', ";
		$query .= "user_email = '{$user_email}' WHERE user_id = $edit_user_id";

		$edit_user_query = mysqli_query($con, $query);

		confirm_query($edit_user_query);


		// header("Location: users.php");
	
	

 ?>

	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Successfuly Updated!</strong>
	</div>


<?php } ?>

<div class="container">
	<div class="jumbotron">
		<h1>Edit The User: <?php echo $username ?></h1>
		<form action="" method="post" enctype="multipart/form-data">
			
			<div class="form-group">
			  <label for="post_title">username</label>
			  <input type="text" class="form-control" placeholder="username" name="username" value="<?php echo $username; ?>">
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
			  <input type="text" class="form-control" placeholder="user_firstname" name="user_firstname" value="<?php echo $user_firstname; ?>">
			</div>
			<div class="form-group">
			  <label for="post_tags">user_lastname</label>
			  <input type="text" class="form-control" placeholder="user_lastname" name="user_lastname" value="<?php echo $user_lastname; ?>">
			</div>
			<div class="form-group">
			  <label for="post_image">User logo img</label>
			  <input type="file" name="post_image" value="<?php echo $user_image; ?>">
			</div>
			<div class="form-group">
			  <label for="post_content">user_email</label>
			  <input type="text" class="form-control" placeholder="user_email" name="user_email" value="<?php echo $user_email; ?>">
			</div>
			<input type="submit" class="btn btn-primary btn-md " value="Update a User" name="edit_user">
		</form>
	</div>
</div>
	




	