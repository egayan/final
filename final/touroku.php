<?php
    const SERVER = 'mysql220.phy.lolipop.lan';
    const DBNAME = 'LAA1517815-final';
    const USER = 'LAA1517815';
    const PASS = 'Pass0315';
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
<?php
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo->query("SELECT music_id, artist, title FROM music");
    $musicData = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品登録画面</title>
    <link rel="stylesheet" href="css/touroku.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="wrap"> <!-- 追加: 外側にラップする -->
        <form action="index.php" method="post" onsubmit="return validateForm()">
            <h1>商品登録画面</h1>
            <div>
                <label for="artist">アーティスト名</label>
                <input id="artist" class="cool" type="text" name="artist" size="50" required><br>
            </div>            
            <div>
                <label for="music">曲名</label>
                <input id="music" class="cool" type="text" name="title" size="50" required><br>
            </div>
            <div>
                <label for="image">画像</label>
                <input id="image" class="cool" type="text" name="image" size="50" required><br>
            </div>
            <div>
                <label for="time">時間</label>
                <input id="time" class="cool" type="text" name="time" size="50" required><br>
            </div>
            <button class="touroku" type="submit" name="insert">登録</button>
        </form>
        <form action="index.php" method="post">
            <button class="return" type="submit">戻る</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('input').on('focusin', function() {
                $(this).parent().find('label').addClass('active');
            });

            $('input').on('focusout', function() {
                if (!this.value) {
                    $(this).parent().find('label').removeClass('active');
                }
            });
        });
    </script>
</body>
</html>
