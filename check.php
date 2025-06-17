<?php
session_start();
 
// DB接続設定
$host = '	mysql305.phy.lolipop.lan';

        $dbname = '	LAA1553916-php2024';

        $user = 'LAA1553916';

        $pass = 'Pass0812';

        $charset = 'utf8mb4';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('DB接続失敗: ' . $e->getMessage());
}
 
// POSTデータ受け取り
$username = $_POST['username'] ?? '';
$password_input = $_POST['password'] ?? '';
 
if ($username && $password_input) {
    // ユーザー取得クエリ（ユーザー名とパスワード両方で検索）
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password LIMIT 1");
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password_input);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
   if ($user) {
        $_SESSION['username'] = $user['username'];
        header('Location: view.php');
        exit;
    } else {
        header('Location: index.html');
        exit;
    }
} else {
    // ユーザー名かパスワードが空の場合もindex.htmlへ戻す
    header('Location: index.html');
    exit;
}
?>
 
 