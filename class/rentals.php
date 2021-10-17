<?php

class rentals extends database{

    // function post reservation
    public function postRental() {
        // var_dump($_POST);
        
        if(isset($_POST)) {
            if(isset($_POST['rental_date']) && !empty($_POST['rental_date'])
            && isset($_POST['inventory_id']) && !empty($_POST['inventory_id'])
            && isset($_POST['customer_id']) && !empty($_POST['customer_id'])
            // && isset($_POST['return_date']) && !empty($_POST['return_date'])
            && isset($_POST['staff_id']) && !empty($_POST['staff_id'])
            ) {
                $rental_date=$_POST['rental_date'];
                $inventory_id=$_POST['inventory_id'];
                $customer_id=$_POST['customer_id'];
                // $return_date=$_POST['return_date'];
                $staff_id=$_POST['staff_id'];


                $sql= "INSERT INTO rental (`rental_date`, `inventory_id`, `customer_id`, `staff_id`)
                VALUES (:rental_date,:inventory_id, :customer_id, :staff_id)";
                $query= $this->connectDb()->prepare($sql);

                $query->bindValue(':rental_date', $rental_date, PDO::PARAM_STR);
                $query->bindValue(':inventory_id', $inventory_id, PDO::PARAM_INT);
                $query->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);
                // $query->bindValue(':return_date', $return_date, PDO::PARAM_STR);
                $query->bindValue(':staff_id', $staff_id, PDO::PARAM_INT);

                $query->execute();
                
                echo 'success';
                // var_dump($query->errorCode());
            }
        }
    }

    public function getValueRental() {
        $rental_id='';

        if(!isset($_GET['rental_id'])) {
            $rental_id ="";
        } else {
            $rental_id=$_GET['rental_id'];
        }

        $sql="SELECT rental.staff_id, rental.customer_id, customer.first_name, customer.last_name, rental.rental_date, rental.return_date
        FROM rental
        INNER JOIN customer ON rental.customer_id = customer.customer_id
        WHERE  rental.rental_id=:rental_id";
        $query= $this->connectDb()->prepare($sql);
        $query->bindValue(':rental_id', $rental_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch();
    }

    // function update form reervation
    public function updateRental(){
        // var_dump($_POST);
        // var_dump($_GET);

        if(isset($_GET) && isset($_POST)) {
            if(isset($_GET['rental_id']) && !empty($_GET['rental_id'])
            && isset($_POST['return_date']) && !empty($_POST['return_date'])
            ) {
                $rental_id=$_GET['rental_id'];
                $return_date=$_POST['return_date'];

                $sql= "UPDATE rental SET rental.return_date=:return_date WHERE rental.rental_id=:rental_id";
                $query= $this->connectDb()->prepare($sql);
                $query->bindValue(':rental_id', $rental_id, PDO::PARAM_INT);
                $query->bindValue(':return_date', $return_date, PDO::PARAM_STR);
                $query->execute();
                
                echo 'success';
                
            }
        }
    }
}

?>

<!-- si return_date est vide, alors le film ne peut être en location -->
