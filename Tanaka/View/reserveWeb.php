<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>預約体験</title>
    <link rel="stylesheet" href="viewStyle.css">
</head>
<body>
    <?php
    session_start();
    include '../Model/db_connection.php';
    include '../Model/modelFunction.php';

    //id取得
    $user_id = $_SESSION['user_id'];
    //checkhash獲得
    $check_hash=$_SESSION['checkhash'];

    // 預約タイプ取得
    $type = $_GET['type']; 

    //登録確認
    if(chechIsLogin($user_id,$check_hash)===false){
        echo "請先<a href='loginWeb.php'>登入</a>";
        exit();
    }

    //預約タイプ判定
        if ($type === 'VR治療') {
            $typeText = 'VR治療';
    } elseif ($type === '医師相談') {
            $typeText = '医師相談';
        } else {
            echo "無效の預約";
            exit;
    }

    //挨拶文取得
    $greeting = getGreeting($user_id, $conn);

    //会員資料取得
    $userInfo = getUserInfo($user_id, $conn);
    $userInfoRow = $userInfo->fetch_assoc();
    $username = $userInfoRow['username'];
    $phone = $userInfoRow['phone'];
    $email = $userInfoRow['email'];


        echo "<h2>{$greeting} さんこんばんは ! {$typeText} の預約ページへようこそ!</h2>";

        echo "<a href='orderWeb.php'>予約画面に戻る</a><br><br>"; 
        echo "<form action='../Model/reserve_confirm.php' method='post'>";
        echo "<input type='hidden' name='type' value='$type'>";

        echo "<label for='name'>名前：</label>";
        echo "<input type='text' id='name' name='name' value='{$username}' required><br>";
        echo "<label for='phone'>電話：</label>";
        echo "<input type='tel' id='phone' name='phone' value='{$phone}' required><br>";
        echo "<label for='email'>メール：</label>";
        echo "<input type='email' id='email' name='email' value='{$email}' required><br>";

        echo "<label for='date'>預約の日：</label>";
        echo "<input type='date' id='date' name='date' required><br>";
        echo "<label for='time'>預約時間：</label>";
        echo "<input type='time' id='time' name='time' required><br>";
        echo "<button type='submit'>送る</button>";
        echo "</form>";

    ?>
</body>
</html>