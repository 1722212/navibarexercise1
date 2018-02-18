<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
// インポート
require_once '../database_conf.php';

/* DBに接続 */
try{
    // DB接続
    $db = new PDO($dsn, $dbUser, $dbPass);
    // プリペアードステートメントのエミュレーションを無効にする
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    // 例外をスロー
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "接続できませんでした　理由：".h($e->getMessage());
}

// DBからリンク名とリンク先の絶対パスを取得
$sql = "SELECT * FROM navibarpass";
$preapre = $db->prepare($sql);
$preapre->execute();
$result = $preapre->fetchAll(PDO::FETCH_ASSOC);


?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        リンク先一覧<br>
        <ul>
            <?php
            foreach ($result as $link){
                echo '<li>';
                echo '<a href="';
                echo $link["LINK_PASS"];
                echo '">';
                echo $link["LINK_NAME"];
                echo '</a>';
                echo '</li>';
            }
            ?>
        </ul>
        
        BoardTopです
    </body>
</html>
