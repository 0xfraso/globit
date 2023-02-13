<?php

function isActive($pagename, $main_color)
{
    if (basename($_SERVER['PHP_SELF']) == $pagename) {
        echo "fw-bold text-" . $main_color;
    }
}

function sec_session_start()
{
    $session_name = 'sec_session_id'; // Imposta un nome di sessione
    $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
    $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
    ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
    $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
    session_start(); // Avvia la sessione php.
    session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
}

function signin($email, $password, $dbh)
{
    if ($user = $dbh->preparedQuery("CHECK_LOGIN", $email)[0]) {
        //var_dump($user);

        $password = hash('sha512', $password . $user['salt']);

        if ($user["password"] == $password) {
            //$user_browser = $_SERVER["HTTP_USER_AGENT"];

            $user_id = preg_replace("/[^0-9]+/", "", $user["id"]); // ci proteggiamo da un attacco XSS
            $_SESSION['user_id'] = $user_id;
            $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user["username"]); // ci proteggiamo da un attacco XSS
            $_SESSION['username'] = $username;
            //$_SESSION['login_string'] = hash('sha512', $password . $user_browser);
            $_SESSION['login_string'] = hash('sha512', $password);
            // Login eseguito con successo.
            return true;
        } else {
            //password incorretta, registriamo tentativo di login
            $dbh->preparedQuery("INSERT_LOGIN_ATTEMPT", $user["id"]);
            return false;
        }
    } else {
        // l'utente inserito non esiste
        return false;
    }
}

function signin_check($dbh)
{
    // Verifica che tutte le variabili di sessione siano impostate correttamente
    if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        //$user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
        if ($result = $dbh->preparedQuery("SELECT_USER_PASSWORD", $user_id)[0]) {
            //$login_check = hash('sha512', $result["password"] . $user_browser);
            $login_check = hash('sha512', $result["password"]);
            if ($login_check == $login_string) {
                // Login eseguito!!!!
                return true;
            } else {
                //  Login non eseguito
                return false;
            }
        } else {
            // Login non eseguito
            return false;
        }
    } else {
        // Login non eseguito
        return false;
    }
}


function checkbrute($user_id, $dbh)
{
    // Recupero il timestamp
    $now = time();
    // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
    $valid_attempts = $now - (2 * 60 * 60);
    $result = $dbh->preparedQuery("CHECK_LOGIN_ATTEMPTS", $user_id, $valid_attempts)[0]["COUNT(*)"];
    if ($result > 5) {
        return true;
    } else {
        return false;
    }
}


function timeSince($created_at)
{
    $created_at = strtotime($created_at);
    $elapsed_time = time() - $created_at;

    if ($elapsed_time < 60) {
        return "$elapsed_time second" . ($elapsed_time == 1 ? "o" : "i") . " fa";
    } elseif ($elapsed_time < 3600) {
        $minutes = floor($elapsed_time / 60);
        return "$minutes minut" . ($minutes == 1 ? "o" : "i") . " fa";
    } elseif ($elapsed_time < 86400) {
        $hours = floor($elapsed_time / 3600);
        return "$hours or" . ($hours == 1 ? "a" : "e") . " fa";
    } elseif ($elapsed_time < 31536000) {
        // Less than 1 year
        $days = floor($elapsed_time / 86400);
        return "$days giorn" . ($days == 1 ? "o" : "i") . " fa";
    } else {
        // More than 1 year
        $years = floor($elapsed_time / 31536000);
        return "$years ann" . ($years == 1 ? "o" : "i") . " fa";
    }
}

function uploadImage($path, $image)
{
    $imageName = basename($image["name"]);
    $fullPath = dirname(getcwd()) . "/" . $path . $imageName;

    $maxKB = 2000;
    $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
    $result = 0;
    $msg = "";
    //Controllo se immagine è veramente un'immagine
    $imageSize = getimagesize($image["tmp_name"]);
    if ($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }
    //Controllo dimensione dell'immagine < 500KB
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }

    //Controllo estensione del file
    $imageFileType = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $acceptedExtensions)) {
        $msg .= "Accettate solo le seguenti estensioni: " . implode(",", $acceptedExtensions);
    }

    //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
    if (file_exists($fullPath)) {
        $i = 1;
        do {
            $i++;
            $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME) . "_$i." . $imageFileType;
        } while (file_exists($path . $imageName));
        $fullPath = dirname(getcwd()) . "/" . $path . $imageName;
    }

    //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
    if (strlen($msg) == 0) {
        if (is_uploaded_file($image['tmp_name'])) {
            if (!move_uploaded_file($image["tmp_name"], $fullPath)) {
                $msg .= "Errore nel caricamento dell'immagine, errore: " . $image['error'];
            } else {
                $result = 1;
                $msg = $imageName;
            }
        }
    }
    return array($result, $msg);
}

function processLinks($text, $main_color)
{
    // manda a capo il testo quando trova \n 
    $text = nl2br($text, false);
    // pattern per trovare i link
    $link_pattern = '#(https?:\/\/[^\s]+)#';
    $youtube_pattern = '#(https?:\/\/www\.youtube\.com\/watch\?v=)[a-zA-Z0-9-_]+#';
    preg_match_all($link_pattern, $text, $matches);

    if (!empty($matches[0]))
        foreach ($matches[0] as $match) {
            if (preg_match($youtube_pattern, $match)) {
                $text = preg_replace_callback($youtube_pattern, function ($m) {
                    $link = $m[0];
                    $video_id = substr($link, strpos($link, "=") + 1); //estrae solo l'id del video
                    $accessibility_captions = "?cc_load_policy=1";
                    $youtube_embed = '<iframe allowfullscreen class="rounded" style="display: block; aspect-ratio: 16/9" src="https://www.youtube.com/embed/' . $video_id . $accessibility_captions . '"></iframe>';
                    return $youtube_embed;
                }, $text);
            } else {
                $text = preg_replace($link_pattern, "<a class='text-$main_color fw-bold' href='$0'>$0</a>", $text);
            }
        }
    return $text;
}

function processTags($text, $main_color)
{
    $pattern = '/#([\w]+)/';
    $replacement = "<a class='text-$main_color' href='explore.php?tag=$1'>#$1</a>";

    return preg_replace($pattern, $replacement, $text);
}
