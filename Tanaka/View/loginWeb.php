<html>
<head>
    <title>ログインページ</title>
         <link rel="stylesheet" href="viewStyle.css">
</head>
<body>
    <h2>ログイン</h2>
    <form action="../Controller/login.php" method="POST">
        <label>アドレス：</label>
        <input type="email" name="email" required ><br>
        <label>パスワード：</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="ログイン">
        <input type="button" value="新規登録" onclick="location.href='registerWeb.php'">
    </form>
</body>
</html>