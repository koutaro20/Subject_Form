<?php

session_start();

header('X-FRAME-OPTIONS:DENY');

define('DSN', 'mysql:host=db;dbname=form-contents;charset=utf8mb4');
define('DB_USER', 'user');
define('DB_PASS', 'userpass');

require_once(__DIR__ . '/function/functions.php');

createToken();
