<!DOCTYPE html>
<html>

<head>
    <title>Регистрация</title>
</head>

<body>
    <?php
    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/php/config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $role = 'admin'; // Предположим, что новые пользователи по умолчанию имеют роль 'user'
        $mysql = mysqli_connect(servername, user, password, db);
        $query = "INSERT INTO admins (login, password, role) VALUES ('$username', '$password', '$role')";
        try {
            if (mysqli_query($mysql, $query)) {
                echo "Регистрация успешна. <a href='/login.php'>Войти</a>";
            } else {
                header('Location: register.php?error=true');
            }
        } catch (Exception $e) {
            header('Location: register.php?error=true');
        }
    } else {
    ?>
        <form method="post" action="">
            Логин: <input type="text" name="username"><br>
            Пароль: <input type="password" name="password"><br>
            <input type="submit" value="Зарегистрироваться">
            <?php if ($_GET) {
                if ($_GET['error'] == 'true') {
                    echo '<p style="color:red;">Ошибка регистрации</p>';
                }
            }
            ?>

        </form>
    <?php
    }
    ?>
</body>

</html>