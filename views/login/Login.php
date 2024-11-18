<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../../styles/login.css">
    <link rel="stylesheet" href="../../frameworks/node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/256/926/926321.png">
</head>

<body>
    <div id="hello">
        <div id="login">
            <img src="../../images/login.svg" alt="Login Icon" draggable="false">
            <form method="POST" id="formLogin">
                <div class="input">
                    <span class="span"><ion-icon name="person" title="User icon"></ion-icon></span>
                    <input type="text" title="put your username" name="username" id="username" required>
                    <p id="p1">Entrez votre nom sans espaces</p>
                    <label for="username">Nom d'utilisateur</label>
                </div>
                <div class="input">
                    <span class="span"><ion-icon name="lock-closed" title="Lock icon"></ion-icon></span>
                    <input type="password" title="put your password" name="password" id="password" required>
                    <p id="p2">Entrez votre mot de passe sans espaces</p>
                    <label for="password">Mot de passe</label>
                </div>
                <button title="click here to login" class="btn">Se connecter</button>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../../frameworks/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../frameworks/node_modules/chart.js/dist/chart.umd.js"></script>
    <script src="../../frameworks/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../../scripts/login/login.js"></script>
</body>

</html>