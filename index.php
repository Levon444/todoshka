<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="source/global.css">
    <title>todoshka.my</title>
  </head>
  <body>
  <?php
// initialize errors variable
$errors = "";

// connect to database
$db = mysqli_connect("localhost", "test_user", "24112001", "to_do_list");

// insert a quote if submit button is clicked
if (isset($_POST['send'])) {
    if (empty($_POST['task'])||empty($_POST['date'])) {
        $errors = "You must fill in the task";
    }else{
        $task = $_POST['task'];
        $date = $_POST['date'];
        $sql = "INSERT INTO `to_do` (`inf`,`date`) VALUES ('$task','$date')";
        mysqli_query($db, $sql);
        header('location: index.php');
    }
}	
if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM `to_do` WHERE id=".$id);
	header('location: index.php');
}

?>
    <div class="container task-block">
    <h1>Создать задачу</h1>
    <form action="index.php" method="post" class="task-box">
    <?php if (isset($errors)) { ?>
	<p class="err-log"><?php echo $errors; ?></p>
     <?php } ?>
    <input type="text" name="task" id="task" placeholder="Что будешь делать? ;-)">
    <input type="date" name="date" placeholder="дата выполнение">
    <button class="but" type="submit" name="send">Создать!</button>
    </form>
    </div>
    <div class="container list">
    <table>
	<thead>
		<tr>
			<th class="tabl">Number</th>
			<th class="tabl">Task</th>
      <th class="tabl">Date</th>
			<th class="tabl" style="width: 60px;">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed
		$tasks = mysqli_query($db, "SELECT * FROM `to_do`");
    $current_date = date("Y-m-d");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
    if()
			<tr>
				<td > <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['inf']; ?> </td>
        <td><?php echo $row['date']; ?> </td>
				<td class="delete"> 
				<button class="del"><a  href="index.php?del_task=<?php echo $row['id'] ?>">X</a> </button>	
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  </body>
</html>
