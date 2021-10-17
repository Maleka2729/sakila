<?php
include_once "class/dbconfig.php";
$connection = new database;
$connection->connectDb();

include_once "class/films.php";
$query = new films;
$film = $query->getOneFilm();

include_once "class/users.php";
$query = new users;
$customers = $query->getClients();
$staffs = $query->getStaffs();

include_once "class/rentals.php";
$query = new rentals;
$return_value_rental = $query->getValueRental();
$query->updateRental();
// var_dump($query);

include("components/header.php");

?>

<div class="container">

    <div class="row justify-content-around">
        <div class="col-5 mt-4">

            <!-- Info films -->
            <div class="row mt-3">
                <h2 class="title_page text-center mt-3 mb-3"> Informations du film</h2>

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-center">Titre </h5>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $film["title"]; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-center">Categorie </h5>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $film['category']; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5 class="text-center">Description </h5>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $film['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <h5 class="text-center">Année de sortie </h5>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $film['release_year']; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-center">Durée</h5>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $film['length']; ?> min
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">


                    <div class="col-md-6">
                        <h5 class="text-center">Evaluation</h5>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $film['rating']; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-center">Prix de location</h5>
                        <div class="card">
                            <div class="card-body">
                                <?php echo $film['rental_rate']; ?> $
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-5 mt-5">
            <!-- form return dvd -->

            <form class="row g-3 needs-validation mt-4 mb-4" action="#" method="post"
                style="border: 1mm solid black;  padding: 0 4%;">
                <h3 class="title_center text-center mt-3 mb-2"> Formulaire de réservation</h3>
                <div class="row mt-3">
                    <div class="col-md-12 position-relative">
                        <label for="validationTooltip02" class="form-label">Enregistré par </label>
                        <div class="card">
                            <span class="card-body"> <?php echo $return_value_rental['staff_id']; ?> </span>
                        </div>
                    </div>
                </div>



                <div class="col-md-4 position-relative">
                    <label for="validationTooltip02" class="form-label">N° client</label>
                    <div class="card">
                        <span class="card-body"> <?php echo $return_value_rental['customer_id']; ?> </span>
                    </div>
                </div>

                <div class="col-md-4 position-relative">
                    <label for="validationTooltip02" class="form-label">Nom du client</label>
                    <div class="card">
                        <span class="card-body"> <?php echo $return_value_rental['last_name']; ?> </span>
                    </div>
                </div>

                <div class="col-md-4 position-relative">

                    <label for="validationTooltip02" class="form-label">Prénom du client</label>
                    <div class="card">
                        <span class="card-body"> <?php echo $return_value_rental['first_name']; ?> </span>
                    </div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="validationTooltip04" class="form-label">Date de location</label>

                    <div class="card">
                        <span class="card-body"> <?php echo $return_value_rental['rental_date'] ?> </span>
                    </div>

                </div>

                <div class="col-md-6 position-relative">
                    <label for="validationTooltip05" class="form-label">Date de retour</label>
                    <input type="text" class="form-control" id="validationTooltip05" data-date-format="yyyy/mm/dd"
                        name="return_date" placeholder="yyyy-mm-dddd" style="height:58px;" required>
                </div>

                <input type="hidden" id="film_id" name="film_id" value="<?php echo $_GET['film_id'] ?>">
                <input type="hidden" id="inventory_id" name="inventory_id" value="<?php echo $_GET['inventory_id'] ?>">

                <div class="col-12 mb-5">
                    <button class="btn btn-outline-primary" type="submit" style="width: 100%; ">Submit form</button>
                </div>


            </form>
        </div>
    </div>




</div>




<?php include("components/footer.php");?>