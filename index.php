<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="./assets/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <script src="./assets/js/login.js"></script>
    <title>Organize</title>
</head>

<body>
    <div class="LoginForm">
        <div style="min-width: 320px;">
            <form class="AppForm">

                <div class="Title">
                    Login - Organize
                </div>

                <div style="color: red;min-height: 30px;" id="resposta"></div>

                <div class="AppInput">                    
                    <label>
                        <span>Usuário</span>
                        <input type="text" name="login" id="login">
                    </label>
                </div>
                <div class="AppInput">
                    <label>
                        <span>Senha</span>
                        <input type="password" name="pass" id="pass">
                    </label>
                </div>
                <button onclick="valida_login()" type="button" class="AppButton">Login</button>

            </form>
        </div>
    </div>

</body>

</html>