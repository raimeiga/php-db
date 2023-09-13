<!-- 出力以外の処理をDOCTYPE宣言の前、出力処理をbodyタグの中に記述することで、コードの可読性が大幅にアップ -->

<?php
        /*データソース名：DSN（Data Source Name）
          データベースに接続するために必要な情報（データベース名、
          ホスト名、またはIPアドレス、文字コードなど）*/
        $dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
        $user = 'root';
        $password = '';

        try{
            /*PDO=PHP Data Objectsの略。
            　PHPからデータベースに接続するためのクラス*/            
            $pdo =new PDO($dsn, $user, $password);

            // usersテーブルからidカラムとnameカラムのデータを取得するためのSQL文を変数$sqlに代入する
            $sql = 'SELECT id, name FROM users';
 
            /*query()メソッド＝SQL文を実行するためのメソッド
               query()メソッドを書くと、戻り値としてPDOStatementクラスのオブジェクトを返す。*/
            $stmt = $pdo->query($sql);
 
             /*fetchAll()メソッド＝SQL文の実行結果を配列で取得する 
               PDO::FETCH_ASSOC=カラム名のみをキーとする配列
               PDO::FETCH_BOTH=カラム名と番号(配列のインデックス数？）をキーとする配列　*/
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
        ?>

<!DOCTYPE html>
<html  lang="ja">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP+DB</title>
        <link rel="stylesheet" href="css/style.css">
</head>

<body>
<table>
         <tr>
             <th>ID</th>
             <th>氏名</th>
         </tr>
         <?php
         // 配列の中身を順番に取り出し、表形式で出力する
         foreach ($results as $result) {
             echo "<tr><td>{$result['id']}</td><td>{$result['name']}</td></tr>";
         }
         ?>
     </table>
</body>

</html>