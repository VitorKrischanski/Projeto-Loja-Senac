<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — Sistema</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ffffffff;
            height: 100vh;
            margin: 0;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: #cfcfcfff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            width: 360px;
            text-align: center;
        }

        h2 { 
            margin: 0 0 14px; 
            font-size: 22px; 
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            text-align: left;
        }

        input[type=text],
        input[type=email],
        input[type=password] {
            width: 80%;              
            padding: 8px;         
            margin-bottom: 12px;
            border: 1px solid 
            #ffffffff;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            width: 80%;             
            padding: 10px;
            border: 0;
            border-radius: 6px;
            background: #193f91ff;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }

        .errors {
            background: #ffe8e8;
            color: #8b1e1e;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 12px;
            text-align: left;                   
        }

        .logout {
            text-align: right;
            margin-bottom: 10px;
        }

        .small {
            font-size: 13px;
            color: #202124ff;
        }
    </style>
</head>
<body>

<div class="card">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Senac_logo.svg/1200px-Senac_logo.svg.png" width="35%">
    <br><br>
    <hr>
        <?php
        session_start();
        echo "<p class='small'>".$_session['msg_error']."</small>";
        session_destroy();
    ?>
    <br>
    <form method="post" action="valida.php">

        <label></label>
        <input id="username" name="email" type="email" placeholder="E-mail" required>

        <label></label>
        <input id="password" name="senha" type="password" placeholder="Senha" required>

        <br><br>
        <br>
        <button type="submit">Entrar</button><br><br><br>
    </form>

    <p class="small">Não tem conta? Crie um usuário <a href="cadastro_cliente.php">aqui</a>.</p>



</div>

</body>
</html>
