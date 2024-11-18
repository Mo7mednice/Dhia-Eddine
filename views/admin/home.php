<?php require_once 'layout/header.php'; ?>

<?php
include "../../database/database.php";
$get_admin = "SELECT nom_utilisateur FROM admin WHERE id = $id_admin ";
$result = mysqli_query($connect, $get_admin);
$row = mysqli_fetch_assoc($result);
$update_retard = "UPDATE retards 
JOIN emprunts ON retards.idRetard = emprunts.idRetard 
SET retards.numJour = GREATEST(DATEDIFF(NOW(), dateEmprunt) - 15, 0) 
WHERE emprunts.etatEmprunt = 'Accepté'";
$result_update = mysqli_query($connect, $update_retard);
?>
<link rel="stylesheet" href="../../styles/main.css">
<link rel="stylesheet" href="../../styles/home.css">
<div class="container">
    <div class="first-content">
        <h1>Bonjour <font><?php echo $row["nom_utilisateur"]; ?></font>, vous pouvez gérer tout :</h1>
        <ul>
            <li><a href="adherents.php">Gestion des Adhérent<span class="icons"><ion-icon
                            name="arrow-forward-outline"></ion-icon></span></a></li>
            <li><a href="livres.php">Gestion des Livres<span class="icons"><ion-icon
                            name="arrow-forward-outline"></ion-icon></span></a></li>
            <li><a href="emprunts.php">Gestion des Emprunts <span class="icons"><ion-icon
                            name="arrow-forward-outline"></ion-icon></span></a></li>

        </ul>
        <div class="action-retard">
            <button id="show-hide">Afficher la Liste des Retards</button>
        </div>
    </div>
    <div class="scand-content">
        <div class="table-container" style="display: none;">
            <h1>Liste des Retards</h1>
            <table border="1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Adhérent</th>
                        <th>titre du livre</th>
                        <th>N° Exemplaire</th>
                        <th>Date de Emprunt</th>
                        <th>Nombre de jours de retard</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_update) {
                        $emprunts = "SELECT * 
                        FROM emprunts
                        JOIN exemplaires ON emprunts.idExemplaire = exemplaires.idExemplaire
                        JOIN adherents ON emprunts.idAdherent = adherents.idAdherent 
                        JOIN retards ON emprunts.idRetard = retards.idRetard 
                        JOIN livres ON livres.idLivre = exemplaires.idLivre
                        WHERE emprunts.etatEmprunt = 'Accepté' AND numJour > 0 ";
                        $result_exmp = mysqli_query($connect, $emprunts);
                        $i = 1;
                        if (mysqli_num_rows($result_exmp)) {
                            while ($all_exmp = mysqli_fetch_assoc($result_exmp)) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td class='nom'><?php echo $all_exmp["nom"] . ' ' . $all_exmp["prenom"]; ?></td>
                                    <td><?php echo $all_exmp["titre"]; ?></td>
                                    <td><?php echo $all_exmp["idExemplaire"]; ?></td>
                                    <td><?php echo $all_exmp["dateEmprunt"]; ?> </td>
                                    <td><?php echo $all_exmp["numJour"]; ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                        } else {
                            ?>
                            <td>
                            <td colspan="5">Aucun adhérent n'a fait de emprunt</td< /td>
                                <?php

                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="../../scripts/admin/actionhome.js"></script>
<?php require_once 'layout/footer.php'; ?>