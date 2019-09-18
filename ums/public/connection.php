<?php

/**
 * Effettua la connessione al DB mysql
 */

$config = require 'config.php';

$mysqli = new mysqli(
    $config['mysql_host'],
    $config['mysql_user'],
    $config['mysql_password'],
    $config['mysql_db']
);

unset($config); // così non lascio config globale

if($mysqli->connect_error){
    die($mysqli->connect_error);
}
