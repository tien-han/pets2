<?php
/**
 * 328/pets2/index.php
 * Simple MVC using the Fat-Free framework.
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
                //Data is invalid
                echo "Please supply a pet type";
            } else {
                if (empty($color)) {
                    //data is invalid
                    echo "Please supply a pet color";
                } else {
                    //Data is valid
                    $f3->set('SESSION.pet', $pet);
                    //Add the color to the session
                    $f3->set('SESSION.color', $color);

                    //Redirect to the summary route
                    $f3->reroute("summary");
                }
            }
        }

        $view = new Template();
        echo $view->render('views/pet-order.html');
    });

    //Run Fat-Free
    $f3->run();
?>