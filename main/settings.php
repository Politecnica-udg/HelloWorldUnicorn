<?php
    global $conf_host;
    $activate = TRUE;
    
    $data_base = FALSE;
        $type_db = ""; //MySQL
        define('host', '');
        define('user', '');
        define('pw', '');
        define('db', '');
    $conf_host = [
      'host' => 'http://localhost/act/Unicorn/',
      'lang' => 'es'
    ];
    if ($data_base) {require_once 'db.php';}
    if ($activate) {require_once 'url.php';}
     else{
        RenderResponse("Lo sentimos el sistema esta apagado.");
    }
?>