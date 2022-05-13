<?php

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function createToken()
{
    if (!isset($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
}

function validateToken()
{
    if(empty($_SESSION['token']) || $_SESSION['token'] !== filter_input(INPUT_POST, 'token')) {
        exit('Invalid post request');
    }
}

function getPdoInstance()
{
    try {
        $pdo = new PDO(
            DSN,
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );

        return $pdo;
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function submitPersonal($pdo)
{
    $lastName = trim(filter_input(INPUT_POST, 'lastName'));
    $firstName = trim(filter_input(INPUT_POST, 'firstName'));
    $mail = trim(filter_input(INPUT_POST, 'mail'));

    $stmt = $pdo->prepare("INSERT INTO form (lastname, firstname, mailaddress) VALUES (:last, :first, :mail)");
    $stmt->bindValue('last', $lastName, PDO::PARAM_STR);
    $stmt->bindValue('first', $firstName, PDO::PARAM_STR);
    $stmt->bindValue('mail', $mail, PDO::PARAM_STR);
    $stmt->execute();
}

function getPersonal($pdo)
{
    $stmt = $pdo->query("SELECT * FROM form ORDER BY id ASC");
    $personals = $stmt->fetchAll();
    return $personals;
}
