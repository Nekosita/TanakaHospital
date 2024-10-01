<html>
<head>
    <title>登入頁面</title>
         <link rel="stylesheet" href="viewStyle.css">
    </head>
<body>
<?php
session_start();  
//データベース接続
include '../Model/db_connection.php';
include '../Model/modelFunction.php';


//獲取用戶idとcheckhash取得
$userId = $_SESSION['user_id'];
$check_hash=$_SESSION['checkhash'];

if(!chechIsLogin($userId,$check_hash)){
    header("Location: loginWeb.php");  
    exit();
}

//ユーザー情報取得 
$result=getUserInfo($userId, $conn);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
    $phone = $row['phone'];

    echo "$username さん、お帰り！<br>";
    echo "メールアアドレス: $email<br>";
    echo "電話: $phone<br>";

    //管理人の場合、管理人ページへのリンクを表示
    if(authorityCheck()===true){
        echo '<a href="adminWeb.php">管理人ページに戻る</a><br>';
    }
    echo "<a href='orderWeb.php'>予約ページへ</a><br>";
    echo "<a href='orderView.php'>私の予約</a><br>";
    echo '<a href="../index.php">ホームページ</a><br> ';
    echo "<a href='../Controller/logout.php'>ログアウト</a>";
    }else {
        header("Location: loginWeb.php");  
    }
     
$conn->close();
?>
</body>
</html>
