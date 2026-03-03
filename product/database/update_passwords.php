<?php
    include('../database/connection.php');

    // Pega todos os usuários
    $usuarios = $conn->query("SELECT id, password FROM user")->fetchAll(PDO::FETCH_ASSOC);

    $atualizadas = 0;
    foreach ($usuarios as $user) {
        // Verifica se a senha já está em formato hash (começa com $2y$, $2a$, $2b$, $argon2i$, etc)
        $isHashed = (strpos($user['password'], '$') === 0);

        if (!$isHashed) {
            $hash = password_hash($user['password'], PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE user SET password = ? WHERE id = ?");
            $stmt->execute([$hash, $user['id']]);
            $atualizadas++;
        }
    }

    echo "Senhas foram atualizadas com hash! Total: $atualizadas senhas foram hasheadas.";
?>