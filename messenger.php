<?php

// If this script gets empty nickname it sends only all messsages from Messenger Bath in response, otherwise it adds new message and responds whole bath


$semRes = sem_get(1001, 1, 0666, 0);

if(sem_acquire($semRes)) {

    check_if_dir_exist_and_create_it_if_not($_GET["blogname"]."/messengerBath");
    deleteLastIfLimitIsReached();
    if (strlen($_GET["nickname"]) > 0)
        putPostToFile($_GET["blogname"]."/messengerBath", $_GET["nickname"], $_GET["message"]);

    sem_release($semRes);
}

sendAllMessagesInResponse();

function deleteLastIfLimitIsReached() {
    $messages = getAllMessageFiles();
    if (count($messages) > 10) {
        unlink($_GET["blogname"]."/messengerBath/".$messages[2]);
    }
}

function check_if_dir_exist_and_create_it_if_not($name) {
    if (!is_dir($name)) {
        mkdir($name, 0777);
    }
}

function putPostToFile($directory, $nickname, $message) {
    $messagefile = fopen($directory."/".time(), "w");
    fwrite($messagefile, $nickname."\n");
    fwrite($messagefile, $message);
    fclose($messagefile);
}

function getAllMessageFiles() {
    return array_filter(scandir($_GET["blogname"]."/messengerBath"), function($item) {
        return !is_dir($_GET["blogname"]."/messengerBath/" . $item);
    });
}

// sending response
function sendAllMessagesInResponse() {
    $messages = getAllMessageFiles();

    $result = "";


    foreach ($messages as $message) {
        $result = $result.date( "H:i:s " ,$message);

        $lines = file($_GET["blogname"]."/messengerBath/".$message, FILE_IGNORE_NEW_LINES);

        $result = $result.$lines[0].": ";
        $result = $result.$lines[1]."\n";
    }

    echo $result;
}


?>

