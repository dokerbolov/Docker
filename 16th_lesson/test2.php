<?php
$name = $_GET['name'];
$age = $_GET['age'];
echo "Аты: $name <br/>";
echo "Жасы: $age";

echo "<br/>";

$username = $_POST['username'];
echo "Қолданушы аты: $username";
?>

<html>
<form method="post" action="test2.php?name=Ali&age=15">
    <input type="text" name="username">
    <input type="submit" value="Жіберу">
</form>

</html>
