<?php

echo '<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Записная книжка</title>
<link rel="stylesheet" href="style.css">
</head>
<body>';

echo '<div class="container">';


require 'menu.php';


if (!isset($_GET['p'])) {
    $_GET['p'] = 'viewer';
}

if ($_GET['p'] == 'viewer') {

    include 'viewer.php';


    if (!isset($_GET['pg']) || $_GET['pg'] < 0) {
        $_GET['pg'] = 0;
    }


    if (
        !isset($_GET['sort']) ||
        !in_array($_GET['sort'], ['byid', 'fam', 'birth'])
    ) {
        $_GET['sort'] = 'byid';
    }


    echo getFriendsList($_GET['sort'], $_GET['pg']);
} else if (file_exists($_GET['p'] . '.php')) {

    include $_GET['p'] . '.php';
} else {

    echo "<div class='error'>Страница не найдена</div>";
}


echo '</div></body></html>';
