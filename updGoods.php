<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>updGoods</title>
</head>

<body>
    <?
    $connect = mysql_connect("localhost", "root", "apmsetup");
    mysql_select_db("store_db", $connect);
    mysql_set_charset("utf8", $connect);

    $goods = $_POST['delGoods'];
    $userId = $_POST['userId'];

    $deleteGoods = "delete from goods where id='$goods[0]';";
    mysql_query($deleteGoods, $connect);

    echo "<form name='reUser' method='POST' action='admin.php'>
    <input type='hidden' name='userId' value='$userId'/>
    </form>";
    mysql_close();

    ?>
    <script>
        document.reUser.submit();
    </script>
</body>

</html>