<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchName = $_POST["searchName"];
    $search_adherent = "SELECT * FROM adherents WHERE nom LIKE '$searchName%'";
    $result = mysqli_query($connect, $search_adherent);

    if ($result && mysqli_num_rows($result) > 0) {
        $adherents = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $adherents[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $adherents]);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => "Ce nom de l'adherent n'existe pas."]);
        exit();
    }
}