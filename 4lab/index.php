<?php

$colsCount = 4;

$tables = array(
    "Apple*Banana*Cherry#Orange*Kiwi*Lemon",
    "Red*Green*Blue#Yellow*Purple",
    "One*Two*Three*Four#Five*Six",
    "Dog*Cat*Bird#Tiger*Lion",
    "PHP*JS*Python#C++*Java",
    "Sun*Moon#Star",
    "Winter*Spring*Summer#Autumn",
    "A*B*C#D*E*F#G*H*I",
    "North*South#East*West",
    "Table*Row*Cell#Data*Info"
);

if ($colsCount <= 0) {
    echo "<h2 class='error'>Неправильное число колонок</h2>";
    exit;
}


function buildRow($line, $colsCount)
{

    $line = trim($line);

    if ($line == "") {
        return "";
    }

    $cells = explode("*", $line);

    $result = "<tr>";

    for ($i = 0; $i < $colsCount; $i++) {

        if (isset($cells[$i])) {
            $result .= "<td>" . $cells[$i] . "</td>";
        } else {
            $result .= "<td></td>";
        }
    }

    $result .= "</tr>";

    return $result;
}



function showTable($structure, $colsCount, $num)
{

    $rows = explode("#", $structure);

    if (count($rows) == 0) {
        echo "<p class='warning'>В таблице нет строк</p>";
        return;
    }

    $rowsHTML = "";

    foreach ($rows as $row) {

        $r = buildRow($row, $colsCount);

        if ($r) {
            $rowsHTML .= $r;
        }
    }

    if ($rowsHTML == "") {
        echo "<p class='warning'>В таблице нет строк с ячейками</p>";
        return;
    }

    echo "<h2>Таблица №" . $num . "</h2>";

    echo "<table class='grid'>";
    echo $rowsHTML;
    echo "</table>";
}


?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <title>Лабораторная работа 4</title>

    <link rel="stylesheet" href="./css/style.css">

</head>

<body>

    <h1>Лабораторная работа №4</h1>

    <?php

    for ($i = 0; $i < count($tables); $i++) {

        showTable($tables[$i], $colsCount, $i + 1);
    }

    ?>

</body>

</html>