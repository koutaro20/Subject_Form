<?php

require_once(__DIR__ . '/./app/config.php');

$pdo = getPdoInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    validateToken();
    submitPersonal($pdo);
}

$pageFlag = 0;

if(!empty($_POST['btn-submit'])){
    $pageFlag = 1;
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
    <?php if ($pageFlag === 0) :?>
    <div class="d-flex justify-content-center align-items-center form">
        <form action="" method="POST" class="col-md-6 offset-md-3 mx-auto">
            <div class="row">
                <div class="col-sm">
                    <input type="text" class="form-control" name="lastName" placeholder="姓" aria-label="姓">
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" name="firstName" placeholder="名" aria-label="名">
                </div>
            </div>
            <div class="row mail-margin">
                <div class="col-sm">
                    <input type="text" class="form-control" name="mail" placeholder="メールアドレス">
                </div>
            </div>
    
            <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
            <div class="d-grid gap-2 col-3 mx-auto">
                <button type="submit" class="btn btn-info" name="btn-submit" value="送信する">送信する</button>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <!-- result -->
    <?php if ($pageFlag === 1) : ?>
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
        <button type="button" class="btn btn-info"><a href="" class="add">追加する</a></button>
    </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>