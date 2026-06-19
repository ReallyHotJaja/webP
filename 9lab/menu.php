<div id="menu">
    <?php
    if (!isset($_GET['p'])) $_GET['p'] = 'viewer';

    function item($p, $name)
    {
        echo '<a href="?p=' . $p . '"';
        if ($_GET['p'] == $p) echo ' class="active"';
        echo '>' . $name . '</a>';
    }

    item('viewer', 'Просмотр');
    item('add', 'Добавление записи');
    item('edit', 'Редактирование записи');
    item('delete', 'Удаление записи');

    if ($_GET['p'] == 'viewer') {
        echo '<div id="submenu">';

        function sub($s, $name)
        {
            echo '<a href="?p=viewer&sort=' . $s . '"';
            if (!isset($_GET['sort']) && $s == 'byid') echo ' class="active"';
            if (isset($_GET['sort']) && $_GET['sort'] == $s) echo ' class="active"';
            echo '>' . $name . '</a>';
        }

        sub('byid', 'По умолчанию');
        sub('fam', 'По фамилии');
        sub('birth', 'По дате рождения');

        echo '</div>';
    }
    ?>
</div>