<form method="post" class="form">
    <input type="text" name="surname" placeholder="Фамилия" value="<?= $_POST['surname'] ?? '' ?>">
    <input type="text" name="name" placeholder="Имя" value="<?= $_POST['name'] ?? '' ?>">
    <input type="text" name="patronymic" placeholder="Отчество" value="<?= $_POST['patronymic'] ?? '' ?>">
    <input type="text" name="gender" placeholder="Пол" value="<?= $_POST['gender'] ?? '' ?>">
    <input type="date" name="birthdate" value="<?= $_POST['birthdate'] ?? '' ?>">
    <input type="text" name="phone" placeholder="Телефон" value="<?= $_POST['phone'] ?? '' ?>">
    <input type="text" name="email" placeholder="Email" value="<?= $_POST['email'] ?? '' ?>">
    <input type="text" name="address" placeholder="Адрес" value="<?= $_POST['address'] ?? '' ?>">
    <textarea name="comment" placeholder="Комментарий"><?= $_POST['comment'] ?? '' ?></textarea>

    <input type="submit" name="btn" value="Добавить">
</form>

<?php
if (isset($_POST['btn'])) {


    foreach ($_POST as $key => $value) {
        if ($key != 'btn' && trim($value) == '') {
            echo "<div class='error'>Заполните все поля</div>";
            return;
        }
    }

    $mysqli = mysqli_connect("localhost", "root", "", "friends");

    $sql = "INSERT INTO friends 
    (surname,name,patronymic,gender,birthdate,phone,email,address,comment)
    VALUES (
    '" . $_POST['surname'] . "',
    '" . $_POST['name'] . "',
    '" . $_POST['patronymic'] . "',
    '" . $_POST['gender'] . "',
    '" . $_POST['birthdate'] . "',
    '" . $_POST['phone'] . "',
    '" . $_POST['email'] . "',
    '" . $_POST['address'] . "',
    '" . $_POST['comment'] . "'
    )";

    if (mysqli_query($mysqli, $sql)) {
        echo "<div class='ok'>Запись добавлена</div>";
    } else {
        echo "<div class='error'>Ошибка: " . mysqli_error($mysqli) . "</div>";
    }
}
?>