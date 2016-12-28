<?php

define('SEM_KEY', 1000);


$semRes = sem_get(SEM_KEY, 1, 0666, 0);

if(sem_acquire($semRes)) {

    check_if_dir_exist_and_create_it_if_not();

    sem_release($semRes);
}

header('Location: blog.php?blogname='.$_POST["title"] );

function check_if_dir_exist_and_create_it_if_not() {
    if (!is_dir($_POST["title"])) {
        make_dir($_POST["title"]);
        create_info_file();
    }
    else {
        echo "Taki blog już istnieje..";
    }
}

function make_dir($name) {
    mkdir($name, 0777);
}

function create_info_file() {
    $info_file = fopen($_POST["title"]."/info", "w");
    $username = $_POST["username"]."\n";
    $passwordmd5 = md5($_POST["password"])."\n";
    $description = $_POST["description"];
    fwrite($info_file, $username);
    fwrite($info_file, $passwordmd5);
    fwrite($info_file, $description);
    fclose($info_file);
}







?>