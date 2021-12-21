<?php 
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost:8080", "root", "", "to_do");

	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task_tasks'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task_tasks'];
			$sql = "INSERT INTO tasks (task_tasks) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
	}	?>
<!DOCTYPE html>
<html>
<head>
	<title>To Do with PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">To Do with PHP and MySQL</h2>
	</div>
	<form method="post" action="index.php" class="input_form">
	<?php if (isset($errors)) { ?>
		<p><?php echo $errors; ?></p>
	<?php } ?>
		<input type="text" name="task" class="task_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>
</body>
</html>
