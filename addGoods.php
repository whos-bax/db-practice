<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>addgoods</title>
</head>

<body>
    <?
    $connect = mysql_connect("localhost", "root", "apmsetup");
    mysql_select_db("store_db", $connect);
    mysql_set_charset("utf8", $connect);

    $goodsname = $_POST['goodsname'];
    $remaining = $_POST['remaining'];
    $cost = $_POST['cost'];

    $sql = "insert into goods values(NULL,'$goodsname',$remaining,$cost);";
    $result = mysql_query($sql, $connect);

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