<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>一言掲示板 - 投稿一覧（テスト）</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>📜 投稿一覧</h1>
<p><a href="form.php">← 投稿フォームへ戻る</a></p>
<hr>
 
    <?php

        // データベース接続情報

        $host = 'mysql321.phy.lolipop.lan';

        $dbname = 'LAA1554899-shortbbs';

        $user = 'LAA1554899';

        $pass = 'teamproject';

        $charset = 'utf8mb4';
 
        // DSN（接続文字列）

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
 
 
        // 接続とクエリ実行

        $pdo = new PDO($dsn, $user, $pass);

        foreach ($pdo->query('SELECT user.id, comment.content FROM comment JOIN user ON comment.user_id = user.id;') as $row) {

            echo "<div class='post'>";

            echo "<p><strong>$name</strong> さん ($time)</p>";

            echo "<p>" . $row['content'] . "</p>";

            echo "</div><hr>";

            echo $row['content'] . "<br>";

        }
 
 
    $filename = 'comments.txt';

    if (file_exists($filename)) {

        $lines = file($filename, FILE_IGNORE_NEW_LINES);

        foreach (array_reverse($lines) as $line) {

            [$time, $name, $comment] = explode("\t", $line);

            echo "<div class='post'>";

            echo "<p><strong>$name</strong> さん ($time)</p>";

            echo "<p>" . nl2br($comment) . "</p>";

            echo "</div><hr>";

        }

    } else {

        echo "<p>まだ投稿がありません。</p>";

    }

    ?>
</body>
</html>
 