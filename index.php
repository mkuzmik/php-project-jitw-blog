<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'/>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>

<?php include 'menu.php'; ?>

<form id="showblogform" action="blog.php" method="get">
    Wyszukaj blog: <br>
    <input type="text" name="blogname"/>
    <input type="submit" value="Szukaj"/>
</form>
<br>

</body>
</html>