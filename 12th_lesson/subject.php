<?php
session_start();
include_once "mysqlConnector.php";

$database = new mysqlConnector();

if(!isset($_SESSION['auth'])) {
    header("Location: index.php");
}

$sql = "SELECT * FROM subjects";

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

<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="main.php" class="nav-link px-2">Students List</a></li>
        <li><a href="subject.php" class="nav-link px-2 link-secondary">Subject List</a></li>
        <li><a href="teachers.php" class="nav-link px-2">Teachers List</a></li>
    </ul>

    <div class="col-md-3 text-end">
        <?php
        if(isset($_SESSION['auth'])) {
            echo "<button type='button' class='btn btn-danger me-2'>
                    <a style='text-decoration: none; color: white' href='logout.php'>
                       Exit</a>
                  </button>";
        } else {
            echo "<button type='button' class='btn btn-outline-primary me-2'>
                        Login
                    </button>
                    <button type='button' class='btn btn-primary'>
                        Sign-up
                    </button>";
        }
        ?>

    </div>
</header>

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
</div>
</body>
</html>
