<?php

class films extends database{

    // function get all film and search too
    public function getFilmsAndSearch() {
        $title="";

        if(!isset($_POST['title'])) {
            $title ="";
        } else {
            $title=$_POST['title'];
        }
        
            $sql = "SELECT * FROM film WHERE title LIKE :title ORDER BY title ASC limit 0,15";
            $query = $this->connectDb()->prepare($sql);
            $exec = $query->execute(array(":title"=>$title.'%'));
            
            if($exec) {
                // if title exist 
                // show data in inputs
                if($query->rowCount()>0)
                {
                    $films = $query;
                    // echo 'Data With This title';
                    return $films;
                    }
                    // if the title not exist
                    // show a message and clear inputs
                else {
                    echo 'No Data With This title';
                }
            } else {
                echo 'ERROR Data Not Inserted';
            }
    }

    // function return one film
    public function getOneFilm() {
        $id='';

        if(!isset($_GET['film_id'])) {
            $id ="";
        } else {
            $id=$_GET['film_id'];
        }


        $sql ="SELECT film.film_id, film.title as title, film.description, film.release_year, film.length, 
        film.rating, film.rental_rate, category.name as category
        FROM film
        INNER JOIN film_category ON film.film_id = film_category.film_id
        INNER JOIN category ON film_category.category_id = category.category_id
        WHERE film.film_id=:id";

        // $sql = 'SELECT * FROM film WHERE film_id=:id';
        $query = $this->connectDb()->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch();
    }

    //function return films with rental_date and return_date
    public function getDisponility() {
        $id="";

        if(!isset($_GET['film_id'])) {
            $id ="";
        } else {
            $id=$_GET['film_id'];
        }

        $sql="SELECT film.film_id, film.title, address.address as address, store.store_id as store, inventory.inventory_id as inventory_id
        FROM film
        INNER JOIN inventory ON film.film_id = inventory.film_id
        INNER JOIN store ON inventory.store_id = store.store_id
        INNER JOIN address ON store.address_id = address.address_id
        WHERE film.film_id =:id";

        $query = $this->connectDb()->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $inventories = $query->fetchAll();        

        // foreach ($inventories as $inventory) {
        //     $sql="SELECT * FROM rental WHERE rental.inventory_id =:inventory_id order by rental_date desc limit 1";
        //     $query = $this->connectDb()->prepare($sql);
        //     $query->bindValue(':inventory_id',$inventory['inventory_id'] , PDO::PARAM_INT);
        //     $query->execute();
        //     $lastrental = $query->fetch();
        //     $inventory['last_date_rental'] = $lastrental['rental_date'];
        // }

        $max = sizeof($inventories);
        for($i=0; $i<$max;$i++){
            // get the last rental by inventory
            $sql="SELECT * FROM rental WHERE rental.inventory_id =:inventory_id order by rental_date desc limit 1";
            $query = $this->connectDb()->prepare($sql);
            $query->bindValue(':inventory_id',$inventories[$i]['inventory_id'] , PDO::PARAM_INT);
            $query->execute();
            $lastrental = $query->fetch();

            $inventories[$i]['last_date_rental'] = $lastrental['rental_date'];
            $inventories[$i]['last_return_date'] = $lastrental['return_date'];

        }
        // inventories == disponibility
        return $inventories;
    } 

    // function get films with no return_date and search too
    public function getUnreturnedFilmsAndSearch() {
        $title="";

        if(!isset($_POST['title'])) {
            $title ="";
        } else {
            $title=$_POST['title'];
        }
        
            $sql = "SELECT rental.rental_id, film.film_id, film.title, rental.rental_date, rental.return_date, customer.customer_id, customer.first_name, customer.last_name, inventory.inventory_id, address.address as adress_name
            FROM film 
            INNER JOIN inventory ON film.film_id = inventory.film_id
            INNER JOIN store ON inventory.store_id = store.store_id
            INNER JOIN address ON store.store_id = address.address_id
            INNER JOIN rental ON inventory.inventory_id = rental.inventory_id
            INNER JOIN customer ON rental.customer_id = customer.customer_id
            where rental.return_date is null 
            AND title LIKE :title";

            $query = $this->connectDb()->prepare($sql);
            $exec = $query->execute(array(":title"=>$title.'%'));
            
            if($exec) {
                // if title exist 
                // show data in inputs
                if($query->rowCount()>0)
                {
                    $films = $query;
                    // echo 'Data With This title';
                    return $films;
                    }
                    // if the title not exist
                    // show a message and clear inputs
                else {
                    echo 'No Data With This title';
                }
            } else {
                echo 'ERROR Data Not Inserted';
            }
    }

    
}

?>