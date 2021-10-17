<?php 
include_once "class/dbconfig.php";
$connection = new database;
$connection->connectDb();

include_once "class/films.php";
$query = new films;
$films = $query->getFilmsAndSearch();
// var_dump($films);


include("components/header.php");

?>

<div class="container">
    <h2 class="title_page mt-4">LOCATION DE DVD</h2>

    <!-- searchbar -->
    <form class="d-flex mt-4" name="searchfilm" method="post" action="index.php">
        <input class="form-control me-2" type="text" name="title" placeholder="Rechercher un film...">
        <button class="btn btn-outline-dark" name="Find" type="submit">RECHERCHER</button>
    </form>
</div>


<!-- show films -->
<div class="container">
    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th class="cellule_designation">Titre du film</th>
                <th class="cellule_designation">Description</th>
                <th class="cellule_designation">Disponibilités</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach($films as $film) { ?>

            <tr>
                <td class="cellule_table">
                    <?php echo $film['title']; ?>
                </td>
                <td class="cellule_table">
                    <?php echo $film['description']; ?>
                </td>

                <td class="text-center">
                    <button type="button" class="btn btn-outline-secondary" style="width: 100px;">
                        <a href="list_films_available.php?film_id=<?php echo $film['film_id'] ?>" style="text-decoration:none; color:black;">Voir</a>
                    </button>
                </td>
            </tr>

            <?php } ?>

        </tbody>
    </table>
</div>


<?php include("components/footer.php");?>