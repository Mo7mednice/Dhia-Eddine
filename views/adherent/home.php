<?php require_once 'layout/header.php'; ?>
<?php
include "../../database/database.php";
$get_adherent = "SELECT nomUtilisateur FROM adherents WHERE idAdherent = $id_adhernet";
$result_adherent = mysqli_query($connect, $get_adherent);
$row = mysqli_fetch_assoc($result_adherent);
$get_livres = "SELECT *, COUNT(exemplaires.idLivre) AS numexem FROM livres 
JOIN auteurs ON livres.idAuteur = auteurs.idAuteur
JOIN pays ON auteurs.idPays = pays.idPays
JOIN exemplaires ON livres.idLivre = exemplaires.idLivre
WHERE exemplaires.etat = 'Disponible'
GROUP BY exemplaires.idLivre";
$result = mysqli_query($connect, $get_livres);
?>
<link rel="stylesheet" href="../../styles/main.css">
<link rel="stylesheet" href="../../styles/home.css">
<div class="container">
  <div class="search">
    <input type="search" placeholder="Rechercher un Livre..." id="search-input">
    <span class="icon-search" title="Rechercher"><ion-icon id="search-click" name="search-outline"></ion-icon></span>
    <span class="icon-delete" title="Supprimer"><ion-icon id="search-delete" name="trash-outline"></ion-icon></span>
    <p id="message-empty" style="display:none">Entrez quelque chose à rechercher.</p>
  </div>
  <div class="content">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <div class="card" style="width: 18rem;">
        <img src="../../images/book.png" class="card-img-top" alt="Couverture du livre">
        <h3 class="card-title"><?php echo $row["titre"]; ?></h3>
        <p class="card-text"><?php echo $row["resume"]; ?></p>
        <p>
          <font>Auteur:</font> <?php echo $row["nom"] . ' ' . $row["prenom"]; ?>
        </p>
        <p>
          <font>Nombre des Exemplaires:</font> <?php echo $row["numexem"]; ?>
        </p>
        <a href="confirmeEmprunt.php?idLivre=<?php echo $row['idLivre']; ?>"><button>Emprunter
            livre</button></a>
      </div>
      <?php
    } ?>
  </div>
</div>
<script src="../../scripts/adherent/searchLivre.js"></script>

<?php require_once 'layout/footer.php'; ?>