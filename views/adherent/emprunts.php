<?php require_once 'layout/header.php'; ?>
<link rel="stylesheet" href="../../styles/main.css">
<link rel="stylesheet" href="../../styles/emprunts.css">
<div class="container">
    <div class="table-container">
        <h1>Liste des Livres</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>N° Exemplaire</th>
                    <th>Durée Restante du Emprunt</th>
                    <th>Etat de Emprunt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../../database/database.php";
                $get_emprunts =
                    "SELECT livres.titre, emprunts.idExemplaire, emprunts.etatEmprunt, emprunts.dateEmprunt
                        FROM emprunts
                        JOIN exemplaires ON emprunts.idExemplaire = exemplaires.idExemplaire
                        JOIN livres ON livres.idLivre = exemplaires.idLivre
                        WHERE emprunts.idAdherent = $id_adhernet AND (emprunts.etatEmprunt = 'Accepté' OR emprunts.etatEmprunt = 'Regeté' OR emprunts.etatEmprunt IS NULL) 
                        ORDER BY emprunts.dateCommande DESC;";
                $result = mysqli_query($connect, $get_emprunts);
                $i = 1;
                while ($all_row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td class='nom'><?php echo $all_row["titre"]; ?></td>
                        <td><?php echo $all_row["idExemplaire"]; ?></td>

                        <?php
                        if (empty($all_row["etatEmprunt"])) {
                            ?>
                            <td> <span class="countnull">+00 +00:00:00</span> </td>
                            <td><button class="btn-attente"><ion-icon name="alarm"></ion-icon> En attente</button></td>
                            <?php
                        } else if ($all_row["etatEmprunt"] === 'Accepté') {
                            ?>
                                <td data-dateEmprunt="<?php echo $all_row["dateEmprunt"] ?>"><span class="countdown"></span></td>
                                <td><button class ="btn-retourner"
                                        data-id="<?php echo $all_row["idExemplaire"]; ?>"><ion-icon name="return-up-forward"></ion-icon> Retourner</button><span
                                        class="icon-accepte" title="Emprunt a été Accepté"><ion-icon name="checkmark-done-outline"></ion-icon></span></td>
                            <?php
                        } else {
                            ?>
                                <td><span class="countnull">+00 +00:00:00</span></td>
                                <td class="row-rejete"><button class="btn-rejete"> <ion-icon name="sad"></ion-icon> <?php echo $all_row["etatEmprunt"]; ?></button><span
                                        class="icon-remove" data-id="<?php echo $all_row["idExemplaire"]; ?>"><ion-icon name="close-outline"></ion-icon></span></td>
                            <?php
                        }

                        ?>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="../../scripts/adherent/actionsEmprunt.js"></script>
<?php require_once 'layout/footer.php'; ?>
