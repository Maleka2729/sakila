<?php
include_once "class/dbconfig.php";
$connection = new database;
$connection->connectDb();

include_once "class/films.php";
$query = new films;
$film = $query->getOneFilm();
$inventories = $query->getDisponility();

include_once "class/users.php";
$query = new users;
$customers = $query->getClients();
$staffs = $query->getStaffs();

include_once "class/rentals.php";
$query = new rentals;
$query->postRental();
// var_dump($query);

include("components/header.php");

?>

<div class="container">

    <div class="row justify-content-around">
        <div class="col-5">
            <!-- Info films -->
            <div class="row mt-3">
                <h2 class="title_page text-center mt-3 mb-3"> Informations du film</h2>

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-center" >Titre </h5>
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

        <!-- form reservation -->
        <div class="col-5 mt-5">

            <form class="row g-3 needs-validation mt-4 mb-4" action="#" method="post" style="border: 1mm solid black; padding: 0 4%;">
                <h3 class="title_center text-center mt-3 mb-2"> Formulaire de réservation</h3>
                <div class="row mt-3 mb-3">
                    <div class="col-md-12 position-relative">
                        <label for="validationTooltip02" class="form-label">Enregistré par</label>
                        <select name="staff_id" class="form-select" aria-label="Default select example">
                            <option disabled selected hidden> Id staff n° </option>
                            <?php foreach ($staffs as $staff) { ?>
                            <option value="<?php echo $staff['staff_id']; ?>"> <?php echo $staff['staff_id']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 position-relative">
                    <label for="validationTooltip02" class="form-label">N° client</label>
                    <select name="customer_id" class="form-select" aria-label="Default select example">
                        <option disabled selected hidden> N° </option>
                        <?php foreach ($customers as $customer) { ?>
                        <option value="<?php echo $customer['customer_id']; ?> ">
                            <?php echo $customer['customer_id']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-4 position-relative">
                    <label for="validationTooltip02" class="form-label">Nom du client</label>
                    <select class="form-select" aria-label="Default select example">
                        <option disabled selected hidden>Nom </option>
                        <?php foreach ($customers as $customer) { ?>
                        <option name="last_name"> <?php echo $customer['last_name']; ?> </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-4 position-relative">
                    <label for="validationTooltip02" class="form-label">Prénom du client</label>
                    <select class="form-select" aria-label="Default select example">
                        <option disabled selected hidden>Prénom</option>
                        <?php foreach ($customers as $customer) { ?>
                        <option name="first_name"> <?php echo $customer['first_name']; ?> </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="validationTooltip04" class="form-label">Date de location</label>
                    <input type="text" class="form-control" id="validationTooltip03" data-date-format="yyyy/mm/dd"
                        name="rental_date" placeholder="yyyy-mm-dddd" required>
                    <div class="invalid-tooltip">
                        Please choose a valid date.
                    </div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="validationTooltip05" class="form-label">Date de retour <small>(facultative)
                        </small></label>
                    <input type="text" class="form-control" id="validationTooltip05" data-date-format="yyyy/mm/dd"
                        name="return_date" placeholder="yyyy-mm-dddd">
                    <div class="invalid-tooltip">
                        Please choose a valid date.
                    </div>
                </div>

                <input type="hidden" id="film_id" name="film_id" value="<?php echo $_GET['film_id'] ?>">
                <input type="hidden" id="inventory_id" name="inventory_id" value="<?php echo $_GET['inventory_id'] ?>">

                <div class="col-12 mb-5">
                    <button class="btn btn-outline-primary" type="submit" style="width: 100%;">Submit form</button>
                </div>


            </form>
        </div>
    </div>





</div>




<?php include("components/footer.php");?>