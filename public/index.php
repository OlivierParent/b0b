<?php
/******************************************************************************
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *                        aaaAAaaa            HHHHHH                          *
 *                     aaAAAAAAAAAAaa         HHHHHH                          *
 *                    aAAAAAAAAAAAAAAa        HHHHHH                          *
 *                   aAAAAAAAAAAAAAAAAa       HHHHHH                          *
 *                   aAAAAAa    aAAAAAA                                       *
 *                   AAAAAa      AAAAAA                                       *
 *                   AAAAAa      AAAAAA                                       *
 *                   aAAAAAa     AAAAAA                                       *
 *                    aAAAAAAaaaaAAAAAA       HHHHHH                          *
 *                     aAAAAAAAAAAAAAAA       HHHHHH                          *
 *                      aAAAAAAAAAAAAAA       HHHHHH                          *
 *                         aaAAAAAAAAAA       HHHHHH                          *
 *                                                                            *
 *                                                                            *
 *                                                                            *
 *      a r t e v e l d e  u n i v e r s i t y  c o l l e g e  g h e n t      *
 *                                                                            *
 *                                                                            *
 *                                 MEMBER OF GHENT UNIVERITY ASSOCIATION      *
 *                                                                            *
 *                                                                            *
 ******************************************************************************
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2012 Artevelde University College Ghent
 */

$codepath = dirname($_SERVER['SCRIPT_FILENAME']);
// Alternatieve manier om een constante te definiëren, laat dynamische content toe.
define('PATH_CONFIG' , $codepath . '/../application/config/'  );
define('PATH_LIBRARY', $codepath . '/../library/'             );
define('PATH_PAGE'   , $codepath . '/../application/src/page/');
define('BASEPATH'    , dirname($_SERVER['SCRIPT_NAME']) . '/' );
//Gewone manier van constanten definiëren.
const DEBUG = false;

error_reporting(E_ALL);

/**
 * Globale functie om klasses automatisch in te laden.
 *
 * @param string $class
 * @throws ErrorException
 */
function __autoload($class)
{
    $filename = str_replace('\\', '/', $class);
    $filename = PATH_LIBRARY . "{$filename}.php";
    if (file_exists($filename)) {
        require_once $filename;
    } else {
        throw new ErrorException("Class <strong>{$class}</strong> does not exist.");
    }
}

// Router object that transfers the browser to the right page.
new \b0b\Router();