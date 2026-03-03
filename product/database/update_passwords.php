<?php
    include('../database/connection.php');

    // Pega todos os usuários
    $usuarios = $conn->query("SELECT id, email, password FROM user")->fetchAll(PDO::FETCH_ASSOC);

    $atualizadas = 0;
    foreach ($usuarios as $user) {
        echo "<p>";
        echo "ID: " . $user['id'] . " | Email: " . $user['email'] . " | ";

        // Verifica se a senha já está em formato hash (começa com $)
        $isHashed = (strpos($user['password'], '$') === 0);

        if (!$isHashed) {
            $hash = password_hash($user['password'], PASSWORD_DEFAULT);
            echo "Novo hash: " . substr($hash, 0, 20) . "... | ";

            $stmt = $conn->prepare("UPDATE user SET password = ? WHERE id = ?");
            $stmt->execute([$hash, $user['id']]);
            $atualizadas++;
        }
    }
?>