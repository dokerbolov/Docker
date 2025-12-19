<?php
    session_start();
    include_once "mysqlConnector.php";

    $database = new mysqlConnector();

    if(!isset($_SESSION['auth'])) {
        header("Location: index.php");
    }

    $sql = "SELECT 
                s.id,
                s.name,
                s.age,
                g.name as group_id
            FROM students as s 
            LEFT JOIN uni_group as g on s.group_id = g.id";

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
    <button class="btn btn-success btn-add" style="max-width: 200px">Add Student</button>
    <table class="table">
        <thead class="thead-dark">
        <th>ID</th>
        <th>Name</th>
        <th>GROUP</th>
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
                echo "<td>" .
                    "<button class='btn btn-warning btn-edit' style='margin-right: 10px' data-id='{$row['id']}'>Edit</button>" .
                    "<button class='btn btn-danger btn-delete' style='margin-left: 10px' data-id='{$row['id']}'>Delete</button>"
                    . "</td>";
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

<script>
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', () => {
            if(confirm("Are you sure?")) {
                fetch("add.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "id=" + btn.dataset.id
                })
                    .then(window.location.reload())
            };
        });
    });

    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', () => {
            if(confirm("Are you sure?")) {
                fetch("delete.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "id=" + btn.dataset.id
                })
                    .then(window.location.reload())
            };
        });
    });

    document.querySelectorAll('.btn-add').forEach(btn => {
        btn.addEventListener('click', () => {
            window.location.href = "add.php";
        });
    });
</script>

