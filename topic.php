<?php
require_once "models/helper.php";
$link = db_connect();

$value_answer_page = 1; //количество ответов на одной странице
$count_show_pages = 10;//количество страниц в пагинации

if (isset($_GET['add_answer'])) {
    $id_topic = (int)$_GET['add_answer'];
    echo "Ответ добавлен";
}

if (isset($_POST['submit'])) {
    $id_topic = (int)$_GET['id_topic'];
    if (empty($_POST['description']) || empty($_POST['author'])) {
        echo "<h1 class='red'>Ответ не добавлен. Вы не заполнили все поля!</h1>";
    } else {
        $author = $_POST['author'];
        $description = $_POST['description'];
        if (addAnswer($link, $id_topic, $author, $description)) {

            header("Location:topic.php?add_answer=$id_topic");
        } else {
            "<h1 class='red'>Ответ не добавлен. Попробуйте попозже!</h1>";
        }
    }
}
if (isset($_GET['id_topic'])) {
    $id_topic = $_GET['id_topic'];
}
$topic_arr = topic($link, $id_topic);

$active = 1;//активная страница
if (isset($_GET['page'])) {
    $active = $_GET['page'];
}

$answeres = answersGet($link, $id_topic, $active, $value_answer_page);

/* Пагинация */

$all_answers = answersGet($link, $id_topic, $active, $value_answer_page);
$count_answers = countAnswers($link, $id_topic);
$count_pages = ceil($count_answers/$value_answer_page);//количество страниц
$url = "topic.php?id_topic=$id_topic";
$url_page = "topic.php?id_topic=$id_topic&page=";


include "views/topic-v.php";