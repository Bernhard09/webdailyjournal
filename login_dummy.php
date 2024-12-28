<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Form Login</h2>
    <?php 
        $username = "admin";
        $password = "123";
    ?>
    <form method="post">
        Username: <input type="text" name="user"><br>
        Password: <input type="password" name="pass"><br>
        <button type="submit">Login</button>
    </form>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //echo $_POST['user'];
            if ($_POST['user'] == $username AND $_POST['pass'] == $password) {
                echo '<div style="color:green">User: ' . $_POST['user'] . ' Berhasil Login</div>';
            } else {
                echo '<div style="color:red">User: ' . $_POST['user'] . ' Gagal login</div>';
            }
        }

    ?>
</body>
</html>