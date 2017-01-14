<!DOCTYPE html>
<html>
<head data_validation="true">
    <meta charset='UTF-8'/>
    <?php include 'styles.php';?>
    <title title="dataValReq">Dodaj nowy post</title>
    <script src="js_scripts/date_validation.js" type="text/javascript"></script>
    <script src="js_scripts/attachments_adder.js" type="text/javascript"></script>
</head>
<body>

    <?php include 'menu.php'; ?>

	<form id="postform" action="wpis.php" method="post" enctype="multipart/form-data">

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
	  <input id="postDate" type='text' name='date' value="">
        <div class="annotation" id="dataAnnotation"></div>
	  <br>

      Godzina:<br>
        <input id="postTime" type='text' name='time' value="">
        <div class="annotation" id="timeAnnotation"></div>
	  <br>

        <div id="attachmentsContainer"></div>

      <input type="button" onclick="createFileInput()" value="Nowy załącznik">
      <br>
	  <br>
	  <input type="submit" value="Dodaj">
       <br>
        <input type="reset" value="Wyczyść!">
	</form> 
</body>
</html>