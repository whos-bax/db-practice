<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap');
    </style>
    <script type='text/javascript'>
        function checkUsers() {
            location.href = "getUsers.php";
        }
    </script>
    <title>쇼핑몰 DB관리하기</title>
</head>

<body>
    <div class="container">
        <span style="position: absolute; top: 1em; right: 2em; color: white; font-size: 1em;">
            2015270029 박상호</span>
        <div class="userInfo">
            <div class='content1'>
                <span id='content-title'>주문자 정보</span><br />
                <form id='form1' method="post" action="addUsers.php">
                    <label for='name'>주문자이름 </label>
                    <input type='text' name='name' placeholder="주문자이름" required>
                    <label for='password'>비밀번호</label>
                    <input type='password' name='password' placeholder="비밀번호" required>
                    <input type='submit' id='submit-btn' value="확인" />
                    <button type='button' style="cursor: pointer;" onclick="checkUsers()">주문자정보</button>
                </form>
            </div>
            <div class='content2'>
                <span id='content-title'>주문내역</span><br />
                <h2 style="text-align: center;">
                    로그인 이후 확인 가능합니다.
                </h2>
            </div>
        </div>
        <div class="goods">
            <div class='content3'>
                <span id='content-title'>상품내역</span><br />
                <h2 style="text-align: center;">
                    로그인 이후 확인 가능합니다.
                </h2>
                </table>
            </div>
        </div>
    </div>
</body>

</html>