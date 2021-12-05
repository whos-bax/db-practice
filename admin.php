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
    <script>
        function deleteGoods() {
            const returnValue = confirm("삭제하시겠습니까?");
        }

        function clearUser() {
            window.localStorage.clear();
        }
    </script>
    <title>쇼핑몰 결과</title>
</head>

<body>
    <?
    $connect = mysql_connect("localhost", "root", "apmsetup");
    mysql_select_db("store_db", $connect);
    mysql_set_charset("utf8", $connect);

    // users
    $userId = $_POST['userId'];
    $getUserName = "select name from users where id='$userId'";

    // goods
    $getGoods = "select * from goods;";
    $resultGoods = mysql_query($getGoods, $connect);
    ?>

    <div class="container">
        <span style="position: absolute; top: 1em; right: 2em; color: white; font-size: 1em;">
            2015270029 박상호</span>
        <div class="userInfo" style="max-height: 18em;">
            <div class='content1'>
                <span id='content-title'>주문자 정보</span><br />
                <form id='form1' method="post" action="store.php" onsubmit="clearUser()">
                    <label for='name'>주문자이름 </label>

                    <!-- userInfo -->
                    <?
                    $userName = mysql_query($getUserName, $connect);
                    $rowUser = mysql_fetch_row($userName);
                    echo "$rowUser[0]";
                    echo "님, 환영합니다";
                    ?>
                    <input type='submit' id='submit-btn' value="로그아웃" />
                </form>
            </div>

            <!-- Orders -->
            <div class='content2'>
                <span id='content-title'>주문내역</span><br />
                <table style="background-color: antiquewhite; text-align: center;">
                    <thead>
                        <tr>
                            <th>상품명</th>
                            <th>주문수량</th>
                            <th>총 금액</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- 중첩 질의 -->
                        <?
                        $getOrder = "select G.goodsname, O.count, G.cost from goods G, orders O where O.goodsId = G.id and O.customerId = '$userId';";
                        $orders = mysql_query($getOrder, $connect);
                        $fieldsO = mysql_num_fields($orders);
                        while ($rowOrder = mysql_fetch_row($orders)) {
                            echo "<tr><td>$rowOrder[0]</td><td>$rowOrder[1]</td><td>" .
                                $rowOrder[2] * $rowOrder[1] . "원" . "</td></tr>";
                        }
                        mysql_close();
                        ?>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="goods" style="max-height: 20em;">
            <div class='content3'>
                <span id='content-title'>상품내역</span><br />
                <table style="background-color: antiquewhite; text-align: center;">
                    <thead>
                        <tr>
                            <th>상품명</th>
                            <th>재고량</th>
                            <th>가격</th>
                            <th>담기</th>
                            <th>삭제</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $fieldsG = mysql_num_fields($resultGoods);
                        while ($rowGoods = mysql_fetch_row($resultGoods)) {
                            echo "<tr>";
                            for ($i = 1; $i < $fieldsG; $i = $i + 1) {
                                echo "<td>$rowGoods[$i]</td>";
                                $goodsId = $rowGoods[0];
                            }

                            // 수정 form -> addOrders.php
                            echo "<td style='width: 20%;'>
                        <form style='align-items: center; display: flex; flex-direction: row; justify-content:center;'  method='POST' action='addOrders.php'>";

                            // goods(id, count), userId 전송
                            echo "
                            <input type='number' name='goods[]' style='display: none;' value='$goodsId'/>
                            <input type='number' name='userId' style='display: none;' value='$userId'/>
                                <label style='text-align:center;'>
                                <input type='number' style='width: 3em; height: 2em;' name='goods[]' required>
                                <input type='submit' id='update-btn' style='display:inline; border:none; margin-left: 0.5em;' value='수정' />
                                </label>
                            </form>
                            </td>";

                            // 삭제
                            echo "
                            <td style='width:10%'>
                            <form style='padding-left: 0.5em; align-items: center; display: flex; flex-direction: row; justify-content:center;' method='POST' action='delGoods.php' name='deleteForm'>
                                <label id='delete-btn' style='font-size: small; padding: 0.3em;'> 삭제
                                <input type='submit' style='display:none;' name='delGoods[]' value='$goodsId'  onclick='deleteGoods()'/>
                                <input type='number' name='userId' style='display: none;' value='$userId' />
                                </label>
                            </form>
                        </div>
                    </td>";
                        }
                        echo "</tr>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 상품추가 -->
        <div class="goods">
            <div class="content3" style="justify-content: center;">
                <form style="display: flex;" method="POST" action="addGoods.php">
                    <label for="goodsname">상품명 :
                        <input type="text" style='margin:auto;' name="goodsname" required></label>
                    <label for="remaining">재고량 :
                        <input type="number" min='0' ;style='margin:auto;' name="remaining" required></label>
                    <label for='cost'>가격 :
                        <input type="number" min='0' ;style='margin:auto;' name="cost" required></label>
                    <?
                    echo "<input type='number' name='userId' style='display: none;' value='$userId' />";
                    ?>
                    <input type='submit' id='submit-btn' style='margin: auto' value="상품 추가">
                </form>
            </div>
        </div>
    </div>
</body>

</html>