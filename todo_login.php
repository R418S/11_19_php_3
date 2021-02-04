<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン画面</title>
</head>

<body>
  <form action="todo_login_act.php" method="POST">
    <fieldset>
      <legend>ログイン画面</legend>
      <div>
        ID: <input type="text" name="ID">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div>
        <button>ログイン</button>
      </div>
      <a href="todo_register.php">新規登録</a>
    </fieldset>
  </form>

</body>

</html>