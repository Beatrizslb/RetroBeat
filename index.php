<?php
    include_once "topo.php";
    include_once "menu.php";
?>
<main>
<?php
//area do conteudo
    if(empty($_SERVER["QUERY_STRING"])){
        $var = "conteudo";
        include_once "$var.php";
    }else{
        $pg = $_GET['pg'];
        include "$pg.php";
    }
?>
</main>

<?php
    include_once "rodape.php";
?>