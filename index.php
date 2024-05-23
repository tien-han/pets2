<?php
/**
 * @file 328/pets2/index.php
 * @description Simple MVC using the Fat-Free framework. This page holds the controller for the Pets2 assignment.
 * @author Tien Han
 * @version 1.0
 */

    //Fat Free gives us session_start()
    //If we use it, we have to use it after autoload/classes
    //session_start();

    //Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //Require the autoload file
    require_once('vendor/autoload.php');
    require_once('classes/pet.php');
    require_once('classes/robotic-pet.php');
    require_once('classes/stuffed-pet.php');

    //Instantiate the F3 Base class (Fat-Free)
    $f3 = Base::instance();

    //Define a default route
    $f3->route('GET /', function() {
        //Render a view page
        $view = new Template();
        echo $view->render('views/home.html');
    });

    //Order Page
    $f3->route('GET|POST /order', function($f3) {
        //Check if the form has been posted (submit button clicked)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get the submitted form data
            $pet = $_POST['pet'];
            $color = $_POST['color'];

            //Validate the form data
            if (empty($pet)) {
                //Data is invalid for pet
                echo "Please supply a pet type";
            } else {
                if (empty($color)) {
                    //Data is invalid for color
                    echo "Please supply a pet color";
                } else {
                    $type = $_POST['pet_type'];

                    if ($type == "robotic") {
                        //Robotic Pets
                        $roboticPet = new RoboticPet($pet, $color);
                        $f3->set('SESSION.pet', $roboticPet);

                        //Redirect to the robotic pet form
                        $f3->reroute("robotic-order");
                    } else {
                        //Stuffed Pests
                        $stuffedPet = new StuffedPet($pet, $color);
                        $f3->set('SESSION.pet', $stuffedPet);

                        //Redirect to the stuffed pet form
                        $f3->reroute("stuffed-order");
                    }
                }
            }
        }

        $view = new Template();
        echo $view->render('views/pet-order.html');
    });

    //Stuffed order page
    $f3->route('GET|POST /stuffed-order', function($f3) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get and save the submitted form data
            $f3->get('SESSION.pet')->setSize($_POST['size']);
            $f3->get('SESSION.pet')->setMaterial($_POST['material']);
            $f3->get('SESSION.pet')->setStuffingType($_POST['stuffing']);
            $f3->reroute('summary');
        }

        $view = new Template();
        echo $view->render('views/stuffed-order.html');
    });

    //Robotic order page
    $f3->route('GET|POST /robotic-order', function($f3) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $f3->get('SESSION.pet')->setAccessories($_POST['accessories']);
            $f3->reroute('summary');
        }

        $view = new Template();
        echo $view->render('views/robotic-order.html');
    });

    //Summary Page
    $f3->route('GET /summary', function($f3) {
        $pet = $f3->get('SESSION.pet');
        echo "<pre>";
        var_dump($pet);
        echo "</pre>\n";

        $view = new Template();
        echo $view->render('views/order-summary.html');
        //session_destroy();
    });


    //Run Fat-Free
    $f3->run();
?>