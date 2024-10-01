<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者專用ページ</title>
        <link rel="stylesheet" href="viewStyle.css">
</head>
<body>
<?php

session_start();
include '../Model/db_connection.php';
include '../Model/modelFunction.php';

if (authorityCheck()) {

    // action值取得
    $action = isset($_GET['action']) ? $_GET['action'] : 'show_today';

    echo  '<h2>管理者專用ページ</h2>' ;

    $adminHeader = '<div class= "AdminheaderRow"> 
                            <div class= "row"> 
                                <a href="../index.php?action=main_page">ホームに戻る</a> 
                                </div>
                            <div class="row">
                            <a href="adminWeb.php?action=show_all">全オーダー出す</a>
                                </div>
                            <div class="row">
                                <a href="adminWeb.php?action=show_today">今日の予約</a> 
                                </div>
                            <div class= "row"> 
                                <a href="adminCreateWeb.php">オーダー作成</a>
                                </div>
                            <div class= "row"> 
                                <a href="adminMesWeb.php">貰った連絡</a><br>
                                </div>
                        </div>';

    echo  $adminHeader ;

    if ($action === 'show_today') {
        
        // 日つけ取得
        $currentDate = date('Y-m-d');
        // 会員データ取得
        $result = getTodayUserAppointMents($currentDate);
    

        if ($result->num_rows > 0) {
            //データ出力
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<p>予約番号：" . $row['order_id'] . "</p>";
                echo "<p>予約タイプ：" . $row['type'] . "</p>";
                echo "<p>予約の日：" . $row['date'] . "</p>";
                echo "<p>予約時間：" . $row['time'] . "</p>";
                echo "<p>予約名：" . $row['name'] . "</p>";
                echo "<p>予約電話：" . $row['phone'] . "</p>";
                echo "<p>生成時間：" . $row['created_at'] . "</p>";
                echo "<p>狀態：" . $row['status'] . "</p>";
    
                
                if ($row['status'] === '未完成') {
                    // 添加取消預約按鈕功能
                    echo "<form action='../Model/cancel_reservation.php' method='post'>";
                    echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                    echo "<button type='submit'>キャンセル</button>";
                    echo "</form>";
    
                    // 添加已完成按鈕功能
                    echo "<form method='post' action='../Model/mark_completed.php'>";
                    echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                    echo "<button type='submit'>完成</button>";
                    echo "</form>";
                } else {
                    echo "<p>完成済み、これ以上操作出来ません</p>";
                }
    
                echo "</div>";
                echo "<hr>";
            }

            } else {
                echo "<p>予約なし</p>";
            }
        }elseif ($action === 'show_all') {

            // 獲取會員預約資料
            $result = getUserAppointMents();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<p>予約番号：" . $row['order_id'] . "</p>";
                echo "<p>予約タイプ：" . $row['type'] . "</p>";
                echo "<p>予約の日：" . $row['date'] . "</p>";
                echo "<p>予約時間：" . $row['time'] . "</p>";
                echo "<p>予約名：" . $row['name'] . "</p>";
                echo "<p>予約電話：" . $row['phone'] . "</p>";
                echo "<p>生成時間：" . $row['created_at'] . "</p>";
                echo "<p>狀態：" . $row['status'] . "</p>";
        
                if ($row['status'] === '未完成') {
                    echo "<form action='../Model/cancel_reservation.php' method='post'>";
                    echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                    echo "<button type='submit'>キャンセル</button>";
                    echo "</form>";
        
                    // 添加已完成按鈕功能
                    echo "<form method='post' action='../Model/mark_completed.php'>";
                    echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                    echo "<button type='submit'>完成</button>";
                    echo "</form>";
                } else {
                    echo "<p>完成済み、これ以上操作出来ません</p>";
                }
        
                echo "</div>";
                echo "<hr>";
                
            }
        } else {
            echo "<p>予約無し</p>";
        }
    }
} else {
    echo "閲覧権限無い";
}

$conn->close();
?>
</body>
</html>
