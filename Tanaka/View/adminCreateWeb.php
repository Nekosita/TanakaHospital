<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>オーダー作る</title>
         <link rel="stylesheet" href="viewStyle.css">
</head>
<body>
<?php
session_start();
include '../Model/db_connection.php';
include '../Model/modelFunction.php';


if (authorityCheck()) {
    
    // 當下的日期時間
    $created_at = date('Y-m-d H:i:s');
    echo '<h2>管理者用オーダー作成画面</h2>';
    echo '<a href="adminWeb.php?action=show_all">管理者ページに戻る</a>';
    echo '<h3>預約情報確保</h3>';
    echo '<form action="../Model/create_order.php" method="post">';
    echo '予約タイプ: ';
    echo '<select name="type">';
    echo '<option value="VR治療">VR治療</option>';
    echo '<option value="医師相談">医師相談</option>';
    echo '</select><br>';
    echo '予約日つけ：<input type="date" name="date" required><br>';
    echo '予約時間：<input type="time" name="time" required><br>';
    echo '名前：<input type="text" name="name" required><br>';
    echo 'メールアドレス：<input type="text" name="email" ><br>';
    echo '電話：<input type="text" name="phone" required><br>';
    echo '<input type="submit" value="作成する">';
    echo '</form>';

}else{
    echo '管理者権限がありません。';
    echo '<a href="loginWeb.php">ログインに戻る</a>';
}

$conn->close();
?>
</body>
</html>