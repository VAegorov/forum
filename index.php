<?php
require_once "models/helper.php";
$link = db_connect();

$value_topic_page = 1; //количество тем на одной странице
$count_show_pages = 10;//количество страниц в пагинации

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

/* Пагинация */
$active = 1;//активная страница
if (isset($_GET['page'])) {
    echo $active = $_GET['page'];
}
$all_topic = allTopic($link, $active, $value_topic_page);
$count_topic = countTopic($link);
$count_pages = ceil($count_topic/$value_topic_page);//количество страниц
$url = "index.php";
$url_page = "index.php?page=";



include "views/index_v.php";