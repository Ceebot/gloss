<?

require_once 'php/helper.php';
require_once 'php/connect.php';
/** @var $mysql */
session_start();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/header.less">
    <title>Глянец</title>
</head>
<body>
<header class="header">
    <div class="container header__container">
        <ul class="header__list">
            <li class="header__item">
                <a href="index.php" class="header__link">Главная</a>
            </li>
            <li class="header__item">
                <a href="#section-do" class="header__link">Товары и услуги</a>
            </li>
            <li class="header__item">
                <a href="#section-contacts" class="header__link">Контакты</a>
            </li>
            <li class="header__item">
                <a href="#section-clients" class="header__link">Отзывы</a>
            </li>

            <?
            $id = $_SESSION['user'];
            $user = $mysql->query("SELECT * FROM admin WHERE id='$id'")->fetch_assoc();
            $users = [];
            array_push($users, [
                'id' => $user['id'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname']
            ]) ?>
            <? if (isset($_SESSION['user']) && $_SESSION['user'] != '') {
                $session = true;
            } else {
                $session = false;
            }
            ?>

            <li class="header__item">
                <?= vueTag("vue-admin", [
                    'users' => $users,
                    'session' => $session
                ]) ?>
            </li>
        </ul>
        <a href="index.php" class="header__logo">
            <img src="img/icon.png" alt="Логотип" class="logo-img">
        </a>
    </div>
</header>
<script src="dist/index_bundle.js"></script>
