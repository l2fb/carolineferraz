<?php

session_start();
require('../conexao.php');
require('verifica_login.php');

$query_check = $conexao->query("SELECT * FROM $tabela_painel_users WHERE email = '{$_SESSION['email']}'");
while($select_check = $query_check->fetch(PDO::FETCH_ASSOC)){
    $aut_acesso = $select_check['aut_painel'];
}

if($aut_acesso == 1){
    echo 'Você não tem permissão para acessar esta pagina';
}else{
    
$hoje = date('Y-m-d');
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="card">
<div class="visao-desktop">
<?php
$query = $conexao->query("SELECT * FROM painel_users WHERE id >= 1 AND tipo = 'Paciente' ORDER BY nome ASC");
$query_row = $query->rowCount();
?>

<fieldset>
<?php
if($query_row == 0){
    ?>
<legend><h2 class="title-cadastro">Sem Cadastros</u></h2></legend>
    <?php
}else{
    ?>
<legend><h2 class="title-cadastro">Cadastros [<?php echo $query_row ?>]</h2></legend>
<table widht="100%" border="1px" style="color:black">
    <tr>
        <td width="50%" align="center"><b>Email</b></td>
        <td width="50%" align="center"><b>Nome</b></td>
        <td width="30%" align="center"><b>Telefone</b></td>
    </tr>
    <?php
}
while($select = $query->fetch(PDO::FETCH_ASSOC)){
    $nome = $select['nome'];
    $email = $select['email'];
    $telefone = $select['telefone'];
    ?>
<tr>
    <td align="center"><a href="javascript:void(0)" onclick='window.open("cadastro.php?email=<?php echo $email ?>","iframe-home")'><button><?php echo $email ?></button></a></td>
    <td><?php echo $nome ?></td>
    <td><?php echo $telefone ?></td>
</tr>
<?php
}
?>
</table>
</div>
</fieldset>

<div class="visao-mobile">
<?php
$query = $conexao->query("SELECT * FROM painel_users WHERE id >= 1 AND tipo = 'Paciente' ORDER BY nome ASC");
$query_row = $query->rowCount();
?>
<FONT COLOR="black">
<fieldset>
<?php
if($query_row == 0){
    ?>
<legend><h2 class="title-cadastro">Sem Cadastros</u></h2></legend>
    <?php
}else{
    ?>
<legend><h2 class="title-cadastro">Cadastros [<?php echo $query_row ?>]</h2></legend>
    <?php
}
while($select = $query->fetch(PDO::FETCH_ASSOC)){
    $nome = $select['nome'];
    $email = $select['email'];
    $telefone = $select['telefone'];
    ?>
    <br><a href="javascript:void(0)" onclick='window.open("cadastro.php?email=<?php echo $email ?>","iframe-home")'><button><?php echo $email ?></button></a>
    <br><b>Nome: </b><?php echo $nome ?>
    <br><b>Telefone: </b><?php echo $telefone ?>
    <br><br>
<?php } ?>
</font>
</div>
</fieldset>

</div>
</body>
</html>

<?php
}
?>