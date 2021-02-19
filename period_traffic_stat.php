<?php
require 'conn.php';
$dbh = conn();

$start = "$_GET[from_date] $_GET[from_time]";
$stop = "$_GET[to_date] $_GET[to_time]";

$stat_query = $dbh->prepare("SELECT SUM(`in_traffic`), SUM(`out_traffic`) FROM `seance` WHERE `seance`.`start` > ? AND `seance`.`stop` < ?");
$stat_query->execute(array($start, $stop));
$working_stat = $stat_query->fetchAll(PDO::FETCH_NUM)[0];

$in_traffic = $working_stat[0];
$out_traffic = $working_stat[1];

echo "<h4>Cтатистика работы в сети c $start по $stop:</h4>";
echo "<p>Общее количество входящего трафика &#8212 $in_traffic KB</p>";
echo "<p>Общее количество исходящего трафика &#8212 $out_traffic KB</p>";
