<?php
    // データベース設定
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "members_database";


    // データベース接続
    $conn = new mysqli($servername, $username, $password, $dbname);

    // データベース接続確認 
    if ($conn->connect_error) {
    die("連接資料庫失敗: " . $conn->connect_error);
    }

    return $conn;
?>