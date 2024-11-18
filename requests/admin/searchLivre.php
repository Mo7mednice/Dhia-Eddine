<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchName = $_POST["searchName"];
    $search_livre = "SELECT *, COUNT(exemplaires.idLivre) AS numexem
                        FROM livres
                        LEFT JOIN exemplaires ON livres.idLivre = exemplaires.idLivre
                        JOIN auteurs ON livres.idAuteur = auteurs.idAuteur
                        WHERE livres.titre LIKE \"$searchName%\"
                        GROUP BY exemplaires.idLivre";
    $result = mysqli_query($connect, $search_livre);
    if ($result && mysqli_num_rows($result) > 0) {
        $livre = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $livres[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $livres]);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => "Ce titre du livre n'existe pas."]);
        exit();
    }
}