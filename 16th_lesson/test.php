<?php
// FTP серверге қосылу
$conn = ftp_connect("ftp.scene.org");
// Жүйеге кіру
ftp_login($conn, "ftp", "mail@example.com");
// Файл жүктеу (компьютер → сервер)
ftp_put($conn, "docker_test.txt", "local_file.txt", FTP_ASCII);
//ftp_get($conn, "docker.txt", "download/version.txt", FTP_ASCII);
// Байланысты жабу
ftp_close($conn);
?>
