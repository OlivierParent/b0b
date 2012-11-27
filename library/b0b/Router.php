<?php
namespace b0b;

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
 * Klasse voor de Router. Deze vangt alle informatie op die na index.php in de
 * URL van de pagina staat. Deze info wordt vertaald naar een bestandsnaam,
 * waarna dat bestand geïmporteerd wordt.
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2012 Artevelde University College Ghent
 */
class Router
{
    /**
     * Magische methode voor de constructor.
     */
    public function __construct()
    {
        // REQUEST_URI is de url zoals ingegeven in de browser.
        $request = $_SERVER['REQUEST_URI'];
        // Zie: http://www.php.net/manual/en/function.strpos.php
        if ($pos = strpos($request, '?') ) { // Bepaal de positie van '?' in de url. Na '?' volgen doorgaans de key-value-paren van de get-variabelen.
            // Zie: http://www.php.net/manual/en/function.substr.php
            $request = substr($request, 0, $pos); // Alles vanaf '?' laten vallen.
        }

        // Verwijder zowel '/index.php' en de SCRIPT_NAME-map uit de request.
        // Zie: http://www.php.net/manual/en/function.trim.php
        // Zie: http://www.php.net/manual/en/function.str-replace.php
        // Zie: http://www.php.net/manual/en/function.dirname.php
        $request = trim(str_replace(array('/index.php', dirname($_SERVER['SCRIPT_NAME']) ), '', $request ), '/');

        // Als de request leeg is, gebruik dan de homepagina als request.
        if ($request === '') {
            $request = 'home';
        }

        $request = PATH_PAGE . "{$request}.php";

        // Zie: http://www.php.net/manual/en/function.file-exists.php
        if (!file_exists($request) ) {
            $request = PATH_PAGE . 'error.php';
            $error = new Error('Pagina bestaat niet.', "De pagina <strong>{$request}</strong> bestaat niet");
        }

        // Sessionobject die de sessie afhandeld.
        $session = new \b0b\Session();

        require_once $request;
    }
}