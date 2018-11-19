<?php include 'db.php'; ?>
<?php session_start(); ?>

<?php 
	
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		//	FOR CLEANING THE FRIELDS 
		$username = mysqli_real_escape_string($con, $username);
		$password = mysqli_real_escape_string($con, $password);

		$query = "SELECT * FROM users WHERE username = '{$username}'";
		$select_user_query = mysqli_query($con, $query);
		if(!$select_user_query){
			die("Error: ". mysqli_error($con));
			// header("Location: ../index.php");
		} else {
		while ($row = mysqli_fetch_assoc($select_user_query)) {

		    $db_user_id = $row['user_id'];
		    $db_username = $row['username'];
		    $db_user_password = $row['user_password'];
		    $db_user_firstname = $row['user_firstname'];
		    $db_user_lastname = $row['user_lastname'];
		    $db_user_role = $row['user_role'];

		}

		// $password = crypt($password, $db_user_password);

		if ($password !== $db_user_password) {
			
			// header("Location: ../index.php");
			echo $password; echo "<br>";
			echo $db_user_password;	echo "<br>";
			echo "error";

		} else if ($password == $db_user_password) {

			$_SESSION['username'] = $db_username;
			$_SESSION['password'] = $db_user_password;
			$_SESSION['firstname'] = $db_user_firstname;
			$_SESSION['lastname'] = $db_user_lastname;
			$_SESSION['user_role'] = $db_user_role;


			header("Location: ../index.php");

		} 

		}
	}
	
 ?>