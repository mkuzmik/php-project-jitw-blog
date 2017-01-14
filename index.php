<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'/>
    <?php include 'styles.php';?>
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