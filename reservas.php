<?php

session_start();
require('conexao.php');
require('verifica_login.php');

$query = $conexao->query("SELECT * FROM $tabela_painel_users WHERE email = '{$_SESSION['email']}'");
while($select = $query->fetch(PDO::FETCH_ASSOC)){
    $nome = $select['nome'];
    $token = $select['token'];
}
?>

<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style_home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title><?php echo $config_empresa ?></title>
</head>
<body>
    <header>
    <?php echo $menu_site_logado ?>
    </header>
    <main>
        <section class="home-center">
            <br><br>
        <center><p>Acompanhamentos de <b><?php echo $nome ?></b></p></center><br>

<?php
$check_history = $conexao->prepare("SELECT * FROM $tabela_reservas WHERE doc_email = :email ORDER BY atendimento_dia DESC LIMIT 10");
$check_history->execute(array('email' => $_SESSION['email']));

$row_check = $check_history->rowCount();

if($row_check < 1){

    echo "<center><b>$nome</b>, nenhum <b>Atendimento</b> foi localizado em seu nome! Agende sua Consulta com <b>$config_empresa</b> agora mesmo</center>";

}else{

while($history = $check_history->fetch(PDO::FETCH_ASSOC)){
$history_conf = $history['confirmacao'];
$history_inicio = $history['atendimento_inicio'];
$history_data = $history['atendimento_dia'];
$history_hora = $history['atendimento_hora'];
$history_status = $history['status_reserva'];

$check = $conexao->prepare("SELECT sum(sessao_atual), sum(sessao_total) FROM tratamento WHERE email = :email AND confirmacao = :confirmacao");
$check->execute(array('email' => $_SESSION['email'], 'confirmacao' => $history_conf));
while($select2 = $check->fetch(PDO::FETCH_ASSOC)){
    $sessao_atual = $select2['sum(sessao_atual)'];
    $sessao_total = $select2['sum(sessao_total)'];
}

$row_check = $check->rowCount();

if($sessao_atual == '' && $sessao_total == ''){
    $sessao_atual = 0;
    $sessao_total = 1;
}
?>
<div class="visao-desktop">
<fieldset class="home-table">
<legend><a href="reserva.php?confirmacao=<?php echo $history_conf ?>&token=<?php echo $token ?>"><button class="home-btn"><?php echo $history_conf ?></button></a></legend>
<table class="home-table"><br>
    <tr>
        <td align="center"><b>Inicio</b></td>
        <td align="center"><b>Proxima Sessão</b></td>
        <td align="center"><b>Sessões</b></td>
        <td align="center"><b>Status</b></td>
    </tr>
    <tr>
        <td align="center"><?php echo date('d/m/Y', strtotime("$history_inicio")) ?></td>
        <td align="center"><?php echo date('d/m/Y', strtotime("$history_data")) ?> as <?php echo date('H:i\h', strtotime("$history_hora")) ?></td>
        <td align="center"><?php echo $sessao_atual ?>/<?php echo $sessao_total ?> </td>
        <td align="center"><?php echo $history_status ?> </td>
    </tr>
    </table><br>
</fieldset>
<br>
</div>
<div class="visao-mobile">
    <br><fieldset class="home-table">
        <legend><a href="reserva.php?confirmacao=<?php echo $history_conf ?>&token=<?php echo $token ?>"><button class="home-btn"><?php echo $history_conf ?></button></a></legend><br>
        <b>Inicio: </b><?php echo date('d/m/Y', strtotime("$history_inicio")) ?><br>
        <b>Status: </b><?php echo $history_status ?><br><br>
        <b>Sessões: </b><?php echo $sessao_atual ?>/<?php echo $sessao_total ?><br>
        <b>Proxima Sessão: </b><?php echo date('d/m/Y', strtotime("$history_data")) ?> às <?php echo date('H:i\h', strtotime("$history_hora")) ?><br>
        </fieldset>
</div><br>
<?php
}}
?>
        </section>
        <br>
    </main>
    <script src="js/script.js"></script>
    <script>
        $(function(){ 
           $('i.fas').click(function(){
               var listaMenu = $('nav.mobile ul');
               if(listaMenu.is(':hidden') == true){
                   var icone = $('.botao-menu-mobile').find('i');
                   icone.removeClass('fas fa-bars');
                   icone.addClass('far fa-times-circle');
                   listaMenu.slideToggle();
               }else{
                var icone = $('.botao-menu-mobile').find('i');
                   icone.removeClass('far fa-times-circle');
                   icone.addClass('fas fa-bars');
                   listaMenu.slideToggle(); 
               }
           }) 
        })
    </script> 
</body>
</html>