
<?php

if (!empty($_GET['id'])) {
    include_once('config.php');

    $idusers = $_GET['id'];

    // Use instruções preparadas para prevenir SQL injection
    $sqlSelect = "SELECT * FROM users WHERE idusers=?";
    $stmtSelect = $conexao->prepare($sqlSelect);
    $stmtSelect->bind_param("i", $idusers);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();

    if ($result->num_rows > 0) {
        // Use instruções preparadas para prevenir SQL injection na exclusão
        $sqlDelete = "DELETE FROM users WHERE idusers=?";
        $stmtDelete = $conexao->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $idusers);
        $resultDelete = $stmtDelete->execute();

        if ($resultDelete === TRUE) {
            header('Location: sistema.php');
        } else {
            echo "Erro ao excluir o usuário: " . $conexao->error;
        }
    }
}