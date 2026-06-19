<?php
header("Content-Type: text/html; charset=UTF-8");

function analyze($text)
{
    //  UTF-8 → CP1251
    $text_cp = iconv("UTF-8", "CP1251//IGNORE", $text);

    $len = strlen($text_cp);

    $letters = $upper = $lower = $digits = $punct = 0;
    $words = [];
    $symbols = [];

    $word = '';

    for ($i = 0; $i < strlen($text_cp); $i++) {

        $c = $text_cp[$i];
        $c_utf = iconv("CP1251", "UTF-8", $c);
        $c_lower = strtolower($c);

        // символы
        $symbols[$c_lower] = ($symbols[$c_lower] ?? 0) + 1;

        // цифры
        if (ctype_digit($c)) $digits++;

        // пунктуация
        if (strpos(".,!?;:", $c) !== false) $punct++;

        // буквы
        if (preg_match('/[a-zа-яё]/iu', $c_utf)) {

            $letters++;

            if (preg_match('/[a-zа-яё]/u', $c_utf)) $lower++;
            if (preg_match('/[A-ZА-ЯЁ]/u', $c_utf)) $upper++;

            $word .= $c;
        } else {
            if ($word != '') {
                $w = strtolower(iconv("CP1251", "UTF-8", $word));
                $words[$w] = ($words[$w] ?? 0) + 1;
                $word = '';
            }
        }
    }

    if ($word != '') {
        $w = strtolower(iconv("CP1251", "UTF-8", $word));
        $words[$w] = ($words[$w] ?? 0) + 1;
    }

    ksort($words);
    ksort($symbols);

    echo "<table>";
    echo "<tr><td>Символов</td><td>$len</td></tr>";
    echo "<tr><td>Букв</td><td>$letters</td></tr>";
    echo "<tr><td>Заглавных</td><td>$upper</td></tr>";
    echo "<tr><td>Строчных</td><td>$lower</td></tr>";
    echo "<tr><td>Цифр</td><td>$digits</td></tr>";
    echo "<tr><td>Знаков препинания</td><td>$punct</td></tr>";
    echo "<tr><td>Слов</td><td>" . count($words) . "</td></tr>";
    echo "</table>";

    echo "<h3>Слова</h3><table>";
    foreach ($words as $k => $v)
        echo "<tr><td>$k</td><td>$v</td></tr>";
    echo "</table>";

    echo "<h3>Символы</h3><table>";
    foreach ($symbols as $k => $v)
        echo "<tr><td>" . iconv("CP1251", "UTF-8", $k) . "</td><td>$v</td></tr>";
    echo "</table>";
}
?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #0f3d0f, #1f6f1f);
            color: white;
        }

        .container {
            width: 600px;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.08);
            padding: 20px;
            border-radius: 15px;
        }

        .src {
            color: #d4ff00;
            font-style: italic;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        td {
            border: 1px solid #9cff00;
            padding: 8px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #d4ff00;
        }
    </style>

</head>

<body>

    <div class="container">

        <?php
        if (isset($_POST['data']) && trim($_POST['data']) != '') {
            echo "<div class='src'>" . htmlspecialchars($_POST['data']) . "</div>";
            analyze($_POST['data']);
        } else {
            echo "Нет текста для анализа";
        }
        ?>

        <a href="index.html">Другой анализ</a>

    </div>

</body>

</html>