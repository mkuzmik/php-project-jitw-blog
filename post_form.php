<!DOCTYPE html>
<html>
<body>
	<form id="postform" action="wpis.php" method="post">

	  Nazwa użytkownika:<br>
	  <input type="text" name="username">
	  <br>

	  Hasło:<br>
	  <input type="password" name="password">
	  <br>

	  Treść posta: <br>
	  <textarea rows="4" cols="50" name="content" form="postform"></textarea>
	  <br>

	  Data:<br>
	  <?php
	  echo "<input type='text' name='date' value='".date('Y-m-d')."'";
	  ?>
	  <br><br>

      Godzina:<br>
	  <?php
	  echo "<input type='text' name='time' value='".date('H:i')."'";
	  ?>
	  <br><br>

      File 1:<br>
	  <input type="file" name="file1">
	  <br>

      File 2:<br>
	  <input type="file" name="file2">
	  <br>

      File 3:<br>
	  <input type="file" name="file3">
	  <br>
	  <br>
	  <input type="submit" value="Dodaj">
       <br> <input type="reset" value="Wyczyść!">
	</form> 
</body>
</html>