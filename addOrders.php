<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addOrder</title>
</head>

<body>
    <?
    $connect = mysql_connect("localhost", "root", "apmsetup");
    mysql_select_db("store_db", $connect);
    mysql_set_charset("utf8", $connect);


    $goods = $_POST['goods']; // id, count 배열
    $userId = $_POST['userId'];

    $selectOrder = "select * from orders where goodsId='$goods[0]' and customerId='$userId';";
    $checkOrder = mysql_query($selectOrder, $connect);
    $alreadyHad = mysql_fetch_row($checkOrder);

    $newRemain = "update goods set remaining=remaining-'$goods[1]' where id='$goods[0]';";

    $beforeRemain = "select remaining from goods where id='$goods[0]';";
    $remaining = mysql_query($beforeRemain, $connect);
    $remainingCount = mysql_fetch_row($remaining);

    $updateOrder = "update orders set count=count+'$goods[1]' where goodsId='$goods[0]' and customerId='$userId';";
    $deleteOrder = "delete from orders where count<=0;";

    if (abs($goods[1]) <= $remainingCount[0]) {
        // 기존
        if ($alreadyHad) {
            // 0보다 작을때
            if ($goods[1] < 0) {
                if (abs($goods[1]) <= $alreadyHad[1]) {
                    mysql_query($updateOrder, $connect);
                    mysql_query($newRemain, $connect);
                } else {
                    echo "<script>alert('정확한 값을 입력하세요.')</script>";
                }
            }
            // 0보다 클 때
            else {
                mysql_query($updateOrder, $connect);
                mysql_query($newRemain, $connect);
            }
            $checkOrder = mysql_query($selectOrder, $connect);
            $alreadyHad = mysql_fetch_row($checkOrder);
            if ($alreadyHad[1] == 0) {
                echo "<script>alert('주문 내역이 삭제 됩니다')</script>";
                mysql_query($deleteOrder, $connect);
            }
        }

        // 신규
        else {
            // count, goodsId, customerId
            if ($goods[1] > 0) {
                $insertOrder = "insert into orders values(null, $goods[1], $goods[0], $userId);";

                mysql_query($insertOrder, $connect);
                mysql_query($newRemain, $connect);
            } else {
                echo "<script>alert('정확한 값을 입력하세요.')</script>";
            }
        }
    } else {
        echo "<script>alert('재고가 부족합니다')</script>";
    };


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