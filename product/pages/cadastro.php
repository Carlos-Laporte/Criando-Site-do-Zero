<!DOCTYPE html>

<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>IMS Login - Inventory Management System</title>
        <link rel="stylesheet" href="../CSS/styleCadastro.css">
    </head>
    <body id="registerBody">

        <div class="container">
            <div class="registerHeader">
                <h1>IMS</h1>
                <p>INVENTORY MANAGEMENT SYSTEM</p>
            </div>
            <div class="registerBody">
                <form action="cadastro.php" method="POST">
                    <div class="registerInputsConteiner">
                        <label for="email">Email</label>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="registerInputsConteiner">
                        <label for="telefone">Telephone number</label>
                        <input type="text" placeholder="Number" name="telefone">
                    </div>
                    <div class="registerInputsConteiner">
                        <label for="password">Password</label>
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="registerInputsConteiner">
                        <label for="password_confirm">Confirm your password</label>
                        <input type="password" placeholder="Password" name="password_confirm" required>
                    </div>
                    <div class="registerButtonConteiner">
                        <button>Register</button>
                    </div>
                </form>
                <div class="registerCadastrar">
                    <a href="login.php">Already have an account? <strong>Login here!</strong></a>
                </div>
            </div>
        </div>
    </body>
</html>