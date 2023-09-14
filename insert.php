<?php
 $dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
 $user = 'root';
 $password = '';
 
 // submitパラメータの値が存在するとき（「登録」ボタンを押したとき）の処理
 if (isset($_POST['submit'])) {
     try {
         $pdo = new PDO($dsn, $user, $password);
 
         //動的に変わる値をプレースホルダに置き換えたINSERT文をあらかじめ用意しておく
         $sql = '
             INSERT INTO users (name, furigana, email, age, address)
             VALUES (:name, :furigana, :email, :age, :address)
         ';
          /*prepare()メソッド=動的に変わる値をプレースホルダに置き換えたSQL文を
                             あらかじめ用意するPDOクラスのメソッド
          プレースホルダ = SQL文の中で変動する値に使われる変数のようなもの。
                        「:name」のように :（コロン）で始まる文字列で指定する*/
         
         $stmt = $pdo->prepare($sql);
 
         // bindValue()メソッド＝実際の値をプレースホルダにバインドする（割り当てる）
         $stmt->bindValue(':name', $_POST['user_name'], PDO::PARAM_STR);
         $stmt->bindValue(':furigana', $_POST['user_furigana'], PDO::PARAM_STR);
         $stmt->bindValue(':email', $_POST['user_email'], PDO::PARAM_STR);
         $stmt->bindValue(':age', $_POST['user_age'], PDO::PARAM_INT);
         $stmt->bindValue(':address', $_POST['user_address'], PDO::PARAM_STR);
 
         /* SQL文を実行する
            execute()メソッド=prepare()メソッドであらかじめ用意しておいたSQL文を実行するメソッド*/
         $stmt->execute();
 
         /* header()関数を使ってselect.phpにリダイレクトさせる
            header()関数=ブラウザに対してさまざまな指示を出せる関数。 
            header('Location: リダイレクト先のパス')と書くと、別のページにリダイレクトする*/
         header('Location: select.php');
     } catch (PDOException $e) {
         exit($e->getMessage());
     }
 }
 ?>
 <!DOCTYPE html>
 <html lang="ja">
 
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>PHP+DB</title>
     <link rel="stylesheet" href="css/style.css">

 </head>
 
 <body>
     <h1>ユーザー登録</h1>
     <p>ユーザー情報を入力してください。</p>
     <form action="insert.php" method="post">
         <div>
             <label for="user_name">お名前<span>【必須】</span></label>
             <input type="text" name="user_name" maxlength="60" required>
 
             <label for="user_furigana">ふりがな<span>【必須】</span></label>
             <input type="text" name="user_furigana" maxlength="60" required>
 
             <label for="user_email">メールアドレス<span>【必須】</span></label>
             <input type="email" name="user_email" maxlength="255" required>
 
             <label for="user_age">年齢</label>
             <input type="number" name="user_age" min="13" max="130">
 
             <label for="user_address">住所</label>
             <input type="text" name="user_address" maxlength="255">
         </div>
         <button type="submit" name="submit" value="insert">登録</button>
     </form>
 </body>
 
 </html>