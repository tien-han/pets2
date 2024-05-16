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
                    ////Data is valid for pet and color
                    //$f3->set('SESSION.pet', $pet);
                    ////Add the color to the session
                    //$f3->set('SESSION.color', $color);

                    $type = $_POST['pet_type'];
                    $petType = "";
                    if ($type == "robotic") {
                        $petType = new RoboticPet($pet, $color);
                    } else {
                        $petType = new StuffedPet($pet, $color);
                    }
                    $this->_f3->set('SESSION.petType', $petType);

                    //Redirect to the summary route
                    $f3->reroute("summary");
                }
            }
        }

        $view = new Template();
        echo $view->render('views/pet-order.html');
    });

    //Summary Page
    $f3->route('GET /summary', function() {
        $view = new Template();
        echo $view->render('views/order-summary.html');
    });

    //Run Fat-Free
    $f3->run();
?>