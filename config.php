<?php
//PROD DB
$config['dbname'] = 'station_crm';
//$config['host'] = 'localhost';
$config['host'] = '168.227.76.58';
$config['dbuser'] = 'root';
$config['dbpass'] = 'growth081010';
//RBX DB
$config['rbx_dbname'] = 'isupergaus';
$config['rbx_host'] = '168.227.77.150';
$config['rbx_dbuser'] = 'Nemesis';
$config['rbx_dbpass'] = '3gjkwj5lj#e2Cc4Zc@78NNHqaSe5@';



try {
    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ///$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
} catch(PDOException $e) {
    echo "ERRO: ".$e->getMessage();
    exit;
}

try {
    $rbx_db = new PDO("mysql:dbname=".$config['rbx_dbname'].";host=".$config['rbx_host'], $config['rbx_dbuser'], $config['rbx_dbpass']);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ///$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $rbx_db->exec('set names utf8');
} catch(PDOException $e) {
    echo "ERRO db_rbx: ".$e->getMessage();
    exit;
}
