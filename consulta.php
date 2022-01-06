<?php
if(!isset($_GET['q']) || !isset($_GET['banco'])){
    header($_SERVER["SERVER_PROTOCOL"] . "404 Not Found");
    echo 'Nenhum dado encontrado';
};

require 'config.php';

    if($_GET['banco'] == 'rbx'){
        $query = $rbx_db->prepare('SHOW COLUMNS FROM '.$_GET['q'] );
    }else{
        $query = $db->prepare('SHOW COLUMNS FROM '.$_GET['q'] );
    }

    $query->execute();

   while ($rows = $query->fetchAll(PDO::FETCH_ASSOC)){
       foreach ($rows as $row){
           if(str_contains($row['Key'],'PRI')){
               echo "@PrimaryGeneratedColumn({ name:'".$row['Field']."'})"."</br>";
           }else{
             echo "@Column({name:'".$row['Field']."', type:'".preg_replace('/[(0-9)]/i','',$row['Type'])."'})</br>";  
           }
           
           echo customUcFirst($row['Field']).":".getCustomType($row['Type']).'</br></br>';
       }
   }


function getCustomType($type): string
{
    if(str_contains($type,'varchar') || str_contains($type,'char')){
        return 'string';
    }
    if(str_contains($type,'int')){
        return 'number';
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