<?php
$mysqli = mysqli_connect("localhost", "root", "", "friends");

$res = mysqli_query($mysqli, "SELECT * FROM friends");

while ($row = mysqli_fetch_assoc($res)) {
    echo "<a href='?p=delete&id={$row['id']}'>
    {$row['surname']} {$row['name']}
    </a><br>";
}

if (isset($_GET['id'])) {
    mysqli_query($mysqli, "DELETE FROM friends WHERE id=" . $_GET['id']);
    echo "<div class='ok'>Удалено</div>";
}
