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
    <p><a href="index.php">На главную</a></p>
    <div>
            <h1><?=$topic_arr['topic']; ?></h1>
            <p><b>Создана: </b><span><?=$topic_arr['date']; ?>.</span><b> Автор: </b><span><?=$topic_arr['author']; ?>.</span></p>
            <p><b>Количество ответов: </b><span><?=countAnswers($link, $topic_arr['id_topic']); ?></span></p>
            <p><?=$topic_arr['description']; ?></p>
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
    <div>#Пагинация
        <?php


        if ($count_pages > 1) { // Всё это только если количество страниц больше 1
            /* Дальше идёт вычисление первой выводимой страницы и последней (чтобы текущая страница была где-то посредине,
            если это возможно, и чтобы общая сумма выводимых страниц была равна count_show_pages, либо меньше, если
            количество страниц недостаточно) */
            $left = $active - 1;
            $right = $count_pages - $active;
            if ($left < floor($count_show_pages / 2)) $start = 1;
            else $start = $active - floor($count_show_pages / 2);
            $end = $start + $count_show_pages - 1;
            if ($end > $count_pages) {
                $start -= ($end - $count_pages);
                $end = $count_pages;
                if ($start < 1) $start = 1;
            }?>
            <!-- Дальше идёт вывод Pagination -->
            <div id="pagination">
                <span>Страницы: </span>
                <?php if ($active != 1) { ?>
                    <a href="<?=$url?>" title="Первая страница">&lt;&lt;&lt;</a>
                    <a href="<?php if ($active == 2) { ?><?=$url?><?php } else { ?><?=$url_page.($active - 1)?><?php } ?>" title="Предыдущая страница">&lt;</a>
                <?php } ?>
                <?php for ($i = $start; $i <= $end; $i++) { ?>
                    <?php if ($i == $active) { ?><span><?=$i?></span><?php } else { ?><a href="<?php if ($i == 1) { ?><?=$url?><?php } else { ?><?=$url_page.$i?><?php } ?>"><?=$i?></a><?php } ?>
                <?php } ?>
                <?php if ($active != $count_pages) { ?>
                    <a href="<?=$url_page.($active + 1)?>" title="Следующая страница">&gt;</a>
                    <a href="<?=$url_page.$count_pages?>" title="Последняя страница">&gt;&gt;&gt;</a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div>
        <h2>Добавить ответ</h2>
        <form method="POST" action="topic.php?id_topic=<?=$topic_arr['id_topic']; ?>">
            <p><input type="text" name="author" placeholder="Ваше имя"></p>
            <p><textarea rows="20" name="description" placeholder="Ваше сообщение"></textarea></p>
            <p><input type="submit" name="submit" value="Сохранить"></p>
        </form>
    </div>
</body>
</html>