<?php
$title = 'Комикс-шоп Яруллин Арслан 241-341';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        body {
            margin: 0;
            font-family: Verdana;
            background: #111;
            color: #e6e6e6;
            padding: 80px 0 60px
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            height: 60px;
            background: #7b0000;
            color: #fff;
            text-align: center;
            padding-top: 18px;
            font-weight: bold
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 35px;
            background: #111;
            color: #bbb;
            text-align: center;
            padding-top: 8px;
            font-size: 13px
        }

        nav a {
            color: #fff;
            margin: 0 20px;
            text-decoration: none;
            font-size: 18px
        }

        nav a:hover {
            color: #ffd000
        }

        .active {
            color: #00c3ff
        }

        main {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center
        }

        table {
            margin: auto;
            border-collapse: collapse;
            background: #162535
        }

        td,
        th {
            padding: 10px 18px;
            border: 1px solid #2d3e50
        }

        th {
            background: #1f3b5c
        }

        img {
            width: 400px;
            height: 300px;
            border-radius: 10px;
            margin: 10px;
            border-radius: 6px
        }

        h1 {
            text-align: center;
            color: #ffd000
        }
    </style>
</head>

<body>

    <header>
        <nav>
            <a href="<?php $link = 'index.php';
                        $current_page = false;
                        $name = 'Главная';
                        echo $link; ?>" <?php if ($current_page) echo ' class="active"'; ?>><?php echo $name; ?></a>
            <a href="<?php $link = 'catalog.php';
                        $current_page = true;
                        $name = 'Каталог';
                        echo $link; ?>" <?php if ($current_page) echo ' class="active"'; ?>><?php echo $name; ?></a>
            <a href="<?php $link = 'gallery.php';
                        $current_page = false;
                        $name = 'Галерея';
                        echo $link; ?>" <?php if ($current_page) echo ' class="active"'; ?>><?php echo $name; ?></a>
        </nav>
    </header>

    <main>
        <h1>Каталог комиксов</h1>
        <table>
            <?php echo '<tr><td>Комикс</td><td>Вселенная</td><td>Цена</td></tr>'; ?>
            <tr>
                <td><?php echo 'Spider-Man #1'; ?></td>
                <td><?php echo 'Marvel'; ?></td>
                <td><?php echo '500 ₽'; ?></td>
            </tr>
            <tr>
                <td><?php echo 'HULK'; ?></td>
                <td><?php echo 'DC'; ?></td>
                <td><?php echo '550 ₽'; ?></td>
            </tr>
            <tr>
                <td><?php echo 'Ninja Turtles'; ?></td>
                <td><?php echo 'DC'; ?></td>
                <td><?php echo '700 ₽'; ?></td>
            </tr>


            <img src="./images/comic_static3.jpg">

            <?php $img = (date('s') % 3) + 1;
            echo '<img src="./images/comic' . $img . '.jpg">'; ?>

    </main>

    <footer>
        Сформировано <?php date_default_timezone_set("Europe/Moscow");
                        echo date('d.m.Y в H-i:s'); ?>
    </footer>

</body>

</html>