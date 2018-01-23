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