<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];

    // 更新の文法作成
    $updateQuery = "UPDATE appointments SET status = '已完成' WHERE order_id = $orderId";
    mysqli_query($conn, $updateQuery);

    // 管理者画面に戻る
    header("Location: ../View/adminWeb.php?action=show_all");
    exit;
}
?>