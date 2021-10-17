<?php
include_once "class/dbconfig.php";
$connection = new database;
$connection->connectDb();

include_once "class/films.php";
$query = new films;
$unreturnedFilms = $query->getUnreturnedFilmsAndSearch();

include("components/header.php");

?>

<div class="container">
    <h2 class="title_page mt-4"> RETOUR DVD</h2>

    <!-- searchbar -->
    <form class="d-flex mt-4" name="searchfilm" method="post" action="list_unreturned_films.php">
        <input class="form-control me-2" type="text" name="title" placeholder="Rechercher un film...">
        <button class="btn btn-outline-dark" name="Find" type="submit">RECHERCHER</button>
    </form>
</div>



<div class="container">
    <!-- List films return date location -->

    <div class="container">
        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th class="cellule_designation">Titre du film</th>
                    <th class="cellule_designation">Adresse de location</th>
                    <th class="cellule_designation">N° Client</th>
                    <th class="cellule_designation">Nom client</th>
                    <th class="cellule_designation">Prénom Client</th>
                    <th class="cellule_designation">Date de location</th>
                    <th class="cellule_designation">Actions </th>
                </tr>
            </thead>

            <tbody>

                <?php foreach($unreturnedFilms as $unreturnedFilm) { ?>

                <tr>
                    <td class="cellule_table">
                        <?php echo $unreturnedFilm['title']; ?>
                    </td>

                    <td class="cellule_table">
                        <?php echo $unreturnedFilm['adress_name']; ?>
                    </td>

                    <td class="cellule_table">
                        <?php echo $unreturnedFilm['customer_id']; ?>
                    </td>

                    <td class="cellule_table">
                        <?php echo $unreturnedFilm['first_name']; ?>
                    </td>

                    <td class="cellule_table">
                        <?php echo $unreturnedFilm['last_name']; ?>
                    </td>

                    <td class="cellule_table">
                        <?php echo $unreturnedFilm['rental_date']; ?>
                    </td>

                    <td class="cellule_button">
                        <button type="button" class="btn btn-outline-secondary" style="width: 100px;">
                            <a href="form_return_dvd.php?rental_id=<?php echo $unreturnedFilm['rental_id'] ?>&film_id=<?php echo $unreturnedFilm['film_id']?>&inventory_id=<?php echo $unreturnedFilm['inventory_id']?>"
                                style="text-decoration:none; color:black;">Voir</a>
                        </button>
                    </td>
                </tr>

                <?php } ?>

            </tbody>
        </table>
    </div>

</div>

<?php include("components/footer.php");?>