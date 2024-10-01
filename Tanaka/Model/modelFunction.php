<?php
include 'db_connectFunction.php';

// 予約削除
function deleteOrder($order_id) {

    // データベース接続
    $conn = creatDBConnection();

    // 文法作成
     $sql = "DELETE FROM appointments WHERE order_id='$order_id'";

    //データベースに文法実行
     $result =$conn->query($sql);

    //データベース接続を閉じる
     $conn->close();

    //戻り値を返す
    return $result;
}

//権限確認
function authorityCheck(){
    $result = false;
    // (user_id = 1) を管理者として設定
    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1){
        $result = true;
    }else{  
        $result =  false;
    }
    return $result;
}

//ログイン確認
function chechIsLogin($userId,$checkHash){

   // データベース接続
    $conn = creatDBConnection();
    // 文法作成
    $sql = "SELECT * FROM member WHERE id='$userId'";
   //データベースに文法実行
    $result = $conn->query($sql);
    // 取得查詢結果的
    $CheckRow = $result->fetch_assoc();
     //データベース接続を閉じる
    $conn->close();
    //データベースのハッシュとユーザーIDが一致するか確認
    if (($checkHash ===  $CheckRow['checkhash']) && ($userId === $CheckRow['id'])){
        return true;
    } else {
        return false;
    }
}

// ユーザー情報取得
function getUserInfo($user_id, $conn) {
    // 文法作成
    $sql = "SELECT * FROM member WHERE id='$user_id'";
    //データベースに文法実行
    $result = $conn->query($sql);

    //存在する場合、完全な会員情報を返す
    if ($result->num_rows == 1) {
        return  $result; 
    } else {
        return null;
    }
}

//使用者の挨拶を取得
function getGreeting($user_id, $conn) {
    // 文法作成
    $sql = "SELECT * FROM member WHERE id='$user_id'";
    //データベースに文法実行
    $result = $conn->query($sql);

    //会員登録時の挨拶を取得
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return !empty($row['nickname']) ? $row['nickname'] : $row['username'];
    } else {
        return "無法獲取使用者資訊。";
    }
}

//会員の予約情報を取得
function getUserAppointMents() {

    // データベース接続
    $conn = creatDBConnection();
    
    // 文法作成
    $sql = "SELECT order_id, type, date, time, name, phone, created_at, status FROM appointments ORDER BY date DESC, time DESC";

    //データベースに文法実行
    $result = $conn->query($sql);

    //データベース接続を閉じる
    $conn->close();

    //戻り値を返す
    return $result;

}

//当日の会員予約情報を取得
function getTodayUserAppointMents($currentDate) {

    // データベース接続
    $conn = creatDBConnection();
    
    // 文法作成
    $sql = "SELECT order_id, type, date, time, name, phone, created_at, status 
    FROM appointments 
    WHERE date = '$currentDate' 
    ORDER BY status DESC, time ASC";

     //データベースに文法実行
    $result = $conn->query($sql);

    //データベース接続を閉じる
    $conn->close();

    //戻り値を返す
    return $result;

}

//特定の会員予約情報を取得
function getSpecificUserAppointMents($account,$filter) {

    // データベース接続
    $conn = creatDBConnection();
    
    // 文法作成
    $sql = "SELECT order_id, type, date, time, name, phone, status FROM appointments WHERE account='$account' $filter ORDER BY date DESC, time DESC";
    
    //データベースに文法実行
    $result = $conn->query($sql);

     //データベース接続を閉じる
    $conn->close();

    //戻り値を返す
    return $result;

}

//メッセージを取得
function getMessages() {

    // データベース接続
    $conn = creatDBConnection();
    
    // 文法作成
    $sql = "SELECT * FROM messages";

    //データベースに文法実行
    $result = $conn->query($sql);

    //データベース接続を閉じる
    $conn->close();

     //戻り値を返す
    return $result;

}

?>
