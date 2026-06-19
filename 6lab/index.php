<?php

function randVal()
{
    return mt_rand(1, 100);
}

$isPost = isset($_POST['A']);
$view = $_POST['VIEW'] ?? ($_GET['VIEW'] ?? 'browser');

if ($isPost) {

    $fio = $_POST['FIO'];
    $group = $_POST['GROUP'];
    $about = $_POST['ABOUT'];
    $task = $_POST['TASK'];

    $A = floatval(str_replace(',', '.', $_POST['A']));
    $B = floatval(str_replace(',', '.', $_POST['B']));
    $C = floatval(str_replace(',', '.', $_POST['C']));

    $user_result = $_POST['RESULT'];

    switch ($task) {

        case 'mean':
            $result = round(($A + $B + $C) / 3, 2);
            $task_name = "Среднее арифметическое";
            break;

        case 'perimeter':
            $result = $A + $B + $C;
            $task_name = "Периметр треугольника";
            break;

        case 'area':
            if ($A + $B > $C && $A + $C > $B && $B + $C > $A) {
                $p = ($A + $B + $C) / 2;
                $result = round(sqrt($p * ($p - $A) * ($p - $B) * ($p - $C)), 2);
            } else {
                $result = "Ошибка: треугольник не существует";
            }
            $task_name = "Площадь треугольника";
            break;

        case 'volume':
            $result = $A * $B * $C;
            $task_name = "Объем параллелепипеда";
            break;

        case 'max':
            $result = max($A, $B, $C);
            $task_name = "Максимум";
            break;

        case 'min':
            $result = min($A, $B, $C);
            $task_name = "Минимум";
            break;
    }

    if (!is_numeric($result)) {
        $check = $result;
    } elseif ($user_result === "") {
        $check = "Задача самостоятельно не решена";
    } else {
        $user_val = floatval(str_replace(',', '.', $user_result));
        $epsilon = 0.05;
        if (abs($user_val - $result) <= $epsilon) {
            $check = "Тест пройден";
        } else {
            $check = "Ошибка: тест не пройден";
        }
    }

    $out = "";
    $out .= "ФИО: $fio<br>";
    $out .= "Группа: $group<br><br>";
    if ($about) $out .= "О себе: $about<br><br>";
    $out .= "Задача: $task_name<br>";
    $out .= "A = $A, B = $B, C = $C<br>";
    $out .= "Ваш ответ: $user_result<br>";
    $out .= "Правильный ответ: $result<br><br>";
    $out .= "<b>$check</b><br>";

    if (isset($_POST['send_mail'])) {
        $mail = $_POST['MAIL'];

        mail(
            $mail,
            "Результат теста",
            str_replace("<br>", "\n", $out),
            "Content-type: text/plain; charset=utf-8"
        );

        $out .= "<br>Результаты теста были автоматически отправлены на e-mail $mail";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ЛР6</title>

    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        input,
        select,
        textarea {
            width: 250px;
        }

        textarea {
            height: 60px;
        }

        .btn {
            padding: 10px 15px;
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
        }

        .print {
            font-size: 14px;
        }

        .print .btn,
        .print a {
            display: none;
        }
    </style>

    <script>
        function toggleMail() {
            let block = document.getElementById("mail_block");
            block.style.display = document.getElementById("send_mail").checked ? "block" : "none";
        }
    </script>

</head>

<body class="<?= $view == 'print' ? 'print' : '' ?>">

    <h2>Тест математических знаний</h2>

    <?php if ($isPost): ?>

        <div class="result">
            <?= $out ?>

            <?php if ($view == 'browser'): ?>
                <br><br>
                <a href="?FIO=<?= $fio ?>&GROUP=<?= $group ?>&VIEW=browser">Повторить тест</a>
            <?php endif; ?>
        </div>

    <?php else: ?>

        <form method="post">

            <div class="form-group">
                <label>ФИО</label>
                <input type="text" name="FIO" value="<?= $_GET['FIO'] ?? '' ?>">
            </div>

            <div class="form-group">
                <label>Группа</label>
                <input type="text" name="GROUP" value="<?= $_GET['GROUP'] ?? '' ?>">
            </div>

            <div class="form-group">
                <label>A</label>
                <input type="text" name="A" value="<?= randVal() ?>">
            </div>

            <div class="form-group">
                <label>B</label>
                <input type="text" name="B" value="<?= randVal() ?>">
            </div>

            <div class="form-group">
                <label>C</label>
                <input type="text" name="C" value="<?= randVal() ?>">
            </div>

            <div class="form-group">
                <label>Ваш ответ</label>
                <input type="text" name="RESULT">
            </div>

            <div class="form-group">
                <label>О себе</label>
                <textarea name="ABOUT"></textarea>
            </div>

            <div class="form-group">
                <label>Тип задачи</label>
                <select name="TASK">
                    <option value="mean">Среднее арифметическое</option>
                    <option value="perimeter">Периметр треугольника</option>
                    <option value="area">Площадь треугольника</option>
                    <option value="volume">Объем параллелепипеда</option>
                    <option value="max">Максимум</option>
                    <option value="min">Минимум</option>
                </select>
            </div>

            <div class="form-group">
                <label>Версия</label>
                <select name="VIEW">
                    <option value="browser">Для просмотра в браузере</option>
                    <option value="print">Для печати</option>
                </select>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" id="send_mail" name="send_mail" onclick="toggleMail()">
                    Отправить результат на email
                </label>
            </div>

            <div id="mail_block" style="display:none;">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="MAIL">
                </div>
            </div>

            <br>
            <button class="btn">Проверить</button>

        </form>

    <?php endif; ?>

</body>

</html>