<?php
require 'config.php'
?>
<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <title>Gerador de Classes</title>
</head>
<body>
<div class="container">
    <main>
<?php
if(isset($_GET['banco'])) {
    if (isset($db) && $_GET['banco'] == 'crm') {
        $query = $db->prepare('show tables');
        $query->execute();
        echo '<form class="mt-5"><div class="row g-3>"';
        echo '<label for="select-table" >Tabelas</label><select id="select-table" class="form-select" aria-label="">';
        while ($row = $query->fetch(PDO::FETCH_NUM)) {
            echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
        }
        echo '</select></div>';

        echo '<button id="btn-gerar" class="w-100 btn btn-primary btn-lg mt-5" type="button">Gerar Class</button>';
        echo '</form>';
    }
    if (isset($rbx_db) && $_GET['banco'] == 'rbx') {
        $query = $rbx_db->prepare('show tables');
        $query->execute();
        echo '<form class="mt-5"><div class="row g-3>"';
        echo '<label for="select-table" >Tabelas</label><select id="select-table" class="form-select" aria-label="">';
        while ($row = $query->fetch(PDO::FETCH_NUM)) {
            echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
        }
        echo '</select></div>';

        echo '<button id="btn-gerar" class="w-100 btn btn-primary btn-lg mt-5" type="button">Gerar Class</button>';
        echo '</form>';
    }
}else{
    echo 'Escolha um banco de dados';
}
?>
        <div class="row mt-5">
            <div id="conteudo" class="col-12">

            </div>
        </div>
    </main>
</div>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function (){
       $('#btn-gerar').on('click',function (){
           const v = $('#select-table').val();
           getConsulta(v);
       })
    });

    function getConsulta(q){
        $('#conteudo').html('carregando..');
        var url = "./consulta.php?banco="+'<?php echo $_GET['banco'];?>'+"&q="+q;
        fetch(url).then(function (response){
            return response.text()
        }).then(function (html){
            $('#conteudo').html(html);
        })
    }

</script>
</body>
</html>

