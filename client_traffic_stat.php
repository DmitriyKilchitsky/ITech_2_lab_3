<?php
require 'conn.php';
$dbh = conn();

$client_name_query = $dbh->prepare("SELECT `name` FROM `client` WHERE `client`.`id_client` = ?");
$client_name_query->execute(array($_GET['id_client']));
$client_name = $client_name_query->fetch(PDO::FETCH_ASSOC)['name'];

$stat_query = $dbh->prepare("SELECT SUM(`in_traffic`), SUM(`out_traffic`) FROM `seance` WHERE `seance`.`fid_client` = ?");
$stat_query->execute(array($_GET['id_client']));
$working_stat = $stat_query->fetchAll(PDO::FETCH_NUM)[0];

$in_traffic = $working_stat[0];
$out_traffic = $working_stat[1];

$arr = array('clientName' => $client_name, 'inTraffic' => $in_traffic, 'outTraffic' => $out_traffic);
echo json_encode($arr);
