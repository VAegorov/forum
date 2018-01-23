<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Forum</title>
</head>
<body>
    <h1>Мой форум</h1>
    <p>Рассказ о форуме</p>
    <h2>Темы форума</h2>
    <div>
        <h3>Название темы</h3>
        <p><b>Создана: </b><span>Дата.</span><b> Автор: </b><span>Имя.</span></p>
        <p><b>Количество ответов: </b><span>Сколько</span></p>
    </div>
    <div>Пагинация</div>
    <div>
        <h2>Создать тему</h2>
        <form>
            <p><input type="text" name="author" placeholder="Ваше имя"></p>
            <p><input type="text" name="topic" placeholder="Название темы"></p>
            <p><textarea rows="20" name="description" placeholder="Описание темы"></textarea></p>
        </form>
    </div>
</body>
</html>