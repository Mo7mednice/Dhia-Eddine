<?php require_once 'layout/header.php'; ?>
<link rel="stylesheet" href="../../styles/main.css">
<link rel="stylesheet" href="../../styles/livre.css">
<div class="container">
    <div class="search">
        <input type="search" placeholder="Rechercher un Livre..." id="search-input">
        <span class="icon-search" title="Rechercher"><ion-icon id="search-click"
                name="search-outline"></ion-icon></span>
        <span class="icon-delete" title="Supprimer"><ion-icon id="search-delete" name="trash-outline"></ion-icon></span>
        <p id="message-empty" style="display:none">Entrez quelque chose à rechercher.</p>
    </div>
    <div class="manage-adherent">
        <button type="button" id="add"><ion-icon name="add-outline"></ion-icon>Livre</button>
        <div class="table-container">
            <h1>Liste des Livres</h1>
            <table border="1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Année</th>
                        <th>Resumé</th>
                        <th>Nom du Auteur</th>
                        <th>Prénom du Auteur</th>
                        <th>Pays du Auteur</th>
                        <th>Nombre des Exemplaires</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../database/database.php";
                    $get_livres = 
                        "SELECT livres.*,auteurs.nom, auteurs.prenom, pays.*, COUNT(exemplaires.idLivre) AS numexem
                        FROM livres
                        LEFT JOIN exemplaires ON livres.idLivre = exemplaires.idLivre
                        JOIN auteurs ON livres.idAuteur = auteurs.idAuteur
                        JOIN pays ON auteurs.idPays = pays.idPays
                        GROUP BY exemplaires.idLivre";
                    $result = mysqli_query($connect, $get_livres);
                    while ($all_row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $all_row["idLivre"]; ?></td>
                            <td class='nom'><?php echo $all_row["titre"]; ?></td>
                            <td><?php echo $all_row["annee"]; ?></td>
                            <td><?php echo $all_row["resume"]; ?></td>
                            <td><?php echo $all_row["nom"]; ?></td>
                            <td><?php echo $all_row["prenom"]; ?></td>
                            <td><?php echo $all_row["nomPays"]; ?></td>
                            <td><?php echo $all_row["numexem"]; ?> </td>
                            <td>
                                <button type="button" title="Modifier" class="update"
                                    data-id1='<?php echo $all_row["idLivre"]; ?>'
                                    data-id2='<?php echo $all_row["idAuteur"]; ?>'
                                    data-id3='<?php echo $all_row["idPays"]; ?>'>
                                    <span class="icon-edit"><ion-icon name="create-outline"></ion-icon></span>

                                </button>
                                <button type="button" title="Supprimer" class="delete"
                                    data-id='<?php echo $all_row["idLivre"]; ?>'>
                                    <span class="icon-delete"><ion-icon name="trash-outline"></ion-icon>
                                    </span> </button>
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
<script src="../../scripts/admin/actionsLivre.js"></script>
<?php require_once 'layout/footer.php'; ?>