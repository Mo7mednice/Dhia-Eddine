<?php
require_once 'layout/header.php';
include "../../database/database.php";
$idLivre = $_GET['idLivre'];
if (isset($idLivre)) {
    $get_livre =
        "SELECT *, COUNT(exemplaires.idLivre) AS numexem FROM livres 
        JOIN auteurs ON livres.idAuteur = auteurs.idAuteur
        JOIN pays ON auteurs.idPays = pays.idPays
        JOIN exemplaires ON livres.idLivre = exemplaires.idLivre
        WHERE exemplaires.etat = 'Disponible'
        AND livres.idLivre = $idLivre
        GROUP BY exemplaires.idLivre";
    $result = mysqli_query($connect, $get_livre);

    if ($row = mysqli_fetch_assoc($result)) {
        ?>
        <link rel="stylesheet" href="../../styles/main.css">
        <link rel="stylesheet" href="../../styles/emprunt.css">
        <div class="container">
            <div class="box-content">

                <img src="../../images/book.png" alt="Couverture du livre">
                <div class="livre-info">
                    <h1>Détails du Livre</h1>
                    <p>
                        <font>Titre:</font> <?php echo $row["titre"]; ?>
                    </p>
                    <p>
                        <font>Description:</font> <?php echo $row["descreption"]; ?>
                    </p>
                    <p>
                        <font>Résumé:</font> <?php echo $row["resume"]; ?>
                    </p>
                    <p>
                        <font>Auteur du Livre:</font> <?php echo $row["nom"] . ' ' . $row["prenom"]; ?>
                    </p>
                    <p>
                        <font>Pays de l'Auteur:</font> <?php echo $row["nomPays"]; ?>
                    </p>
                    <p>
                        <font>Anneé du Livre:</font> <?php echo $row["annee"]; ?>
                    </p>
                    <p>
                        <font>Nombre d'Exemplaires Disponibles:</font> <?php echo $row["numexem"]; ?>
                    </p>
                    <button data-id1="<?php echo $id_adhernet; ?>" data-id2="<?php echo $row["idExemplaire"]; ?>" id="btn-emprunt">Confirmer l'Emprunt</button>
                </div>
            </div>
        </div>
        <?php
    } else {
        header("Location: ../adherent/home.php");

    }
} else {
    header("Location: ../adherent/home.php");
}
?>
<script src="../../scripts/adherent/sendEmprunt.js"></script>
<?php require_once 'layout/footer.php'; ?>