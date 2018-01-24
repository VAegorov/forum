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
    <div>

            <h1><?=$topic_arr['topic']; ?></h1>
            <p><b>Создана: </b><span><?=$topic_arr['date']; ?>.</span><b> Автор: </b><span><?=$topic_arr['author']; ?>.</span></p>
            <p><b>Количество ответов: </b><span><?=countAnsweres($link, $topic_arr['id_topic']); ?></span></p>
        <h2>Ответы</h2>
        <?php
            foreach ($answeres as $elem):
        ?>
            <p><b><?=$elem['date']; ?> </b><span><?=$elem['author']; ?></span></p>
            <p><?=$elem['description']; ?></p>
            <br>
        <?php
        endforeach;
        ?>
    </div>
    <div>#Пагинация</div>
    <div>
        <h2>Добавить ответ</h2>
        <form method="POST" action="#">
            <p><input type="text" name="author" placeholder="Ваше имя"></p>
            <p><textarea rows="20" name="description" placeholder="Ваше сообщение"></textarea></p>
            <p><input type="submit" name="submit" value="Сохранить"></p>
        </form>
    </div>
</body>
</html>