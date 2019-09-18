<?php

require_once 'connection.php';

/*
 * Funzioni Helpers - per popolare un db
 */

/**
 * @param $param string
 * @return mixed|null
 */
function getConfig($param, $default = null)
{
    $config = require 'config.php';
    return array_key_exists($param, $config) ? $config[$param] : $default;
}

/**
 * @param $param
 * @param null $default
 * @return mixed|null
 */
function getParam($param, $default = null)
{
    return !empty($_REQUEST[$param]) ? $_REQUEST[$param] : $default;
}

/**
 * @return string
 */
function getRandName()
{
    $names = ['Roberto', 'Giovanni', 'Giulia', 'Mario', 'Alberto', 'Stefano'];
    $lastnames = ['Rossi', 'Re', 'Mendoza', 'Wilde', 'Cruz', 'Gianotto'];

    $rand_1 = mt_rand(0, count($names) - 1);
    $rand_2 = mt_rand(0, count($lastnames) - 1);

    return $names[$rand_1] . ' ' . $lastnames[$rand_2];
}

/**
 * @param $name
 * @return string
 */
function getRandEmail($name)
{
    $domains = ['google.com', 'yahoo.it', 'hotmail.it', 'libero.it'];
    $rand_1 = mt_rand(0, count($domains) - 1);

    return str_replace(' ', '.', $name) . mt_rand(10, 99) . '@' . $domains[$rand_1];
}

/**
 * @return string
 */
function getRandFiscalCode()
{
    // non controlla il codice fiscale per davvero, ci serve solo una stringa tipo codice fiscale
    $i = 16;
    $res = '';
    while ($i > 0) {
        $res .= chr(mt_rand(65, 90));
        $i--;
    }
    return $res;
}

/**
 * @return int
 */
function getRandomAge()
{
    return mt_rand(0, 120);
}

/**
 * @param $totale
 * @param mysqli $conn
 */
function insertRandUser($totale, mysqli $conn)
{
    while ($totale > 0) {
        $username = getRandName();
        $email = getRandEmail($username);
        $fiscalcode = getRandFiscalCode();
        $age = getRandomAge();
        $sql = "INSERT INTO corsophp.users (username, email, fiscalcode, age) VALUES ";
        $sql .= " ('$username', '$email', '$fiscalcode', $age) ";
        $result = $conn->query($sql);
        echo $totale . ' ' . $sql . '<br>';
        if (!$result) {
            echo $conn->error;
        } else {
            $totale--;
        }
    }
}

/**
 * @param array $params
 * @return array
 */
function getUsers(array $params = [])
{
    /** @var mysqli $conn */
    $conn = $GLOBALS['mysqli'];

    $records = [];

    $orderBy = (array_key_exists('orderBy', $params)) ? $params['orderBy'] : 'id';

    $limit = (int)(array_key_exists('recordsPerPage', $params)) ? $params['recordsPerPage'] : 10;

    $search = (array_key_exists('search', $params)) ? $params['search'] : '';

    $search = $conn->escape_string($search);

    $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';

    $page = array_key_exists('page', $params) ? $params['page'] : 0;

    $start = $limit * ($page - 1);

    if($start < 0){
        $start = 0;
    }

    if ($orderDir !== 'ASC' && $orderDir !== 'DESC') {
        $orderDir = 'ASC';
    }

    // composizione della query
    $sql = "SELECT * FROM users ";

    if ($search) {
        $sql .= " WHERE username LIKE '%$search%'";
        $sql .= " OR email LIKE '%$search%'";
        $sql .= " OR fiscalcode LIKE '%$search%'";
        $sql .= " OR age LIKE '%$search%'";
        $sql .= " OR id LIKE '%$search%'";
    }

    $sql .= " ORDER BY " . $orderBy . " " . $orderDir . " LIMIT ". $start . ", " . $limit;

    echo $sql;

    $res = $conn->query($sql);

    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $records[] = $row;
        }
    }

    return $records;
}

/**
 * @param array $params
 * @return int
 */
function countUsers(array $params = [])
{
    /** @var mysqli $conn */
    $conn = $GLOBALS['mysqli'];
    $search = (array_key_exists('search', $params)) ? $params['search'] : '';
    $search = $conn->escape_string($search);

    // composizione della query
    $sql = "SELECT COUNT(*) AS total FROM users ";

    if ($search) {
        $sql .= " WHERE username LIKE '%$search%'";
        $sql .= " OR email LIKE '%$search%'";
        $sql .= " OR fiscalcode LIKE '%$search%'";
        $sql .= " OR age LIKE '%$search%'";
        $sql .= " OR id LIKE '%$search%'";
    }

    echo $sql;

    $res = $conn->query($sql);

    $total = 0;
    if ($res) {
        $row = $res->fetch_assoc();
        $total = (int)$row['total'];
    } else {
        die($conn->error);
    }

    return $total;
}

echo countUsers();