<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Лабораторная А-3</title>

    <style>
        body {
            font-family: Arial;
            text-align: center;
        }

        .result {
            width: 300px;
            margin: 20px auto;
            padding: 15px;
            font-size: 26px;
            border: 2px solid black;
            text-align: center;
        }

        .keyboard {
            width: 300px;
            margin: auto;
        }

        .keyboard a {
            display: inline-block;
            width: 60px;
            height: 60px;
            line-height: 60px;
            margin: 5px;
            font-size: 22px;
            text-decoration: none;
            background: #f2f2f2;
            border: 1px solid black;
            color: black;
        }

        .reset {
            width: 200px;
            background: #ffdddd;
        }

        footer {
            margin-top: 30px;
            font-size: 18px;
        }
    </style>

</head>

<body>

    <?php

    // если store не передан — первая загрузка
    if (!isset($_GET['store'])) {
        $_GET['store'] = '';
    }

    // если нажата кнопка цифры
    if (isset($_GET['key'])) {
        $_GET['store'] .= $_GET['key'];
    }

    // счетчик нажатий
    if (!isset($_GET['count'])) {
        $_GET['count'] = 0;
    }

    // увеличиваем счетчик только если нажата цифра
    if (isset($_GET['key'])) {
        $_GET['count']++;
    }

    ?>

    <div class="result">
        <?php echo $_GET['store']; ?>
    </div>

    <div class="keyboard">

        <?php
        for ($i = 1; $i <= 9; $i++) {
            echo '<a href="?key=' . $i . '&store=' . $_GET['store'] . '&count=' . $_GET['count'] . '">' . $i . '</a>';
        }
        ?>

        <br>

        <a href="?key=0&store=<?php echo $_GET['store']; ?>&count=<?php echo $_GET['count']; ?>">0</a>

        <br><br>

        <a class="reset" href="?store=&count=<?php echo $_GET['count']; ?>">СБРОС</a>

    </div>

    <footer>
        Количество нажатий: <?php echo $_GET['count']; ?>
    </footer>

</body>

</html> 