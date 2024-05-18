<?php
/**
 * @file 328/pets2/index.php
 * @description Simple MVC using the Fat-Free framework. This page holds the controller for the Pets2 assignment.
 * @author Tien Han
 * @version 1.0
 */

    session_start();

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
                        $f3->set('SESSION.petType', $roboticPet);

                        //Redirect to the robotic pet form
                        $f3->reroute("robotic-order");
                    } else {
                        //Stuffed Pests
                        $stuffedPet = new StuffedPet($pet, $color);
                        $f3->set('SESSION.petType', $stuffedPet);

                        //$pet = $f3->get('SESSION.petType');
                        //echo "<pre>";
                        //var_dump($pet);
                        //echo "</pre>\n";

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
        $pet = $f3->get('SESSION.petType');
        echo "<pre>";
        var_dump($pet);
        echo "</pre>\n";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get the submitted form data
            $size = $_POST['size'];
            $material = $_POST['material'];
            $stuffing = $_POST['stuffing'];
            $f3->set('SESSION.size', $size);
            $f3->set('SESSION.material', $material);
            $f3->set('SESSION.stuffing', $stuffing);
            $f3->reroute('summary');
        }

        $view = new Template();
        echo $view->render('views/stuffed-order.html');
    });

    //Robotic order page
    $f3->route('GET|POST /robotic-order', function($f3) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get the submitted form data
            $accessory = $_POST['accessory'];
            $f3->set('SESSION.accessory', $accessory);
            $f3->reroute('summary');
        }

        $view = new Template();
        echo $view->render('views/robotic-order.html');
    });

    //Summary Page
    $f3->route('GET /summary', function() {
        $view = new Template();
        echo $view->render('views/order-summary.html');
    });

    //Run Fat-Free
    $f3->run();
?>