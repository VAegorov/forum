<?php
require_once "models/helper.php";
$link = db_connect();

$id_topic = $_GET['id_topic'];
$topic_arr = topic($link, $id_topic);
$answeres = answeresGet($link, $id_topic);

include "views/topic-v.php";