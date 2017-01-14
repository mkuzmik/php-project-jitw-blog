<?php
/**
 * Created by PhpStorm.
 * User: M.Kuzmik
 * Date: 28.12.2016
 * Time: 09:24
 */
define("BLOG_NAME", $_GET["blogname"]);



if (is_dir(BLOG_NAME) && file_exists(BLOG_NAME."/info")) {

    // show blog

    echo "    
    <!DOCTYPE html>
    <head>
        <meta charset='UTF-8'/>";

    include 'styles.php';

    echo "
    </head>
    <html>
    <body>
                ";

    include 'menu.php';

    echo "<div id='title'>".BLOG_NAME."</div><br><br><br>";

    $files = scandir(BLOG_NAME."/");

    foreach ($files as $file) {
        if (strlen($file) == 16) {
            echo "<div id='post'>";
            echo "<div id='postcontent'>";
            show_post($file);
            echo "</div>";
            show_comments($file);
            add_comment_button($file);
            echo "</div>";
        }
    }

    add_new_post_button();

    echo "
    </body>
    </html>";

}
else if (BLOG_NAME == "") {
    show_blog_list();
}
else {
    echo "Blog not found";
}

function show_blog_list() {
    echo "<ul>";
    $dirs = array_filter(glob('*'), 'is_dir');

    foreach ($dirs as $single_dir) {
        if (file_exists($single_dir."/info")) {
            echo "
        <li>
        <a href='blog.php?blogname=" . $single_dir . "'>
        " . $single_dir . "
        </a>
        </li>
        ";
        }
    }

    echo "</ul>";
}

function show_post($filename) {
    $date = get_date($filename);
    $content = get_content($filename);

    echo $date."<br>";
    echo $content."<br><br>";
    show_attached_files($filename);
}

function show_attached_files($filename) {
    $files = scandir(BLOG_NAME."/");

    foreach ($files as $item) {
        if (substr($item, 0, 16) == $filename && $item != $filename && $item != $filename.".k") {
            echo "
            <a href='".BLOG_NAME."/".$item."'>Załącznik</a><br>
            ";
        }
    }
}

function show_comments($file) {
    $comments_dir = BLOG_NAME . "/" . $file . ".k";
    if(is_dir($comments_dir)) {
        $files = scandir($comments_dir);

        foreach ($files as $item) {
            if (is_numeric($item)) {
                $commentfile = fopen($comments_dir . "/" . $item, "r");
                $commenttype = fgets($commentfile);
                $datetime = fgets($commentfile);
                $username = fgets($commentfile);
                $comment = fgets($commentfile);
                fclose($commentfile);

                echo "
                    <div id='comment'>
                    Czas: " . $datetime . "<br>
                    Typ: " . $commenttype . "<br>
                    Nazwa: " . $username . "<br>
                    Komentarz: " . $comment . "
                    </div><br>
                ";
            }
        }
    }
}

function get_date($filename) {
    $year = substr($filename, 0, 4);
    $month = substr($filename, 4, 2);
    $day = substr($filename, 6, 2);
    $hour = substr($filename, 8, 2);
    $min = substr($filename, 10, 2);
    $sec = substr($filename, 12, 2);

    return $year."-".$month."-".$day." ".$hour.":".$min.":".$sec;
}

function get_content($filename) {
    $content = "";

    $filehandle = fopen(BLOG_NAME."/".$filename, "r");
    if ($filehandle) {
        while (($line = fgets($filehandle)) !== false) {
            $content = $content.$line."<br>";
        }

        fclose($filehandle);
    } else {
        echo "Error while opening some post..";
    }

    return $content;
}

function add_comment_button($filename) {
    echo "
    <form id='commentform' action='comment_form.php' method='get'>
        <input type='hidden' name='blogname' value='".BLOG_NAME."'/>
        <input type='hidden' name='postfilename' value='".$filename."'/>
        <input type='submit' value='Skomentuj'/>
    </form>
    <br>
    <br>
    ";
}

function add_new_post_button()
{
    echo "
    <form id='newpost' action='post_form.php' method='get' >
        <input type='submit' value='Dodaj nowy post'/>
    </form>
    ";
}

?>