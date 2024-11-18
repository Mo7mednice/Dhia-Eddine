<?php require_once 'layout/header.php'; ?>
<?php
include "../../database/database.php";
$get_admin = "SELECT * FROM admin WHERE id = $id_admin ";
$result = mysqli_query($connect, $get_admin);
$row = mysqli_fetch_assoc($result);
?>

<link rel="stylesheet" href="../../styles/profile.css">
<div class="all">
    <h1>Profile Informations</h1>
    <div class="container">
        <div class="inputs-groupe">
            <div class="input-wrapper">
                <label for="username">Nom d'Utilisateur:</label>
                <input type="text" id="username" value="<?php echo $row['nom_utilisateur']; ?>" readonly>
            </div>
            <div class="input-wrapper">
                <label for="password">Mot de Passe:</label>
                <input type="password" id="password" value="<?php echo $row['mot_passe']; ?>" readonly>
                <span class="icon-show"><ion-icon name="eye-outline"></ion-icon></span>
            </div>
            <span id="icon-edit"><ion-icon name="create-outline"></ion-icon></span>
        </div>
    </div>
</div>
<script src="../../scripts/admin/profile.js"></script>

<?php require_once 'layout/footer.php'; ?>