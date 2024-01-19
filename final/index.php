<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1517815-final';
const USER = 'LAA1517815';
const PASS = 'Pass0315';
$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
?>

<?php
$pdo = new PDO($connect, USER, PASS);
$sql = "SELECT * FROM music";

if ($_POST) {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $stmt = $pdo->prepare('UPDATE music SET artist=:artist, title=:title, image=:image,time=:time WHERE music_id=:id');
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':artist', $_POST['artist']);
        $stmt->bindValue(':title', $_POST['title']);
        $stmt->bindValue(':image', $_POST['image']);
        $stmt->bindValue(':time', $_POST['time']);
        $stmt->execute();
    } else if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        // 音楽テーブルから削除
        $stmt_genre = $pdo->prepare('DELETE FROM music WHERE music_id = :id'); // Fix typo here: 'mudic_id' -> 'music_id'
        $stmt_genre->bindValue(':id', $id);
        $stmt_genre->execute();
    } else if (isset($_POST['insert'])) {
        // Fix foreach loop, and use singular variable instead of plural
        $stmt = $pdo->prepare('INSERT INTO music(artist, title, image,time) VALUES (:artist, :title, :image, :time)');
        $stmt->bindValue(':artist', $_POST['artist']);
        $stmt->bindValue(':title', $_POST['title']);
        $stmt->bindValue(':image', $_POST['image']);
        $stmt->bindValue(':time', $_POST['time']);
        $stmt->execute();
    }
}

$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧画面</title>
    <link rel="stylesheet" href="css/index.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<h1>商品一覧画面</h1>
<form action="touroku.php" method="post">
    <button class="toroku" type="submit">新規登録</button>
</form>
<table border="1">
    <tr>
        <th>アーティスト名</th><th>曲名</th><th>画像</th><th>時間</th>
        <th colspan="2">操作</th>
    </tr>

    <?php
    foreach ($stmt as $row) {
        echo '<tr>';
        echo '<td>', $row['artist'], '</td>';
        echo '<td>', $row['title'], '</td>';
        echo '<td>', '<img src="image/',$row['image'],'"','alt="',$row['title'],'"','weight="80" height="150">','</td>';
        echo '<td>', $row['time'],'</td>';
        echo '<td>';
        ?>
        <button class = "indication" onclick="change(this)">表示</button>
        <form id="disp" class="hidden" action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['music_id']; ?>">
            <input type="text" name="artist" value="<?php echo $row['artist']; ?>" placeholder="アーティスト名"><br>
            <input type="text" name="title" value="<?php echo $row['title']; ?>" placeholder="曲名"><br>
            <input type="text" name="image" value="<?php echo $row['image']; ?>" placeholder="画像パス"><br>
            <input type="text" name="time" value="<?php echo $row['time']; ?>" placeholder="時間"><br>
            <button class="update" type="submit" name="update">更新</button>
        </form>
        </td>
        <td>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['music_id']; ?>">
            <button class="delete"type="submit" name="delete" class="delete-button">削除</button>
        </form>
        <?php
        echo '</td>';
        echo '</tr>';
        echo "\n";
    }
    ?>
    </td>
    </tr>
</table>
<script src="admin.js"></script>
</body>
</html>





