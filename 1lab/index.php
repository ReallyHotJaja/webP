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
            color: #eee;
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
            background: #1c1c1c;
            color: #aaa;
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
            color: #ffd000
        }

        main {
            padding: 20px;
            text-align: center
        }

        img {
            width: 200px;
            height: 200px;
            border-radius: 10px;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px #000
        }

        h1 {
            color: #ffd000
        }
    </style>
</head>

<body>

    <header>
        <nav>
            <a href="<?php $link = 'index.php';
                        $current_page = true;
                        $name = 'Главная';
                        echo $link; ?>" <?php if ($current_page) echo ' class="active"'; ?>><?php echo $name; ?></a>
            <a href="<?php $link = 'catalog.php';
                        $current_page = false;
                        $name = 'Каталог';
                        echo $link; ?>" <?php if ($current_page) echo ' class="active"'; ?>><?php echo $name; ?></a>
            <a href="<?php $link = 'gallery.php';
                        $current_page = false;
                        $name = 'Галерея';
                        echo $link; ?>" <?php if ($current_page) echo ' class="active"'; ?>><?php echo $name; ?></a>
        </nav>
    </header>

    <main>
        <h1>Магазин комиксов COMIC ZONE</h1>
        <p>Лучшие комиксы Marvel, DC и независимых студий. Новинки каждую неделю, редкие издания и коллекционные выпуски.</p>
        <p>Собери свою коллекцию супергероев и открой новые вселенные.</p>

        <img src="./images/comic_static1.jpg">
        <img src="./images/comic_static2.jpg">

        <?php $img = (date('s') % 3) + 1;
        echo '<img src="./images/comic' . $img . '.jpg">'; ?>
    </main>
    <footer>
        Сформировано <?php date_default_timezone_set("Europe/Moscow");
                        echo date('d.m.Y в H-i:s'); ?>
    </footer>

</body>

</html>