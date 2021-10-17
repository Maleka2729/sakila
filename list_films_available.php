<?php 
include_once 'class/dbconfig.php';
$connection = new database;
$connection->connectDb();

include_once 'class/films.php';
$query = new films;
$film = $query->getOneFilm();
$inventories = $query->getDisponility();

include("components/header.php");

?>

<div class="container">
    <h2 class="title_page text-center mt-5 mb-4">DISPONIBILITES</h2>
</div>

<!-- show films -->
<div class="container mb-3">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="cellule_designation">Id inventaire</th>
                <th class="cellule_designation">Titre du film </th>
                <th class="cellule_designation">Disponible a l'adresse </th>
                <th class="cellule_designation">Date de location</th>
                <th class="cellule_designation">Date de retour</th>
                <th class="cellule_designation">Réservation</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($inventories as $inventory) { ?>
            <tr>
                <td class="cellule_table">
                    <?php echo $inventory['inventory_id']; ?>
                </td>

                <td class="cellule_table">
                    <?php echo $inventory['title']; ?>
                </td>

                <td class="cellule_table">
                    <?php echo $inventory['address']; ?>
                </td>

                <td class="cellule_table">
                    <?php 
                    if ($inventory['last_date_rental'] == NULL) {
                        echo 'LOCATION INDISPONIBLE';
                    } else {
                        echo $inventory['last_date_rental'];
                    }
                    ?>
                </td>

                <td class="cellule_table">
                    <?php
                        if ($inventory['last_return_date'] == NULL) {
                            echo 'LOCATION INDISPONIBLE';
                        } else {
                            echo $inventory['last_return_date'];
                        }
                    ?>
                </td>

                <td class="cellule_button">

                    <?php
                        if ($inventory['last_return_date'] == NULL) { ?>
                    <button type="button" class="btn btn btn-outline-secondary btn-action" style="width: 100px;" disabled>
                        <a href="form_reservation.php?film_id=<?php echo $film['film_id'] ?>
                                &inventory_id=<?php echo $inventory['inventory_id']?>"
                            style="text-decoration:none; color:black;">Réserver
                        </a>
                    </button>
                    <?php } else { ?>
                    <button type="button" class="btn btn btn-outline-secondary btn-action" style="width: 100px;">
                        <a href="form_reservation.php?film_id=<?php echo $film['film_id']?>&inventory_id=<?php echo $inventory['inventory_id']?>"
                            style="text-decoration:none; color:black;">Réserver
                        </a>
                    </button>
                    <?php }
                    ?>

                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include("components/footer.php");?>