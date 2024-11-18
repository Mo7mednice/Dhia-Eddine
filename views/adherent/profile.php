<?php require_once 'layout/header.php'; ?>
<?php
include "../../database/database.php";
$get_adherent = "SELECT * FROM adherents WHERE idAdherent = $id_adhernet ";
$result = mysqli_query($connect, $get_adherent);
$row = mysqli_fetch_assoc($result);
?>

<link rel="stylesheet" href="../../styles/profile.css">
<div class="all">
    <h1>Profile Informations</h1>
    <div class="container">
        <div class="inputs-groupe">
            <div class="input-wrapper">
                <label for="username">Nom:</label>
                <input type="text" id="nom" value="<?php echo $row['nom']; ?>" readonly>
            </div>
            <div class="input-wrapper">
                <label for="username">Prénom:</label>
                <input type="text" id="prenom" value="<?php echo $row['prenom']; ?>" readonly>
            </div>
            <div class="input-wrapper">
                <label for="username">Date de Naissance:</label>
                <input type="text" id="dateNaissance" value="<?php echo $row['dateNaissance']; ?>" readonly>
            </div>
            <div class="input-wrapper">
                <label for="username">Adresse:</label>
                <input type="text" id="adresse" value="<?php echo $row['adresse']; ?>" readonly>
            </div>
            <div class="input-wrapper">
                <label for="username">N° Télephone:</label>
                <input type="text" id="telephone" value="<?php echo $row['telephone']; ?>" readonly>
            </div>
            <div class="input-wrapper">
                <label for="username">Nom d'Utilisateur:</label>
                <input type="text" id="username" value="<?php echo $row['nomUtilisateur']; ?>" readonly>
            </div>
            <div class="input-wrapper">
                <label for="password">Mot de Passe:</label>
                <input type="password" id="password" value="<?php echo $row['motPasse']; ?>" readonly>
                <span class="icon-show"><ion-icon name="eye-outline"></ion-icon></span>
            </div>
            <span id="icon-edit"><ion-icon name="create-outline"></ion-icon></span>
        </div>
    </div>
</div>
<script src="../../scripts/adherent/profile.js"></script>

<?php require_once 'layout/footer.php'; ?>