<?php

// db config
define('USERDB', 'postgres');
define('PASSDB', 'postgres');
define('HOSTDB', 'localhost');
define('PORTDB', '5432');
define('DBNAME', 'crud_demo');

// Role translate
$_ru = [
    'Reader' => 'Читатель',
    'Editor' => 'Редактор',
    'Administrator' => 'Администратор'
];

//db connect
try {
    $db = new PDO('pgsql:host='.HOSTDB.';port='.PORTDB.';dbname='.DBNAME, USERDB, PASSDB);
} catch (PDOException $e) {
    print "Error: " . $e->getMessage() . "</br>";
    die();
}

//Create
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $sql = 'INSERT INTO users (name, email, role) VALUES (:name, :email, :role)';
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':role' => $_POST['role']
    ]);
    header("Location: /");
}

//Read

$sql = 'SELECT id, name, email, role FROM users ORDER BY id';
$stmt = $db->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $sql = 'UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':role' => $_POST['role'],
        ':id' => $_POST['id']
    ]);
    header("Location: /");
}

//Delete
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $sql = 'DELETE FROM users WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->execute([
       ':id' => $_GET['delete']
    ]);
    header("Location: /");
}
