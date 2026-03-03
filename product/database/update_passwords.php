<?php
    include('../database/connection.php');

    // Pega todos os usuários
    $usuarios = $conn->query("SELECT id, password FROM user")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $user) {
        // Gera hash da senha atual
        $hash = password_hash($user['password'], PASSWORD_DEFAULT);

        // Atualiza o banco
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE id = ?");
        $stmt->execute([$hash, $user['id']]);
    }

    echo "Todas as senhas foram atualizadas com hash!";
?>