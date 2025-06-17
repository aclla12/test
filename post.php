<?php
 
$name = htmlspecialchars($_POST['name'] ?? '名無し');
$comment = htmlspecialchars($_POST['comment'] ?? '');
$time = date('Y-m-d H:i:s');
 
// データベース接続情報
$host = '	mysql305.phy.lolipop.lan';

        $dbname = '	LAA1553916-php2024';

        $user = 'LAA1553916';

        $pass = 'Pass0812';

        $charset = 'utf8mb4';
 
// DSN（接続文字列）
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
 
try {
    // PDOでデータベースに接続
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // エラー時に例外を投げる
    ]);
 
    // SQL文を準備して実行
    $sql = "INSERT INTO comment (name, comment, time) VALUES (:name, :comment, :time)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':comment' => $comment,
        ':time' => $time,
    ]);
 
    echo "投稿が成功しました。";
 
} catch (PDOException $e) {
    echo "データベースエラー: " . htmlspecialchars($e->getMessage());
}
 
 
// if (trim($comment) === '') {
//     header("Location: form.php");
//     exit;
// }
 
// $entry = "$time\t$name\t$comment\n";
// file_put_contents('comments.txt', $entry, FILE_APPEND);
header("Location: view.php");
exit;
?>
 
 