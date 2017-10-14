<?php

    require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

    require_once(LIBRARY_PATH . "/templateFunctions.php");
    require_once(LIBRARY_PATH . "/database.php");
    require_once(LIBRARY_PATH . "/auth.php");
    require_once(LIBRARY_PATH . "/user.php");

    /*
        Now you can handle all your php logic outside of the template
        file which makes for very clean code!
    */

    $setInIndexDotPhp = "Hey! I was set in the index.php file.";

    // Must pass in variables (as an array) to use in template
    $variables = array(
        'setInIndexDotPhp' => $setInIndexDotPhp
    );

session_clear();
    // authorization('Фамилия Имя', '12345');

    // user_create('Фамилия Имя', '12345');
    // echo var_dump(user_fetch_with_password('Фамилия Имя', '123415'));

    renderLayoutWithContentFile("home.php", $variables);

?>
