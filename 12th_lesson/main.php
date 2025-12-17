<?php
    session_start();
    include_once "mysqlConnector.php";

    $database = new mysqlConnector();

    function delete($id, $database) {
        $sql = "DELETE FROM students WHERE id = $id";
        return $database->execute($sql);
    }

    if(!isset($_SESSION['auth'])) {
        header("Location: index.php");
    }

    $sql = "SELECT * FROM students";

    $result = $database->execute($sql);
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

    <h3>Students List</h3>
    <button class="btn btn-success" style="max-width: 200px">Add Student</button>
    <table class="table">
        <thead class="thead-dark">
        <th>ID</th>
        <th>Name</th>
        <th>GROUP_ID</th>
        <th>AGE</th>
        <th>Action</th>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . $row['group_id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                echo "<td>" . "<a href=''>Удалить</a>" . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data</td></tr>";
        } ?>
        </tbody>
    </table>

    <button class="btn btn-danger"><a style="text-decoration: none; color: white" href="logout.php">Exit</a></button>
</div>
</body>
</html>

