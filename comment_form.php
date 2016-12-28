<!DOCTYPE html>
<html>
<body>
<form id="commentform" action="koment.php" method="get">

    <input type='hidden' name='blogname' value='<?php echo $_GET["blogname"]; ?>'/>
    <input type='hidden' name='postfilename' value='<?php echo $_GET["postfilename"]; ?>'/>

    Rodzaj komentarza: <br>
    <select name="commenttype">
        <option value="pozytywny">Pozytywny</option>
        <option value="neutralny">Neutralny</option>
        <option value="negatywny">Negatywny</option>
    </select>
    <br><br>

    Komentarz: <br>
    <textarea rows="4" cols="50" name="comment" form="commentform"></textarea>
    <br><br>

    Podpis:<br>
    <input type="text" name="username"/>
    <br>
    <br>


    <input type="submit" value="Dodaj">
    <br> <input type="reset" value="Wyczyść!">
</form>
</body>
</html>