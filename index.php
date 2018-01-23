<?php
require_once "models/helper.php";
$link = db_connect();

$all_topic = allTopic($link);

include "views/index_v.php";