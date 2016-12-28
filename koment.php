<?php

//[2p] Komentarze umieszczane są w katalogu o nazwie: RRRRMMDDGGmmSSUU.k (w razie potrzeby skrypt musi tworzyć katalog automatycznie)
//
//[2p] Komentarze umieszczane są w plikach w w/w katalogu o nazwach będących kolejnymi liczbami dziesiętnymi zaczynając od 0.
//
//[2p] Zawartość pliku to:
//
//rodzaj komentarza (zakończony znakiem końca linii)
//data i godzina wysłania komentarza (zakończony znakiem końca linii, format: RRRR-MM-DD, GG:MM:SS, data i czas serwera)
//imię/nazwisko/pseudonim komentującego (zakończony znakiem końca linii)
//treść komentarza

// można dodać semafory

$blogname = $_GET["blogname"];
$postfilename = $_GET["postfilename"];
$comment_dir = $blogname . "/" . $postfilename . ".k";
$comment_path = "";
$semRes = sem_get( 1111, 1, 0666, 0);

if (is_dir($blogname) && file_exists($blogname."/".$postfilename)) {

    if (sem_acquire($semRes)) {

        if (!is_dir($comment_dir)) {
            mkdir($comment_dir);
        }

        for ($i = 0; ; $i++) {
            $comment_path = $comment_dir . "/" . strval($i);
            if (!file_exists($comment_path)) {
                break;
            }
        }

        $commentfilehandle = fopen($comment_path, "w");
        fwrite($commentfilehandle, $_GET["commenttype"]."\n");
        fwrite($commentfilehandle, date('Y-m-d H:i:s')."\n");
        fwrite($commentfilehandle, $_GET["username"]."\n");
        fwrite($commentfilehandle, $_GET["comment"]."\n");
        fclose($commentfilehandle);

        sem_release($semRes);

    }

}

header('Location: blog.php?blogname=' . $_GET["blogname"] );

?>