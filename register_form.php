<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'/>
    <?php include 'styles.php';?>
</head>
<body>

	<?php include 'menu.php'; ?>

	<form id="registerform" action="nowy.php" method="post">
	  Nazwa blogu:<br>
	  <input type="text" name="title">
	  <br>
	  Nazwa użytkownika:<br>
	  <input type="text" name="username">
	  <br>
	  Hasło:<br>
	  <input type="password" name="password">
	  <br>
	  Opis blogu: <br>
	  <textarea rows="4" cols="50" name="description" form="registerform" ></textarea>
	  <br>
	  <input type="submit" value="Submit">
		<br> <input type="reset" value="Wyczyść!">
	</form> 

</body>
</html>