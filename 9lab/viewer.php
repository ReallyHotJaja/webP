<?php
function getFriendsList($type, $page)
{
    $mysqli = mysqli_connect("localhost", "root", "", "friends");

    if (mysqli_connect_errno()) {
        return "<div class='error'>Ошибка подключения к БД</div>";
    }

    $order = "id";
    if ($type == "fam") $order = "surname";
    if ($type == "birth") $order = "birthdate";

    $limit = 6;


    $countRes = mysqli_query($mysqli, "SELECT COUNT(*) as total FROM friends");
    $total = mysqli_fetch_assoc($countRes)['total'];

    if ($total == 0) return "<div class='empty'>Нет записей</div>";

    $pages = ceil($total / $limit);

    if ($page >= $pages) $page = $pages - 1;
    if ($page < 0) $page = 0;


    $start = $page * $limit;


    $res = mysqli_query($mysqli, "SELECT * FROM friends ORDER BY $order LIMIT $start,$limit");


    $html = "<div class='table-container'>";
    $html .= "<table class='styled-table'>";

    $html .= "<thead><tr>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Пол</th>
        <th>Дата рождения</th>
        <th>Телефон</th>
        <th>Email</th>
        <th>Адрес</th>
        <th>Комментарий</th>
    </tr></thead><tbody>";

    while ($row = mysqli_fetch_assoc($res)) {
        $html .= "<tr>
            <td>{$row['surname']}</td>
            <td>{$row['name']}</td>
            <td>{$row['patronymic']}</td>
            <td>{$row['gender']}</td>
            <td>{$row['birthdate']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['email']}</td>
            <td>{$row['address']}</td>
            <td>{$row['comment']}</td>
        </tr>";
    }

    $html .= "</tbody></table></div>";


    if ($pages > 1) {
        $html .= "<div class='pagination'>";


        if ($page > 0) {
            $prev = $page - 1;
            $html .= "<a href='?p=viewer&pg=$prev&sort=$type'>&laquo;</a>";
        }


        for ($i = 0; $i < $pages; $i++) {
            if ($i == $page) {
                $html .= "<span class='active-page'>" . ($i + 1) . "</span>";
            } else {
                $html .= "<a href='?p=viewer&pg=$i&sort=$type'>" . ($i + 1) . "</a>";
            }
        }


        if ($page < $pages - 1) {
            $next = $page + 1;
            $html .= "<a href='?p=viewer&pg=$next&sort=$type'>&raquo;</a>";
        }

        $html .= "</div>";
    }

    return $html;
}
