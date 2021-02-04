<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザ登録画面</title>
</head>

<body>
  <form action="todo_register_act.php" method="POST">
    <fieldset>
      <legend>ユーザ登録画面</legend>
      <div>
        ID: <input type="text" name="ID">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div>
        <button>新規登録</button>
      </div>
      <a href="todo_login.php">ログイン</a>
    </fieldset>
  </form>

</body>

</html>