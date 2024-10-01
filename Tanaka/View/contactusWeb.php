<html>
<head>
    <title>コメント区</title>
</head>
<body>
   
    
<?php

    echo '<h3>コメント歓迎！</h3>';
    echo '<form action="../Model/create_contactUs.php" method="post">';
    echo '名前：<input type="text" name="name" required><br>';
    echo 'メアド：<input type="text" name="email" ><br>';
    echo '電話：<input type="text" name="phone" required>';
    echo '<p>コメント:</p>';
    echo '<textarea name="message_text" rows="10" cols="35" >コメントはここで</textarea><br>';
    echo '<input type="submit" value="送る">';
    echo '</form><br>';

?>

</body>
</html>
