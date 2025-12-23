<?php
    session_start();
    include_once "mysqlConnector.php";

    $database = new mysqlConnector();

    if(!isset($_SESSION['auth'])) {
        header("Location: index.php");
    }

    $student = '';

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "SELECT * FROM STUDENT WHERE id = $id";
        $student = $database->execute($sql);
    }

    $sql = "SELECT * FROM uni_group";

    $groups = $database->execute($sql);
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>Docker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
<div class="card m-5 p-3">
    <h1>Hello, <?php echo $_SESSION['username'] ?></h1>

    <h3>New student</h3>
    <div class="input-group mb-3">
        <input id="name" type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <input id="age" type="number" class="form-control" placeholder="Age" aria-label="Age" aria-describedby="basic-addon1">
    </div>

    <select id="group_uni" class="form-select mb-3" aria-label="Default select example">
        <option value="0" selected>Open this select menu</option>
        <?php
        while($row = $groups->fetch_assoc()) {
            echo "<option value='{$row['id']}'>" . htmlspecialchars($row['name']) . "</option>";
        }
        ?>
    </select>

    <button type="submit" class="btn btn-success mb-3 btn-add">Save</button>

    <button class="btn btn-primary mb-2"><a style="text-decoration: none; color: white" href="main.php">Back</a></button>
    <button class="btn btn-danger"><a style="text-decoration: none; color: white" href="logout.php">Exit</a></button>
</div>
</body>
</html>

<script>
    document.querySelectorAll('.btn-add').forEach(btn => {
        btn.addEventListener('click', () => {
            var name = document.getElementById("name");
            var age = document.getElementById("age");
            var group_uni = document.getElementById('group_uni');
            var is_new = false; // false == edit, true == new
            console.log(age.value, name.value, group_uni.value);
            fetch("add-student.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "name=" + name.value + "&age=" + age.value + "&group_uni=" + group_uni.value
            })
                // .then(window.location.href = "main.php")
                .then(res => console.log(res.text));
        });
    });
</script>

