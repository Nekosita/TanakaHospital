<html>
<head>
    <title>會員登録</title>
    <link rel="stylesheet" href="viewStyle.css">
</head>
<body>
    <h2>會員登録</h2>
    <form action="../Model/register.php" method="post">
        <input type="button" value="ログインに戻る" onclick="location.href='loginWeb.php'"><br>
        <label>使用者の名前：</label>
        <input type="text" name="name1" required placeholder="名前を入れてください"><br>

        <label>略称：</label>
        <input type="text" name="name2" placeholder="好きな略称"><br>

        <label>電話：</label>
        <input type="text" name="phone"><br>

        <label>メールアドレス：</label>
        <input type="email" name="mail" required ><br>

        <label>パスワード：</label>
        <input type="password" name="password" required placeholder="英文字1個かつ長さは5文字以上"><br>

        <label>もう一度パスワード：</label>
        <input type="password" name="confirm_password" required><br>

        <input type="submit" value="送る">
    </form>
</body>
</html>