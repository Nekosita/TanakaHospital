<?php
session_start();

include '../Model/db_connection.php';

//loginWeb.phpからのデータをを取得し、 real_escape_string() を使ってSQLインジェクションを防ぐ
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

//調べるSQL文を作成
$sql = "SELECT * FROM member WHERE email='$email'";
//SQL文を実行
$result = $conn->query($sql);

//もし結果が1つだけある場合
if ($result->num_rows == 1) {
    // 結果を取得
    $row = $result->fetch_assoc();
    
    //データベースのsalt値を取得
    $checkSalt = $row['salt'];
    
    // 確認用ハッシュの生成
     $hashedPassword = hash('sha256', $password. $checkSalt);

    //データベース中のhashed_passwordと確認用ハッシュが一致するか確認
    if ($hashedPassword === $row['hashed_password']) {
        $welcomeMesg = "登入成功,歡迎回來";
        $welcomeMesg .= !empty($row['nickname']) ? $row['nickname'] : $row['username'];
        echo $welcomeMesg;    
        
        //idをsessionの中に保存
        $_SESSION['user_id'] = $row['id'];

        
        
        $nowTime = time(); 
        //新しいチェーン用のハッシュを生成
        $checkHash = hash('sha256', $row['email'] . $nowTime);
        //データベース中のcheckhashの更新文を作成
        $updateHash = "UPDATE member SET checkhash='$checkHash' WHERE email='$email'";
        //SQL文を実行
        $updateDB = $conn->query($updateHash);

        //將checkhash儲存在session中
        $_SESSION['checkhash'] = $checkHash;

        header("Location: ../View/memberWeb.php");
    } else {
        echo "登入失敗：パスワードが間違っています";
        echo '<button onclick="window.location.href=\'../View/loginWeb.php\'">重新登入</button>';
    }

} else {
    echo "アカウントが存在しません、先に登録してください";
    echo '<button onclick="window.location.href=\'../View/registerWeb.php\'">前往註冊頁面</button>';
}

$conn->close();
?>