<?php
namespace Framework\Core;

/**
 * This is the base controller class which will get extended by all the
 * controller classes.
 */
namespace Framework\Core;

class Controller {

    public function renderView($view, $data = []) {
        // Extract data to variables
        extract($data);

        // Get the absolute path to the views directory
        $viewsDirectory = realpath(__DIR__ . '/../views');

        if ($viewsDirectory === false) {
            die("Views directory not found.");
        }

        // Construct the full path to the view file
        $file = $viewsDirectory . DIRECTORY_SEPARATOR . $view . '.php';

        // Check if the view file exists
        if (file_exists($file)) {
            include $file;
        } else {
            die("View file not found: $file");
        }
    }
}
