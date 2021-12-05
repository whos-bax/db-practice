<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap');
    </style>
    <title>주문자 정보</title>
</head>

<body>
    <script>
        function showList() {
            document.getElementById('orderList').style.visibility = 'visible';
            console.log(document.getElementById('orderList').style.visibility)
        }
    </script>
    <div class="container" style="text-align: center; overflow:hidden;">
        <div style="padding-top: 1em; height: 100%; width: 80%; background:wheat; margin:auto; overflow-y:auto">
            <h2>주문자 명단</h2>
            <form action='store.php'>
                <input type='submit' style='cursor: pointer;' value="돌아가기">
            </form>
            <hr>
            <?
            $connect = mysql_connect("localhost", "root", "apmsetup");
            mysql_select_db("store_db", $connect);
            mysql_set_charset("utf8", $connect);

            $sql = "select id, name from users;";
            $result = mysql_query($sql, $connect);

            $orders = "select distinct U.id, G.goodsname from goods G, orders O, users U where U.id=O.customerId and O.goodsId=G.id;";
            $orderForUser = mysql_query($orders, $connect);

            echo "<table style='text-align:center; margin: auto;'><tr>";
            echo "<td style='font-size: 1.5em; font-weight: 800; padding-right: 1em;'>이름</td>
                <td style='font-size: 1.5em; font-weight: 800;'>주문내역</td>";
            $count1 = mysql_num_rows($result);
            $count2 = mysql_num_rows($orderForUser);

            for ($i = 0; $i < $count1; $i++) {
                $name = mysql_fetch_row($result);
                echo "<tr>";
                echo "<td style='font-weight: 700; padding-right: 1em;'>$name[1]</td>";

                echo "<td>";
                $orderForUser = mysql_query($orders, $connect);
                for ($j = 0; $j < $count2; $j++) {
                    $rrow = mysql_fetch_array($orderForUser);
                    if ($rrow['id'] == $name[0]) {
                        echo $rrow['goodsname'] . " ";
                    }
                }
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";

            mysql_close();
            ?>
        </div>
    </div>
</body>

</html>