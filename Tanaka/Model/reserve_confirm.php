<?php
session_start();
include 'db_connection.php'; 
include 'modelFunction.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // IDが存在するか確認
    if (isset($_SESSION['user_id'])) {

        $user_id = $_SESSION['user_id'];

        $userInfo = getUserInfo($user_id, $conn);

        if ($userInfo !== null) {
            $userInfoRow = $userInfo->fetch_assoc();
            $account = $userInfoRow['account'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            // 現在の日時
            $created_at = date('Y-m-d H:i:s');

            $sql = "INSERT INTO appointments (type, account, name, phone, email, date, time, created_at,  status) VALUES ('$type', '$account', '$name', '$phone', '$email', '$date', '$time', '$created_at', '未完成')";

            if ($conn->query($sql) === TRUE) {
                echo "預約完了,3秒後予約ホームページに戻ります。";
                header("refresh:3;url=../View/orderWeb.php");
            } else {
                echo "預約失敗: " . $conn->error;
            }
        } else {
            echo "使用者データを取得できません。";
        }
    } else {
        echo "使用者IDが存在しません。";
    }
}

$conn->close();
?>
