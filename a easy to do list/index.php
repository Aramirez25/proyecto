<?php 
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "to_do");

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
	}
	// delete task
if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM tasks WHERE id_tasks=".$id);
	header('location: index.php');
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
	<table>
	<thead>
		<tr>
			<th>N</th>
			<th>Tasks</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed
		$tasks = mysqli_query($db, "SELECT * FROM tasks");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['task_tasks']; ?> </td>
				<td class="delete"> 
					<a href="index.php?del_task=<?php echo $row['id_tasks'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>
</body>
</html>
