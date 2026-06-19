<?php
$mysqli = mysqli_connect("localhost", "root", "", "friends");

if (mysqli_connect_errno()) {
    echo "<div class='error'>Ошибка подключения к БД</div>";
    exit();
}


if (isset($_POST['btn'])) {


    foreach ($_POST as $key => $value) {
        if ($key != 'btn' && trim($value) == '') {
            echo "<div class='error'>Заполните все поля</div>";
            return;
        }
    }

    $sql = "UPDATE friends SET 
        surname='" . $_POST['surname'] . "',
        name='" . $_POST['name'] . "',
        patronymic='" . $_POST['patronymic'] . "',
        gender='" . $_POST['gender'] . "',
        birthdate='" . $_POST['birthdate'] . "',
        phone='" . $_POST['phone'] . "',
        email='" . $_POST['email'] . "',
        address='" . $_POST['address'] . "',
        comment='" . $_POST['comment'] . "'
        WHERE id=" . $_POST['id'];

    mysqli_query($mysqli, $sql);

    echo "<div class='ok'>Данные обновлены</div>";

    $_GET['id'] = $_POST['id'];
}


$res = mysqli_query($mysqli, "SELECT * FROM friends ORDER BY surname, name");

$current = null;

echo "<div class='list'>";


while ($row = mysqli_fetch_assoc($res)) {

    if (!$current && (!isset($_GET['id']) || $_GET['id'] == $row['id'])) {
        $current = $row;
        echo "<div class='active-item'>
            {$row['surname']} {$row['name']}
        </div>";
    } else {
        echo "<a class='item' href='?p=edit&id={$row['id']}'>
            {$row['surname']} {$row['name']}
        </a>";
    }
}

echo "</div>";


if ($current) {
?>

    <form method="post" class="form">

        <input type="text" name="surname" value="<?= $current['surname'] ?>">
        <input type="text" name="name" value="<?= $current['name'] ?>">
        <input type="text" name="patronymic" value="<?= $current['patronymic'] ?>">
        <input type="text" name="gender" value="<?= $current['gender'] ?>">
        <input type="date" name="birthdate" value="<?= $current['birthdate'] ?>">
        <input type="text" name="phone" value="<?= $current['phone'] ?>">
        <input type="text" name="email" value="<?= $current['email'] ?>">
        <input type="text" name="address" value="<?= $current['address'] ?>">

        <textarea name="comment"><?= $current['comment'] ?></textarea>

        <input type="hidden" name="id" value="<?= $current['id'] ?>">

        <input type="submit" name="btn" value="Изменить запись">

    </form>

<?php } ?>