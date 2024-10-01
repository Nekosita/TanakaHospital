<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewStyle.css">
    <title>私の予約</title>
</head>
<body>
    <?php
    session_start();
    include '../Model/db_connection.php';
    include '../Model/modelFunction.php';

    //user_idとcheckhash取得
    $user_id = $_SESSION['user_id'];
    $check_hash=$_SESSION['checkhash'];

    //登入確認
    if (chechIsLogin($user_id,$check_hash)) {
        // ユーザー情報取得
        $userInfo = getUserInfo($user_id, $conn);
        $userInfoRow = $userInfo->fetch_assoc();
        $account = $userInfoRow['account'];

        // 資料あるか確認
        $filter = "";
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            $filter = "AND status='$status'";
        }

        // ユーザーの予約情報取得
        $result = getSpecificUserAppointMents($account,$filter);

        // 顯示使用者預約資料
        echo "<h2>私の予約</h2>";
        echo "<a href='memberWeb.php'>個人ページに戻る</a><br>";
        echo "<p><a href='orderView.php'>全部</a> | <a href='orderView.php?status=未完成'>未完成</a> | <a href='orderView.php?status=完成済み'>完成済み</a></p>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {         
                echo "<div>";
                echo "<p>予約番号：" . $row['order_id'] . "</p>";
                echo "<p>予約タイプ：" . $row['type'] . "</p>";
                echo "<p>予約の日：" . $row['date'] . "</p>";
                echo "<p>予約時間：" . $row['time'] . "</p>";
                echo "<p>予約名：" . $row['name'] . "</p>";
                echo "<p>予約電話：" . $row['phone'] . "</p>";

                if ($row['status'] === '未完成') {
                    echo "<form action='../Model/cancel_reservation.php' method='post'>";
                    echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                    echo "<button type='submit'>予約キャンセル</button>";
                    echo "<br>------------------------------------<br>"; 
                    echo "</form>";
                }

                echo "</div>";
            }
        } else {
            echo "<p>何もない</p>";
        }

    } else {
        echo "<a href='loginWeb.php'>先にログイン</a>";
    }
    
    ?>
</body>
</html>