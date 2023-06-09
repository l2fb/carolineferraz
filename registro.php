<?php
require('conexao.php');


$id = explode('*', base64_decode(mysqli_real_escape_string($conn_msqli, $_GET['id'])));

$id_registro = $id[0];

$min_nasc = date('Y-m-d', strtotime("-110 years",strtotime($hoje))); 
$max_nasc = date('Y-m-d', strtotime("-18 years",strtotime($hoje))); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function formatar(mascara, documento){
        var i = documento.value.length;
        var saida = mascara.substring(0,1);
        var texto = mascara.substring(i)
  
        if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
        }
  
        }

        function removerZero(input) {
        var valor = input.value;
        if (valor.startsWith("0")) {
            input.value = valor.substring(1);
        }
    }

    </script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Accesar <?php echo $config_empresa ?></title>
</head>
<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <img src="images/white.png" alt="">
                </div>
                <div class="col-md-6 right">
                     <div class="input-box">
                        <header>Registre-se</header>
                        <form action="login.php" method="post" onsubmit="exibirPopup()">
                        <?php
                            if($id_registro == 'Registrar'){
                        ?>
                        <div class="input-field">
                            <input type="txt" class="input" minlength="8" maxlength="45" name="nome" required>
                            <label for="nome">Nome Completo</label>
                        </div>
                        <div class="input-field">
                            <input type="email" class="input" minlength="8" maxlength="50" name="email" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field">
                            <input type="txt" class="input" minlength="14" maxlength="14" name="cpf" OnKeyPress="formatar('###.###.###-##', this)" required>
                            <label for="cpf">CPF</label>
                        </div>
                        <div class="input-field">
                            <input type="txt" class="input" minlength="5" maxlength="30" name="rg" required>
                            <label for="rg">RG</label>
                        </div>
                        <div>
                        <label for="nascimento">Nascimento</label>
                            <input type="date" min="<?php echo $min_nasc ?>" max="<?php echo $max_nasc ?>" class="input" name="nascimento" required>
                        </div>
                        <div class="input-field">
                            <input type="txt" class="input" minlength="13" maxlength="14" name="telefone" OnKeyPress="formatar('##-#####-####', this)" onblur="removerZero(this)" required>
                            <label for="telefone">Telefone</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input" minlength="8" maxlength="20" name="password" required>
                            <label for="password">Senha</label>
                        </div>
                        <div class="input-field">
                            <input type="password" class="input" minlength="8" maxlength="20" name="conf_password" required>
                            <label for="conf_password">Confirmar Senha</label>
                        </div>
                        <?php
                            }else if($id_registro == 'EnvCodigo'){
                            $email = $id[1];
                            $token = $id[2];
                            $telefone = $id[3];
                            $nome = $id[4];
                            
                            //Ajustar Telefone
                            $ddd = substr($telefone, 0, 2);
                            $prefixo = substr($telefone, 2, 5);
                            $sufixo = substr($telefone, 7);
                            $telefone = "($ddd)$prefixo-$sufixo";
                            ?>
                        <center><p>Codigo enviado para o seu Celular!</p></center><br>
                        <br><p>
                            <b>Nome:</b> <?php echo $nome; ?><br>
                            <b>Email:</b> <?php echo $email; ?><br>
                            <b>Telefone:</b> <?php echo $telefone; ?>
                        </p>
                        <?php
                            }else if($id_registro == 'Codigo'){
                            $email = $id[1];
                            $codigo = $id[2];
                            $token = $id[3];
                        ?>
                        <center><p>Confirme o Codigo Enviado abaixo</p></center><br>
                        <div class="input-field">
                            <input type="email" class="input" minlength="8" maxlength="50" name="email" value="<?php echo $email; ?>" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="input" minlength="8" maxlength="8" name="codigo" value="<?php echo $codigo; ?>" required>
                            <label for="codigo">Codigo</label>
                        </div>
                        <input type="hidden" name="token" value="<?php echo $token; ?>">
                        <?php
                            }else if($id_registro == 'RecCodigo'){

                                $token = $id[2];
                                $email = $id[1];
    
                            ?>
                            <center><p>Confirme o seu Celular!</p></center><br>
                            <div class="input-field">
                                <input type="email" class="input" minlength="8" maxlength="50" name="email" value="<?php echo $email; ?>" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input type="txt" class="input" minlength="13" maxlength="14" name="telefone" OnKeyPress="formatar('##-#####-####', this)" onblur="removerZero(this)" required>
                                <label for="telefone">Telefone</label>
                             </div>
                            <input type="hidden" name="token" value="<?php echo $token; ?>">
                            <?php
                                }
                            ?>
                        <div class="input-field">
                        <input type="hidden" name="id_registro" value="<?php echo $id_registro; ?>">
                        <input type="hidden" name="id_job" value="registro">
                        <?php
                            if($id_registro != 'EnvCodigo'){
                        ?>
                            <input type="submit" class="submit" value="Confirmar"> 
                        <?php
                            }
                        ?>
                        </div>
                        </form>
                        <div class="signin">
                        <?php
                            if($id_registro == 'EnvCodigo'){
                        ?>
                        <span>Caso ja tenha confirmado o codigo, <a href="painel.php">Clicando Aqui</a></span>
                        <br><br>
                        <span>Caso não tenha recebido a mensagem no Whatsapp, altere seu telefone <a href="registro.php?id=<?php echo base64_encode("RecCodigo*$email*$token"); ?>">Clicando Aqui</a></span>
                        <?php
                            }else{
                        ?>
                            <span><b>[X]</b> Aceito os <a href="lgpd.php" target="_blank">Termos e Condições</a></span>
                        <?php
                            }
                        ?>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function exibirPopup() {
        Swal.fire({
            icon: 'warning',
            title: 'Carregando...',
            text: 'Aguarde enquanto enviamos seus dados!',
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });
    }
</script>
</body>
</html>