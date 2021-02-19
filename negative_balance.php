<?php
require 'conn.php';
$dbh = conn();

$clients_data_query = $dbh->query("SELECT `name` FROM `client` WHERE `client`.`balance` < 0");
$clients_data = $clients_data_query->fetchAll(PDO::FETCH_ASSOC);

$xml = new SimpleXMLElement('<xml/>');

foreach ($clients_data as $data) {
  $xml->addChild('h4', "Список клиентов с отрицательным балансом счета:");
  $xml->addChild('p', "- $data[name]");
}

Header('Content-type: text/xml');
echo $xml->asXML();
