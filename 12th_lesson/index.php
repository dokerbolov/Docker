<?php
    session_start();
    include_once "mysqlConnector.php";

    $database = new mysqlConnector();

    $total = 0;

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username = '$username'";

        $result = $database->execute($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['username'] == $username) {
                    if($row['password'] == md5($password)) {
                        $total = 'Success';
                        $_SESSION['username'] = $username;
                        $_SESSION['auth'] = true;
                        header("Location: main.php");
                    } else {
                        $_SESSION = [];
                        $total = 'Error in credentials';
                    }
                }
            }
        } else {
            $total = "Мәлімет жоқ";
        }
    }
?>
<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>Docker</title>
    <style>
        body {
            font-family: Arial;
            background: #eaeaea;
            text-align: center;
        }

        .card {
            width: 300px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        h1 {
            color: #333;
        }

        .input-style {
            margin: 5px;
        }
    </style>
</head>
<body>

<div class="card">
    <form method="POST">
        <h3><?php echo $total?></h3>
        <h4>Авторизация</h4>
        <input class="input-style" type="text" name="username"> <br/>
        <input class="input-style" type="text" name="password"> <br/>
        <button type="submit">Кіру</button>
    </form>
</div>

</body>
</html>
