<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Яруллин А.Ф. — Группа 241-351 — ЛР №2 — Вариант 1</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <div class="logo">
            <img src="logo.jpg" alt="Логотип">
        </div>
        <div class="headtext">
            <h1>Яруллин Арслан Фердинандович</h1>
            <p>Группа 241-351 — Лабораторная работа №2 — Вариант 1</p>
        </div>
    </header>

    <main>

        <?php

        $x = -10;
        $step = 2;
        $count = 50;
        $type = 'E';

        $min_limit = -1000;
        $max_limit = 1000;

        $i = 0;

        $sum = 0;
        $amount = 0;
        $min_val = null;
        $max_val = null;

        $rows = [];

        function format_value($v)
        {
            if ($v === 'error') return 'error';
            return number_format($v, 3, '.', '');
        }

        while ($i < $count) {

            if ($x <= 10) {
                $f = 10 * $x - 5;
            } elseif ($x < 20) {
                $f = ($x + 3) * $x * $x / 3;
            } else {
                if ($x == 25) {
                    $f = 'error';
                } else {
                    $f = 3 / ($x - 25) + 2;
                }
            }

            if ($f !== 'error') {
                $f = round($f, 3);

                $sum += $f;
                $amount++;

                if ($min_val === null || $f < $min_val) $min_val = $f;
                if ($max_val === null || $f > $max_val) $max_val = $f;

                $rows[] = [$x, format_value($f)];

                if ($f >= $max_limit || $f < $min_limit) break;
            } else {
                $rows[] = [$x, 'error'];
            }

            $x += $step;
            $i++;
        }

        switch ($type) {

            case 'B':
                echo "<ul>";
                foreach ($rows as $r) {
                    echo "<li>f({$r[0]})={$r[1]}</li>";
                }
                echo "</ul>";
                break;

            case 'C':
                echo "<ol>";
                foreach ($rows as $r) {
                    echo "<li>f({$r[0]})={$r[1]}</li>";
                }
                echo "</ol>";
                break;

            case 'D':
                echo "<table class='tbl'><tr><th>№</th><th>x</th><th>f(x)</th></tr>";
                $n = 1;
                foreach ($rows as $r) {
                    echo "<tr><td>{$n}</td><td>{$r[0]}</td><td>{$r[1]}</td></tr>";
                    $n++;
                }
                echo "</table>";
                break;

            case 'E':
                foreach ($rows as $r) {
                    echo "<div   class='box'>f({$r[0]})={$r[1]}</div>";
                }
                break;

            default:
                $last = count($rows) - 1;
                foreach ($rows as $k => $r) {
                    echo "f({$r[0]})={$r[1]}";
                    if ($k < $last) echo "<br>";
                }
        }

        echo "<hr>";

        if ($amount > 0) {
            $avg = $sum / $amount;
            echo "<div class='stats'>";
            echo "<p>Количество значений: {$amount}</p>";
            echo "<p>Сумма: " . format_value($sum) . "</p>";
            echo "<p>Минимум: " . format_value($min_val) . "</p>";
            echo "<p>Максимум: " . format_value($max_val) . "</p>";
            echo "<p>Среднее: " . format_value($avg) . "</p>";
            echo "</div>";
        }

        ?>

    </main>

    <footer>
        Тип верстки: <b><?php echo $type; ?></b>
    </footer>

</body>

</html>