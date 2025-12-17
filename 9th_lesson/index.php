<?php
session_start();

if (!isset($_SESSION['total'])) $_SESSION['total'] = 0;
if (!isset($_SESSION['number'])) $_SESSION['number'] = 0;
if (!isset($_SESSION['action'])) $_SESSION['action'] = '';

if (isset($_POST['number'])) {
    $_SESSION['number'] = $_POST['number'];
}

if (isset($_POST['plus']) || isset($_POST['minus']) || isset($_POST['multiply']) || isset($_POST['divide'])) {

    if (isset($_POST['plus']))  $_SESSION['action'] = '+';
    if (isset($_POST['minus'])) $_SESSION['action'] = '-';
    if (isset($_POST['multiply'])) $_SESSION['action'] = '*';
    if (isset($_POST['divide'])) $_SESSION['action'] = '/';

    $_SESSION['total'] = $_SESSION['number'];
    $_SESSION['number'] = 0;
}

if (isset($_POST['equal'])) {

    switch ($_SESSION['action']) {
        case '+':
            $_SESSION['total'] = $_SESSION['total'] + $_SESSION['number'];
            break;
        case '-':
            $_SESSION['total'] = $_SESSION['total'] - $_SESSION['number'];
            break;
        case '*':
            $_SESSION['total'] = $_SESSION['total'] * $_SESSION['number'];
            break;
        case '/':
            if ($_SESSION['number'] != 0) {
                $_SESSION['total'] = $_SESSION['total'] / $_SESSION['number'];
            }
            break;
    }

    $_SESSION['number'] = 0;
    $_SESSION['action'] = '';
}

$total = $_SESSION['total'];
?>
<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
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
        .calc {
            width: 260px;
            padding-top: 20px;
            align-items: center;
            align-content: center;
            margin: 30px; }
        .buttons {
            width: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="card">
    <h1>Калькулятор</h1>
    <form method="POST">
        <h3><?php echo $total ?></h3>
        <input type="number" name="number">

        <table class="calc">
            <tr>
                <td>7</td><td>8</td><td>9</td>
                <td><button type="submit" name="multiply" value="*">*</button></td>
            </tr>
            <tr>
                <td>4</td><td>5</td><td>6</td>
                <td><button type="submit" name="plus" value="+">+</button></td>
            </tr>
            <tr>
                <td>1</td><td>2</td><td>3</td>
                <td><button type="submit" name="minus" value="-">-</button></td>
            </tr>
            <tr>
                <td>.</td><td>0</td>
                <td><button type="submit" name="divide" value="/">/</button></td>
                <td><button type="submit" name="equal" value="=">=</button></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
