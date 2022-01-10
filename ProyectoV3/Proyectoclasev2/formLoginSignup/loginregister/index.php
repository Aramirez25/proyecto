<?php session_start();
$errors = [
    "1062" => "Ese email ya existe",
    "1032" => "Contraseña no encaja",
    "password_not_match" => "La verificacion de contraseña ha fallado",
    "credentials_fail" => "Credenciales incorrectas",
    "db_fail" => "Error en la base de datos",
    "error_consulta" => "Error en la consulta"
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login & singup form</title>
</head>


<body>
    <div class="container">
        <div class="title-text">
            <div class="title login">
                Login
            </div>
            <div class="title signup">
                Signup
            </div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slider-tab"></div>
            </div>
            <?php
                if(isset($_GET['error'])){
                    echo '<div style="color:red;">'.$errors[$_GET['error']].'</div>';
                }
            ?>
            <div class="form-inner">

                <form action="../auth/login.php" class="login" method="post">
                    
                    <div class="field">
                        <input type="email" name="email" placeholder="Email" maxlength="25" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Contraseña" maxlength="15" required>
                    </div>
                    
                    <div class="pass-link">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Login">
                        <!--onclick="validate()" -->
                    </div>
                    <div class="signup-link">
                        ¿No tienes cuenta aún? <a href="">Registrate ahora</a>
                    </div>
                </form>
                <form action="../auth/signup.php" class="signup" method="post">
                    <div class="field">
                        <input type="text" name="user" placeholder="Usuario" required>
                    </div>
                    <div class="field">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password1" placeholder="Repita su contraseña" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Signup">
                        <!--onclick="validate()" -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

    <?php if(isset($_GET['form']) && $_GET['form'] == 'signup'){ ?>
        
        <script>

                loginForm.style.marginLeft = "-50%";
                loginText.style.marginLeft = "-50%";
                document.querySelector("#login").checked = false;
                document.querySelector("#signup").checked = true;

        </script>
        
    <?php } ?>

</body>

</html>