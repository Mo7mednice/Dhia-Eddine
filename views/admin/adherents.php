<?php require_once 'layout/header.php'; ?>
<link rel="stylesheet" href="../../styles/main.css">
<div class="container">

    <div class="search">
        <input type="search" placeholder="Rechercher un Adhérent..." id="search-input">
        <span class="icon-search" title="Rechercher"><ion-icon  id="search-click"
                name="search-outline"></ion-icon></span>
        <span class="icon-delete" title="Supprimer"><ion-icon id="search-delete"
                name="trash-outline"></ion-icon></span>
        <p id="message-empty">Entrez quelque chose à rechercher.</p>
    </div>
    <div class="manage-adherent">
        <button type="button" id="add"><span class="icon-add"></span><ion-icon
                name="person-add-outline"></ion-icon>Adhérent</button>
        <div class="table-container">
            <h1>Liste des Adhérents</h1>
            <table border="1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de Naissance</th>
                        <th>Adresse</th>
                        <th>N° Telephone</th>
                        <th>Nom d'utilisateur</th>
                        <th>Mot de passe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../database/database.php";
                    $get_adhrents = "SELECT * FROM adherents";
                    $result = mysqli_query($connect, $get_adhrents);

                    while ($all_row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $all_row["idAdherent"]; ?></td>
                            <td class='nom'><?php echo $all_row["nom"]; ?></td>
                            <td><?php echo $all_row["prenom"]; ?></td>
                            <td><?php echo $all_row["dateNaissance"]; ?></td>
                            <td><?php echo $all_row["adresse"]; ?></td>
                            <td><?php echo $all_row["telephone"]; ?> </td>
                            <td><?php echo $all_row["nomUtilisateur"]; ?></td>
                            <td><?php echo $all_row["motPasse"]; ?></td>
                            <td>
                                <button type="button" title="Modifier" class="update"
                                    data-id='<?php echo $all_row["idAdherent"]; ?>'>
                                    <span class="icon-edit"><ion-icon
                                            name="create-outline"></ion-icon></span>
                                </button>
                                <button type="button" title="Supprimer" class="delete"
                                    data-id='<?php echo $all_row["idAdherent"]; ?>'>
                                    <span class="icon-delete"><ion-icon
                                            name="trash-outline"></ion-icon>
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
<script src="../../scripts/admin/actionsAdherent.js"></script>
<?php require_once 'layout/footer.php'; ?>