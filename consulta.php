<?php
if(!isset($_GET['q']) || !isset($_GET['banco'])){
    header($_SERVER["SERVER_PROTOCOL"] . "404 Not Found");
    echo 'Nenhum dado encontrado';
};

require 'config.php';
if (isset($db) && isset($rbx_db)) {
    if($_GET['banco'] == 'rbx'){
        $query = $rbx_db->prepare('SHOW COLUMNS FROM '.$_GET['q'] );
    }else{
        $query = $db->prepare('SHOW COLUMNS FROM '.$_GET['q'] );
    }

    $query->execute();

   while ($rows = $query->fetchAll(PDO::FETCH_ASSOC)){
       foreach ($rows as $row){
           if(str_contains($row['Key'],'PRI')){
               echo '[key]'.'</br>';
           }
           echo '[Column("'.$row['Field'].'")]'.'</br>';
           echo 'public '.getCustomType($row['Type']).' '.customUcFirst($row['Field']).' { get; set;}</br></br>';
       }
   }
}

function getCustomType($type): string
{
    if(str_contains($type,'varchar') || str_contains($type,'char')){
        return 'string';
    }
    if(str_contains($type,'int')){
        return 'int';
    }
    if(str_contains($type,'timestamp')){
        return 'DateTime';
    }
    return $type;
}

function customUcFirst($str): string {
    if(str_contains($str,'_')){
        $s = explode('_',$str);
        $r = '';
        foreach ($s as $v){
            $r .= ucfirst($v);
        }
        return $r;
    }

    return ucfirst($str);
}