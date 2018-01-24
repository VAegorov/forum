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
    $query = "SELECT COUNT(id_description) AS count_answeres FROM description_forum WHERE id_topic=$id_topic";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $count_answeres_arr = mysqli_fetch_assoc($result);
    $count_answeres = $count_answeres_arr['count_answeres'];
    return $count_answeres;
}