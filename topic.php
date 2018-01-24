<?php
require_once "models/helper.php";
$link = db_connect();

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
$answeres = answersGet($link, $id_topic);

include "views/topic-v.php";