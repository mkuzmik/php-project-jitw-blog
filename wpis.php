<?php

define('USERNAME', $_POST["username"]);
define('PASSWORD_MD5', md5($_POST["password"]));

$dir_name = find_and_return_directory_name();
if ($dir_name != false && isPasswordOK($dir_name)) {
    add_post($dir_name);
    echo "Added succesfully!";
}
else {
    echo "Authorization failed..";
}

function add_post($dir_name) {
    $postfilename = get_post_file_name($dir_name);

    $postfile = fopen($dir_name."/".$postfilename,"w");
    fwrite($postfile, $_POST["content"]);
    fclose($postfile);

    check_if_exists_and_save( "file1", "1", $postfilename, $dir_name);
    check_if_exists_and_save( "file2", "2", $postfilename, $dir_name);
    check_if_exists_and_save( "file3", "3", $postfilename, $dir_name);
}

function check_if_exists_and_save($filename,$filenumber, $postfilename, $target_dir) {
    $target_file = $target_dir . basename($_FILES[$filename]["name"]);
    $file_type = pathinfo($target_file,PATHINFO_EXTENSION);
    if(file_exists($_FILES[$filename]["tmp_name"])) {
        move_uploaded_file($_FILES[$filename]["tmp_name"], $target_dir."/".$postfilename.$filenumber.".".$file_type);
    }
}

function get_post_file_name($directory) {
    $filename = "";

    $year = substr($_POST["date"], 0, 4);
    $filename = $filename.$year;

    $month = substr($_POST["date"], 5, 2);
    $filename = $filename.$month;

    $day = substr($_POST["date"], 8, 2);
    $filename = $filename.$day;

    $hour = substr($_POST["time"], 0, 2);
    $filename = $filename.$hour;

    $minute = substr($_POST["time"], 3, 2);
    $filename = $filename.$minute;

    $seconds = date('s');
    $filename = $filename.$seconds;


    for ($i = 0; $i < 100 ; $i++) {
        if ($i < 10)
            $number = "0" . strval($i);
        else
            $number = strval($i);

        if (!file_exists($directory . "/" . $filename . $number)) {
            break;
        }
    }
    $filename  = $filename.$number;
    // 1999-22-12 11:12
    return $filename;
}

function isPasswordOK($blog_name) {
    $lines = file($blog_name."/info");
    if ($lines[1] == PASSWORD_MD5."\n") {
        return true;
    }
    else {
        return false;
    }
}

function find_and_return_directory_name() {
    $dirs = array_filter(glob('*'), 'is_dir');

    foreach ($dirs as $single_dir) {
        $infofile = fopen($single_dir."/info", "r");

        if ($infofile) {
            $line = fgets($infofile);

            if ($line == USERNAME."\n") {
                fclose($infofile);
                return $single_dir;
            }
        }
        fclose($infofile);
    }

    return false;
}

?>