<?php
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

function allTopic($link)
{
    $query = "SELECT * FROM forum";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $all_topic = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $all_topic[] = $data;
    }
    return $all_topic;
}

function countAnsweres($link, $id_topic)
{
    $id_topic = (int) $id_topic;
    $query = "SELECT COUNT(id_description) AS count_answeres FROM description_forum WHERE id_topic=$id_topic";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $count_answeres_arr = [];
    $count_answeres_arr = mysqli_fetch_assoc($result);
    $count_answeres = $count_answeres_arr['count_answeres'];
    return $count_answeres;
}

function answeresGet($link, $id_topic)
{
    $id_topic = (int) $id_topic;
    $query = "SELECT date, author, description FROM description_forum WHERE id_topic=$id_topic";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $answeres = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $answeres[] = $data;//попробовать сделать без while
    }
    return $answeres;
}

function topic($link, $id_topic)
{
    $query = "SELECT * FROM forum WHERE id_topic=$id_topic";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $topic_arr = [];
    $topic_arr = mysqli_fetch_assoc($result);
    return $topic_arr;
}

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