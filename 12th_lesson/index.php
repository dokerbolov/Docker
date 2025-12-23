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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>

<!-- Main container for centering -->
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row w-100">
        <div class="col-12 col-md-8 col-lg-5 mx-auto">
            <!-- Start of the Card component -->
            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h4 class="mb-0">Login</h4>
                </div>
                <div class="card-body">
                    <!-- Authentication Form -->
                    <form method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMeCheck">
                            <label class="form-check-label" for="rememberMeCheck">Remember me</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">
                        Don't have an account? <a href="#">Sign Up</a>
                    </small>
                </div>
            </div>
            <!-- End of the Card component -->
        </div>
    </div>
</div>

</body>
</html>
