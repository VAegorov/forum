<?php

//соединение с базой данных
function db_connect()
{
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db_name = 'test';
    $link = mysqli_connect($host, $user, $password, $db_name);
    mysqli_set_charset($link, "UTF8") or die(mysqli_error($link));
    return $link;
}

//вывод всех тем
function allTopic($link, $active, $value_topic_page)
{
    if ($active == 1) {
        $start = 0;
    } else {
        $start = ($active - 1) * $value_topic_page;
    }

    $query = "SELECT * FROM forum LIMIT $start, $value_topic_page";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $all_topic = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $all_topic[] = $data;
    }
    return $all_topic;
}

//количество ответов для одной темы
function countAnswers($link, $id_topic)
{
    $id_topic = (int) $id_topic;
    $query = "SELECT COUNT(id_description) AS count_answers FROM description_forum WHERE id_topic=$id_topic";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $count_answers_arr = mysqli_fetch_assoc($result);
    $count_answers = $count_answers_arr['count_answers'];
    return $count_answers;
}

//ответы для одной темы
function answersGet($link, $id_topic, $active, $value_answer_page)
{
    if ($active == 1) {
        $start = 0;
    } else {
        $start = ($active - 1) * $value_answer_page;
    }

    $id_topic = (int) $id_topic;
    $query = "SELECT date, author, description FROM description_forum WHERE id_topic=$id_topic LIMIT $start, $value_answer_page";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $answers = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $answers[] = $data;
    }
    return $answers;
}

//вывод одной темы
function topic($link, $id_topic)
{
    $query = "SELECT * FROM forum WHERE id_topic=$id_topic";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $topic_arr = mysqli_fetch_assoc($result);
    return $topic_arr;
}

//добавить тему
function addTopic ($link, $topic, $author, $description)
{
    $topic = mysqli_real_escape_string($link, trim($topic));
    $author = mysqli_real_escape_string($link, trim($author));
    $description = mysqli_real_escape_string($link, trim($description));
    $query = sprintf("INSERT INTO forum (topic, author, description) VALUE ('%s', '%s', '%s')",
        $topic, $author, $description);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $r = mysqli_affected_rows($link);
    if ($r == 1) {
        return true;
    } else return false;

}

//добавить ответ
function addAnswer ($link, $id_topic, $author, $description)
{
    $id_topic = mysqli_real_escape_string($link, trim($id_topic));
    $author = mysqli_real_escape_string($link, trim($author));
    $description = mysqli_real_escape_string($link, trim($description));
    $query = sprintf("INSERT INTO description_forum (id_topic, author, description) VALUE ('%s', '%s', '%s')",
        $id_topic, $author, $description);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $r = mysqli_affected_rows($link);
    if ($r == 1) {
        return true;
    } else return false;
}

//общее количество тем
function countTopic($link)
{
    $query = "SELECT COUNT(id_topic) AS count FROM forum";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $count_arr = mysqli_fetch_assoc($result);
    $count = $count_arr['count'];
    return $count;
}




























