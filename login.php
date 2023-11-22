<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/modal.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="content-login">
            <div class="content-logo">
                <img src="img/logo.jpg">
            </div>
            <form action="login_control.php" method="post">
                <div class="content-enter"> 

                    <label id="select_position">Usuario</label>
                    <input type="text" name="usuario">
                    <label>Senha</label>
                    <input type="password" name="senha">
                    <button class="btn" type="submit">Login</button>

                </div>
            </form>
        </div>
        <div class="texto">
            <div>Se ainda não é cadastrado 
                <button id="modal_cadastrar_user">click aqui</button>, caso esqueceu a senha 
                <button id="modal_Solicita_senha">click aqui</button>
                <div id="solicitar_troca" class="modal-senha">
                    <div class="modal_senha_container">
                        <span class="close" id="closeModalBtn_1">&times;</span>
                        <h2>Solicitação de troca de Senha</h2>
                        <form id="troca_senha" action="login_control.php?value=solicitacao" method="post">
                            <label for="user">Usuario:</label>
                            <input type="text" id="solicita_user" name="socitacao_usuario" required>
                            
                            <label for="email">Email:</label>
                            <input type="email" id="envio_email" name="socitacao_email" required>

                            <select class="selector" for="acao" name="socitacao_motivo" required>
                                <option value="erro de login">Erro de Login</option>
                                <option value="troca de senha">Troca de Senha</option>
                                <option value="alterar usuario">Alterar usuario</option>
                                <option value="deletar conta">Deletar conta</option>
                            </select>
                            
                            <input type="submit" value="Enviar" class="bnt-form">
                        </form>
                    </div>
                </div>

                <div id="cadastrar" class="modal-cadastro">
                    <div class="modal_cadastro_container">
                        <span class="close" id="closeModalBtn_2">&times;</span>
                        <h2>Cadastrar Usuário</h2>
                        <form action="login_control.php?value=cadastrar" method="post">

                            <div>
                                <label>Nome:</label>
                                <input type="text" name="nome_cadastro">
                                <label>Username:</label>
                                <input type="text" name="user_cadastro">
                                <label>Password:</label>
                                <input type="password" name="pass_cadastro">
                                <label>Email:</label>
                                <input type="email" name="email_cadastro">
                                <label>Tell:</label>
                                <input type="text" name="tell_cadastro">
                                <label>Cidade:</label>
                                <input type="text" name="cidade_cadastro">
                            </div>  

                            <input type="submit" value="Enviar" class="bnt-form">
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/login.js"></script>
    
    
        
</body>
</html>