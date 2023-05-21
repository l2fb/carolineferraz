<?php

session_start();
ob_start();
require('conexao.php');
include_once 'validar_token.php';

if(!validarToken()){
    header("Location: index.html");
    exit();
}

$nome = recuperarNomeToken();
$email = recuperarEmailToken();

echo "<meta HTTP-EQUIV='refresh' CONTENT='1800'>";

?>

<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style_index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>Caroline Ferraz</title>
</head>
<body>
    <header>
        <nav class="dp-menu">
            <ul>
                    <li><a class="logo" href="logout.php">Log<span>Out</span></a></li>
                        <li><a href="https://wa.me/5571991293370?text=Ola%20Carol%20tudo%20bem?%20Me%20chamo%20<?php echo $nome ?>.%20Gostaria%20de%20tirar%20algumas%20duvidas!" target="_blank"><img src="images/whatsapp.jpg" alt="WhatsApp"></a></li>
                        <li><a href="https://www.instagram.com/carolferraztricologia/" target="_blank"><img src="images/instagram.jpg" alt="Instagram"></a></li>
                        <li><a href="javascript:void(0)" onclick='window.open("home.html", "iframe-container")'><b><i>Inicio</i></b></a></li>
                        <li><a>Como Começar</a>
                    <ul>
                        <li><a href="javascript:void(0)" onclick='window.open("agendar.php?id_job=Avaliação%20Capilar", "iframe-container")'>Avaliação Capilar</a></li>
                        <li><a href="javascript:void(0)" onclick='window.open("agendar.php?id_job=Consulta%20Capilar", "iframe-container")'>Consulta Capilar</a></li>
                        <li><a href="javascript:void(0)" onclick='window.open("agendar.php?id_job=Consulta%20Online", "iframe-container")'>Consulta Online</a></li>
                    </ul></li>
                        <li><a class="logo">Prof<span>ile</span></a>
                    <ul>
                        <li><a href="javascript:void(0)" onclick='window.open("reservas.php", "iframe-container")'>Acompanhamentos</a></li>
                    </ul></li>
            </ul>
        </nav>
        <nav class="mobile right">
                    <div class="botao-menu-mobile">
                    <a class="logo" href="logout.php">Log<span>Out</span></a>
                    <a href="https://wa.me/5571991293370?text=Ola%20Carol%20tudo%20bem?%20Gostaria%20de%20tirar%20algumas%20duvidas!" target="_blank"><img src="images/whatsapp.jpg" alt="WhatsApp"></a>
                    <a href="https://www.instagram.com/carolferraztricologia/" target="_blank"><img src="images/instagram.jpg" alt="Instagram"></a>
                    <i class="fas fa-bars"></i>
                    </div>
                    <ul>
                        <li><a href="javascript:void(0)" onclick='window.open("home.html", "iframe-container")'><b><i>Inicio</i></b></a></li>
                        <li><a href="javascript:void(0)" onclick='window.open("agendar.php?id_job=Avaliação%20Capilar", "iframe-container")'>Avaliação Capilar</a></li>
                        <li><a href="javascript:void(0)" onclick='window.open("agendar.php?id_job=Consulta%20Capilar", "iframe-container")'>Consulta Capilar</a></li>
                        <li><a href="javascript:void(0)" onclick='window.open("agendar.php?id_job=Consulta%20Online", "iframe-container")'>Consulta Online</a></li>
                        <li><a href="javascript:void(0)" onclick='window.open("reservas.php", "iframe-container")'>Acompanhamentos</a></li>
                    </ul>
                </nav>
    </header>

    <div class="iframe-container">
        <iframe name="iframe-container" id="iframe-container" src="reservas.php"></iframe>
    </div> 
    <script>
        $(function(){ 
        $('nav.mobile ul li a').click(function(){
            var listaMenu = $('nav.mobile ul');
            var icone = $('.botao-menu-mobile').find('i');
            icone.removeClass('far fa-times-circle');
            icone.addClass('fas fa-bars');
            listaMenu.slideToggle(); 
        });
    
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
        });
        });
    </script> 
</body>
</html>
