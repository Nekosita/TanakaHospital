<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewStyle.css">
    <title>管理者用作成ページ</title>
</head>
<body>
<?php
session_start();
include '../Model/db_connection.php';
include '../Model/modelFunction.php';


if (authorityCheck() === true) {

    echo '<h2>貰ったメッセージ</h2>';
    echo '<a href="adminWeb.php?action=show_all">管理人ページに戻る</a>';
    
    // 獲取所有留言
    $result = getMessages();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<p>メッセージ番号：" . $row['id'] . "</p>";
            echo "<p>名前：" . $row['name'] . "</p>";
            echo "<p>電話番号：" . $row['phone'] . "</p>";
            echo "<p>メールアドレス：" . $row['email'] . "</p>";
            echo "<p>メッセージ：" . $row['message_text'] . "</p>";
            echo "</div>";
            echo "<hr>";
         }
     } 
    } else {
        echo "<p>閱覽權限無い</p>";
    }

$conn->close();
?>
</body>
</html>