<?php
date_default_timezone_set('Europe/Moscow');
function makeLink($n)
{
    $link = "?content=$n";

    if (isset($_GET['html_type'])) {
        $link .= "&html_type=" . $_GET['html_type'];
    }

    return ($n <= 9) ? "<a class='num' href='$link'>$n</a>" : $n;
}

function showTable()
{
    $content = $_GET['content'] ?? null;

    echo "<div class='table-wrap'><table>";

    if (!$content) {
        for ($i = 2; $i <= 9; $i++) {
            echo "<tr>";
            for ($j = 2; $j <= 9; $j++) {
                echo "<td>" . makeLink($i) . " × " . makeLink($j) . " = " . makeLink($i * $j) . "</td>";
            }
            echo "</tr>";
        }
    } else {
        for ($j = 2; $j <= 9; $j++) {
            echo "<tr><td>" . makeLink($content) . " × " . makeLink($j) . " = " . makeLink($content * $j) . "</td></tr>";
        }
    }

    echo "</table></div>";
}

function showDiv()
{
    $content = $_GET['content'] ?? null;

    echo "<div class='grid'>";

    if (!$content) {
        for ($i = 2; $i <= 9; $i++) {
            echo "<div class='card'>";
            for ($j = 2; $j <= 9; $j++) {
                echo "<div class='row'>
                        <div class='expr'>
                            " . makeLink($i) . " × " . makeLink($j) . "
                        </div>
                        <div class='result'>
                            = " . makeLink($i * $j) . "
                        </div>
                      </div>";
            }
            echo "</div>";
        }
    } else {
        echo "<div class='card'>";
        for ($j = 2; $j <= 9; $j++) {
            echo "<div class='row'>
                    <div class='expr'>
                        " . makeLink($content) . " × " . makeLink($j) . "
                    </div>
                    <div class='result'>
                        = " . makeLink($content * $j) . "
                    </div>
                  </div>";
        }
        echo "</div>";
    }

    echo "</div>";
}

$type = $_GET['html_type'] ?? null;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Таблица умножения</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #0f172a;
            display: flex;
            justify-content: center;
        }

        .container {
            background: #1e293b;
            margin: 30px;
            padding: 20px;
            border-radius: 14px;
            width: 80%;
            color: white;
        }

        h2 {
            text-align: center;
        }

        .top-menu {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 15px 0;
        }

        .top-menu a {
            padding: 8px 14px;
            background: #334155;
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }

        .active {
            background: #22c55e !important;
        }

        .layout {
            display: flex;
            gap: 20px;
        }


        .side-menu {
            width: 120px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .side-menu a {
            padding: 8px;
            background: #334155;
            color: white;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
        }


        .content {
            flex: 1;
        }

        .num {
            background: #e11d48;
            padding: 4px 7px;
            border-radius: 6px;
            color: white;
            display: inline-block;
            min-width: 22px;
            text-align: center;
        }


        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid white;
        }

        td {
            padding: 8px;
            text-align: center;
            white-space: nowrap;
            border: 1px solid white;
        }


        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }

        .card {
            background: #334155;
            padding: 12px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .expr {
            display: flex;
            gap: 5px;
        }

        .result {
            min-width: 35px;
            text-align: right;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            color: #aaa;
        }
    </style>

</head>

<body>

    <div class="container">

        <h2>Таблица умножения</h2>

        <div class="top-menu">
            <a href="?html_type=TABLE" class="<?= $type === 'TABLE' ? 'active' : '' ?>">Table</a>
            <a href="?html_type=DIV" class="<?= $type === 'DIV' ? 'active' : '' ?>">Div</a>
        </div>

        <div class="layout">


            <div class="side-menu">
                <a href="?" class="<?= !isset($_GET['content']) ? 'active' : '' ?>">All</a>

                <?php
                for ($i = 2; $i <= 9; $i++) {
                    echo "<a class='" . ((isset($_GET['content']) && $_GET['content'] == $i) ? 'active' : '') .
                        "' href='?content=$i" . ($type ? "&html_type=$type" : "") . "'>$i</a>";
                }
                ?>
            </div>


            <div class="content">
                <?php
                if (!$type || $type == 'TABLE') showTable();
                else showDiv();
                ?>
            </div>

        </div>

        <div class="footer">
            <?php
            echo ($type === 'DIV' ? 'Div' : 'Table') . " | ";
            echo isset($_GET['content']) ? "Column " . $_GET['content'] : "Full table";
            echo " | " . date("d.m.Y H:i:s");
            ?>
        </div>

    </div>

</body>

</html>