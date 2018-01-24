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

include "views/index_v.php";