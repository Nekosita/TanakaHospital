<?php
session_start();
include 'db_connection.php'; 
include 'modelFunction.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 使用者ID取得
            $user_id = $_SESSION['user_id'];
            $userInfo = getUserInfo($user_id, $conn);
            $userInfoRow = $userInfo->fetch_assoc();
            $account = $userInfoRow['account'];
   
        // フォームからのデータ取得
            $type = $_POST['type'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $email = $_POST['email'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $created_at = date('Y-m-d H:i:s');

            //資料存入 資料庫   'appointments' 資料表
            $sql = "INSERT INTO appointments (account, type, date, time, email, name, phone, created_at ,status) 
                    VALUES ('$account', '$type', '$date', '$time', '$email', '$name', '$phone',  '$created_at','未完成')";

            //確認有沒有成功存入資料庫
            if ($conn->query($sql) === TRUE) {
                echo "オーダー作成完了！";
                 echo "<br><a href='../View/adminWeb.php'>管理者画面に戻る</a>";
            } else {
                echo "エーラー：" . $sql . "<br>" . $conn->error;
            }
        }

$conn->close();
?>


