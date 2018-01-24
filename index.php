<?php
require_once "models/helper.php";
$link = db_connect();

if (isset($_GET['add_topic'])) {
    echo "Тема добавлена";
}

if (isset($_POST['submit'])) {
    if (empty($_POST['topic']) || empty($_POST['author']) || empty($_POST['description'])) {
        echo "<h1 class='red'>Тема не добавлена. Вы не заполнили все поля!</h1>";
    } else {
        $topic = $_POST['topic'];
        $author = $_POST['author'];
        $description = $_POST['description'];
        if (addTopic($link, $topic, $author, $description)) {

            header("Location:index.php?add_topic=1");
        } else {
            "<h1 class='red'>Тема не добавлена. Попробуйте попозже!</h1>";
        }
    }
}

$all_topic = allTopic($link);


/* Пагинация */
$count_pages = 500;
$active = 5;
$count_show_pages = 10;
$url = "index.php";
$url_page = "index.php?page=";
if ($count_pages > 1) { // Всё это только если количество страниц больше 1
    /* Дальше идёт вычисление первой выводимой страницы и последней (чтобы текущая страница была где-то посредине, если это возможно, и чтобы общая сумма выводимых страниц была равна count_show_pages, либо меньше, если количество страниц недостаточно) */
    $left = $active - 1;
    $right = $count_pages - $active;
    if ($left < floor($count_show_pages / 2)) $start = 1;
    else $start = $active - floor($count_show_pages / 2);
    $end = $start + $count_show_pages - 1;
    if ($end > $count_pages) {
        $start -= ($end - $count_pages);
        $end = $count_pages;
        if ($start < 1) $start = 1;
    }
}
include "views/index_v.php";