<?php

require 'public/function/functions.php';

define('DSN', 'mysql:host=db;dbname=form-contents;charset=utf8mb4');
define('DB_USER', 'user');
define('DB_PASS', 'userpass');

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
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    submitPersonal($pdo);
}

$personals = getPersonal($pdo);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/styles.css">
    <title>SubjectForm</title>
</head>
<body>
    <!-- input -->
    <form action="" method="POST" class="col-md-6 offset-md-3">
        <div class="row">
            <div class="col-sm">
                <input type="text" class="form-control" name="lastName" placeholder="姓" aria-label="姓">
            </div>
            <div class="col-sm">
                <input type="text" class="form-control" name="firstName" placeholder="名" aria-label="名">
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <input type="text" class="form-control" name="mail" placeholder="メールアドレス">
            </div>
        </div>

        <div class="d-grid gap-2 col-3 mx-auto">
            <button type="submit" class="btn btn-info" name="btn-submit">送信する</button>
        </div>
    </form>
    <!-- result -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">姓</th>
                <th scope="col">名</th>
                <th scope="col">メールアドレス</th>
            </tr>
        </thead>
        <tbody>
            <!-- php foreach回す -->
            <?php foreach ($personals as $personal): ?>
                <tr>
                    <th scope="row"><?= h($personal->id); ?></th>
                    <td><?= h($personal->lastname); ?></td>
                    <td><?= h($personal->firstname); ?></td>
                    <td><?= h($personal->mailaddress); ?></td>
                </tr>
            <?php endforeach; ?>
        
        </tbody>
    </table>
    <div class="d-grid gap-2 col-3 mx-auto">
        <!-- aタグで遷移させるinput.phpに -->
        <button type="button" class="btn btn-info">追加する</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

































