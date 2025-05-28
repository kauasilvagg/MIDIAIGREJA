<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
// conexao.php
$host     = 'localhost';
$user     = 'root';
$password = '13032005';         // ou sua senha do MySQL
$dbname   = 'igreja_shalom';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>


