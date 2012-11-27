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
 * Abstracte klasse met statische utilitymethodes.
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2012 Artevelde University College Ghent
 */
abstract class Utility
{
    /**
     * Drukt debuginformatie af.
     *
     * @static
     * @param array $superglobals
     * @return null
     */
    public static function debug($superglobals = array() )
    {
        if (!DEBUG) return; // als DEBUG == true: stop de methode

        if (empty($superglobals) ) {
            if (!empty($_GET)    ) {
                $superglobals['GET'    ] = $_GET;
            }
            if (!empty($_POST)   ) {
                $superglobals['POST'   ] = $_POST;
            }
            if (isset($_SESSION) ) {
                $superglobals['SESSION'] = $_SESSION;
            }
            if (isset($_COOKIE)  ) {
                $superglobals['COOKIE' ] = $_COOKIE;
            }
            if (!empty($_SERVER)  ) {
                $superglobals['SERVER' ] = $_SERVER;
            }
        }
        echo "<pre>\n";
        foreach ($superglobals as $key => $value) {
            echo $key . ' ';
            echo var_dump($value);
            echo '<br>';
        }
        echo '</pre>';
    }

    /**
     * Bereken een hash-code voor een karakterstring op basis van de HMAC-methode.
     * Indien geen $algo opgegeven wordt, dan wordt de SHA-256 (Secure Hash
     * Algorithm 256-bit) gebruikt om een hash-code met 64 tekens te genereren.
     *
     * @static
     * @param string  $data
     * @param string  $algo
     * @param boolean $timed
     * @return string
     */
    public static function hash($data, $algo = 'sha256', $timed = false)
    {
        $key = 'Dit wordt nooit geraden!'; // Dit maakt de hash-code uniek voor deze toepassing, voorkomt aanvallen d.m.v. Rainbow Tables (http://nl.wikipedia.org/wiki/Rainbow_table)

        if ($timed) {
            // Zie: http://www.php.net/manual/en/function.microtime.php
            $key .= microtime();
        }
        // Zie: http://www.php.net/manual/en/function.hash-hmac.php
        return hash_hmac($algo, $data, $key); // Hash-based Message Authentication Code
    }

    /**
     * Vinkt een checkbox aan.
     *
     * @static
     * @param string $variable
     * @param string $value
     */
    public static function isChecked($variable, $value)
    {
        echo $variable == $value ? ' checked' : '';
    }

    /**
     * Selecteert een radiobutton of selectoptie.
     *
     * @static
     * @param string $variable
     * @param string $value
     */
    public static function isSelected($variable, $value)
    {
        echo $variable == $value ? ' selected' : '';
    }

    /**
     * Stuur de browser door naar een andere pagina.
     *
     * @static
     * @param string $url
     */
    public static function redirect($url)
    {
        // OPGELET: moet altijd voor de output - naar HTML bijv. - staan, want anders is er reeds een header doorgestuurd.
        // Zie: http://www.php.net/manual/en/function.header.php
        @header("Location: {$url}") && exit; // @ onderdrukt foutmelding 'headers already sent' en stopt dan de code niet.
    }

    /**
     * Geeft de tijd terug in seconden volgens aantal dagen.
     * Huidige tijd + (dagen * 24 uur * 60 minuten * 60 seconden)
     *
     * @static
     * @param integer $days
     * @return integer
     */
    public static function timeInDays($days = 0)
    {
        // Zie: http://www.php.net/manual/en/function.time.php
        return time() + 60 * 60 * 24 * $days;
    }
}