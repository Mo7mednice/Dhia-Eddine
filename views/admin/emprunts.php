<?php require_once 'layout/header.php'; ?>
<link rel="stylesheet" href="../../styles/main.css">
<link rel="stylesheet" href="../../styles/emprunts.css">
<div class="container">
    <div class="table-container">
        <h1>Liste des demandes de emprunt</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Adhérent</th>
                    <th>titre du livre</th>
                    <th>N° Exemplaire</th>
                    <th>Date de Commande</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../../database/database.php";

                $get_adhrents =
                    "SELECT *
                FROM emprunts
                JOIN exemplaires ON emprunts.idExemplaire = exemplaires.idExemplaire
                JOIN adherents ON emprunts.idAdherent = adherents.idAdherent
                JOIN livres ON livres.idLivre = exemplaires.idLivre
                ORDER BY emprunts.dateCommande ASC";
                $result = mysqli_query($connect, $get_adhrents);
                $i = 1;
                if ( mysqli_num_rows($result) > 0) {
                    while ($all_row = mysqli_fetch_assoc($result)) {
                        if (empty($all_row["etatEmprunt"])) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class='nom'><?php echo $all_row["nom"] . ' ' . $all_row["prenom"]; ?></td>
                                <td><?php echo $all_row["titre"]; ?></td>
                                <td><?php echo $all_row["idExemplaire"]; ?></td>
                                <td><?php echo $all_row["dateCommande"]; ?></td>
                                <td>
                                    <button type="button" title="Accepter" class="accepter"
                                        data-id1='<?php echo $all_row["idEmprunt"]; ?> '
                                        data-id2='<?php echo $all_row["idAdherent"]; ?>'
                                        data-id3='<?php echo $all_row["idExemplaire"]; ?>'>
                                        <span class="icon-edit"><ion-icon name="checkmark-circle-outline"></ion-icon></span>
                                    </button>
                                    <button type="button" title="Rejeter" class="rejeter"
                                        data-id='<?php echo $all_row["idEmprunt"]; ?>'>
                                        <span class="icon-delete"><ion-icon name="close-circle-outline"></ion-icon></span>
                                    </button>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" class="message-text">Il n'y a pas de demande de emprunt d'exemplaire d'un livre</td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>
    <div class="table-container">
        <h1>Liste des retours de emprunt</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Adhérent</th>
                    <th>titre du livre</th>
                    <th>N° Exemplaire</th>
                    <th>Date de Emprunt</th>
                    <th>Date de Retour</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../../database/database.php";

                $get_adhrents =
                    "SELECT *
                FROM emprunts
                JOIN exemplaires ON emprunts.idExemplaire = exemplaires.idExemplaire
                JOIN adherents ON emprunts.idAdherent = adherents.idAdherent
                JOIN livres ON livres.idLivre = exemplaires.idLivre
                WHERE emprunts.dateRetour IS NOT NULL
                ORDER BY emprunts.dateRetour ASC";
                $result = mysqli_query($connect, $get_adhrents);
                $i = 1;
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($all_row = mysqli_fetch_assoc($result)) {
                        if ($all_row["etatEmprunt"] === 'Retour') {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class='nom'><?php echo $all_row["nom"] . ' ' . $all_row["prenom"]; ?></td>
                                <td><?php echo $all_row["titre"]; ?></td>
                                <td><?php echo $all_row["idExemplaire"]; ?></td>
                                <td><?php echo $all_row["dateEmprunt"]; ?></td>
                                <td><?php echo $all_row["dateRetour"]; ?></td>
                                <td>
                                    <button type="button" title="Inscription de Retour" class="retour"
                                        data-id1='<?php echo $all_row["idAdherent"]; ?> '
                                        data-id2='<?php echo $all_row["idExemplaire"]; ?>'>
                                        <span class="icon-return"><ion-icon name="return-up-forward-outline"></ion-icon></span>
                                    </button>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" class="message-text">Il n'y a pas de demande de retour d'un exemplaire d'un livre
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
</div>
<script src="../../scripts/admin/actionsEmprunt.js"></script>
<?php require_once 'layout/footer.php'; ?>