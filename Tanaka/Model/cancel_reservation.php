<?php
session_start();
include 'modelFunction.php';


// オーダーIDが存在するか確認
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // オーダー削除
    $result = deleteOrder($order_id);
    
    if ($result === TRUE) {
        echo "オーダーキャンセル成功。<br>";
        echo "<a href='../View/memberWeb.php'>會員ページに戻る</a><br>";
    } else {
        echo "取消訂單失敗: ";
    }
}

?>
