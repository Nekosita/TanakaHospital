<?php
include 'db_connectFunction.php';


//POSTなら登録処理を実行
if($_SERVER["REQUEST_METHOD"] == "POST"){

//データベース接続
$conn = creatDBConnection();

//registerWeb.phpからのデータを獲得 , real_escape_string使ってSQLインジェクションを防ぐ
$name1 = $conn->real_escape_string($_POST['name1']);
$name2 = $conn->real_escape_string($_POST['name2']);
$phone = $conn->real_escape_string($_POST['phone']);
$mail = $conn->real_escape_string($_POST['mail']);
$raw_password = $_POST['password']; 
$confirm_password = $_POST['confirm_password']; 

//メールアドレスの@を分割
$email_parts = explode('@', $mail);
$account = $conn->real_escape_string($email_parts[0]);
$error_message = "";

//アカウント重複のチェック
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $error_message .= "請輸入有效的郵件地址。<br>";
}

//パスワードの長さと文字種チェック
if (strlen($raw_password) <= 5 || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)/", $raw_password)) {
    $error_message .= "密碼必須包含至少一個英文字母和一個數字，長度超過5。<br>";
}

//パスワードと確認パスワードが一致しているかチェック
if ($raw_password !== $confirm_password) {
    $error_message .= "確認密碼與密碼不一致。<br>";
}

$account_check_query = "SELECT * FROM member WHERE account = '$account' LIMIT 1";
$result = $conn->query($account_check_query);

if ($result && $result->num_rows > 0) {
        $error_message .= "帳號已存在，請選擇另一個帳號。<br>";
}

if (!empty($error_message)) {
        echo '<button onclick="goBack()">返回修改</button><br>';
        echo '<script>
            function goBack() {
                window.history.back();
            }
        </script>';
}

    //エラー無いならデータベースに登録
    if (empty($error_message)) {

        //saltを生成
        $salt = bin2hex(random_bytes(16));

        //將鹽值和密碼結合，使用雜湊函數計算雜湊值
        $hashedPassword = hash('sha256', $raw_password . $salt);

        //データをデータベースに挿入
        $sql = "INSERT INTO member (username, nickname, phone, email, account, hashed_password, salt ) VALUES ('$name1', '$name2', '$phone', '$mail', '$account', '$hashedPassword', '$salt')";

        //成功したら登録完了メッセージを表示
        if ($conn->query($sql) === TRUE) {
            echo "登録成功，あなたのアカウントは".$account;
						echo '<button onclick="window.location.href=\'../View/loginWeb.php\'">ログインページに戻る</button>';
        } else {
            echo "登録失敗: " . $conn->error;
        }
    } else {
        
        echo $error_message;
    }

    $conn->close();
}

?>