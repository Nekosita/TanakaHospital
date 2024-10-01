<?php
session_start();
include 'db_connection.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $messagetext = $_POST['message_text'];

            //データを 'messages' テーブルに入る　文法を作る
            $sql = "INSERT INTO messages (name, phone, email, message_text) VALUES ('$name', '$phone', '$email', ' $messagetext')";

            if ($conn->query($sql) === TRUE) {
                echo "成功,3秒後メインページに戻る!";
                header("refresh:3; url=../index.php?action=main_page");
            } else {
                echo "エーラー：" . $sql . "<br>" . $conn->error;
            }
        }
    
$conn->close();
?>
