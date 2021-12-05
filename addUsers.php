<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>addUsers</title>
</head>

<body>
    <?
    $connect = mysql_connect("localhost", "root", "apmsetup");
    mysql_select_db("store_db", $connect);
    mysql_set_charset("utf8", $connect);

    $userName = $_POST['name'];
    $password = $_POST['password'];

    $checkUser = "select * from users where password='$password' and name='$userName';";
    $checkResult = mysql_query($checkUser, $connect);

    $alreadyUser = mysql_fetch_row($checkResult);

    // id, password, name
    $newUser = "insert into users values(NULL,$password,'$userName');";

    if ($alreadyUser) {
        echo "<form name='userInfo' method='POST' action='admin.php'>
        <input type='hidden' name='userId' value='$alreadyUser[0]'>
    </form>";
    } else {
        $result = mysql_query($newUser, $connect);
        echo "<script>
        alert('회원가입 되었습니다! 다시 로그인을 시도해 주세요.');
        location.href = 'store.php';
        </script>";
    }

    mysql_close();
    ?>

    <!-- 자동 submit -->
    <script>
        document.userInfo.submit();
    </script>
</body>

</html>