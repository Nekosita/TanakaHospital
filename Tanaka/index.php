<!DOCTYPE html>
<html>
<head>
    <title>主頁面</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    session_start();

    // action値確保
    $action = isset($_GET['action']) ? $_GET['action'] : 'main_page';

    // header設定
    $header = '<div class= headerRow> 
                <div class="row">
                    <a href="index.php?action=main_page">ホームページ</a> 
                </div>
                <div class="row">
                    <a href="index.php?action=about_as">医師紹介</a> 
                </div>
                <div class="row">
                    <a href="index.php?action=contact_us">コメント</a>  
                </div>
                <div class="row">
                    <a href="View/memberWeb.php">会員画面</a>
                </div>
            </div>'; // HTML

    // footer設定
    $footer = '<div id= footer> footer </div>';

             
    echo $header ;

    if($action == 'main_page') {
        include 'View/mainpageWeb.php';     
    }else if($action == 'about_as'){
        include 'View/aboutasWeb.php';
    }else if($action == 'contact_us'){
        include 'View/contactusWeb.php';        
    }

    echo $footer; 

    ?>

</body>

</html>