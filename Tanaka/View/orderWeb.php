<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewStyle.css">
    <title>予約</title>
</head>
<body>
    <?php
    session_start();
    include '../Model/db_connection.php';
    include '../Model/modelFunction.php';
    
    //id取得
    $userId = $_SESSION['user_id'];
    //checkhash取得
    $check_hash=$_SESSION['checkhash'];
    
    //挨拶文取得
    $greeting = getGreeting($userId, $conn);
 
    //登録確認
    if(!chechIsLogin($userId,$check_hash)){
        header("Location: loginWeb.php");  
        exit();
    }

    echo "<h2>ようこそ {$greeting} さん! 治療コースを選んでください</h2>";
    echo "<a href='reserveWeb.php?type=VR治療'>VR治療</a><br>";
    echo "<a href='reserveWeb.php?type=医師相談'>医師相談</a><br>"; 

    echo "<a href='memberWeb.php'>個人ページに戻る</a><br>"; 

    ?>
</body>
</html>