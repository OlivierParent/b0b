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
 * Klasse om het bloedalcoholgehalte te berekenen.
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2012 Artevelde University College Ghent
 */
class BloodAlcoholLevel extends Object\Object
{
    /**
     * Gebruikerobject.
     *
     * @var Model\User
     */
    protected $_user; // Aanspreken met $this->User dankzij klasse Object\Object.
    /**
     * Aantal eenheden alcohol.
     *
     * @var integer
     */
    protected $_units; // Aanspreken met $this->Units dankzij klasse Object\Object.
    /**
     * Aantal uren
     *
     * @var integer
     */
    protected $_hours; // Aanspreken met $this->Hours dankzij klasse Object\Object.

    /**
     * Magische methode voor de constructor.
     *
     * @param Model\User $user
     * @param integer    $units
     * @param integer    $hours
     */
    public function __construct(Model\User $user, $units = 0, $hours = 0)
    {
        $this->User  = $user;
        $this->Units = $units;
        $this->Hours = $hours;
    }

    /**
     * Magische methode die uitgevoerd wordt op het ogenblik dat het object
     * naar een string gecast wordt.
     *
     * @return string
     */
    public function __toString()
    {
        $bal = $this->_calculate();

        if       ($bal <= 0) {
            $bal = 0;
            $nickname = 'Taxi Bob';
            $comment  = 'Je komt zonder problemen veilig thuis.';
        } elseif ($bal <= 0.5) {
            $nickname = 'Risky Bob';
            $comment  = 'Je raakt vast wel thuis zonder al te veel schrammen.';
        } elseif ($bal <= 1.5) {
            $nickname = 'Tipsy ' . ($this->User->Gender == 'm' ? 'Timmy' : 'Trixie');
            $comment  = 'Fun verzekerd &hellip; tot aan de eerste bocht.';
        } elseif ($bal <= 3  ) {
            $nickname = 'Zatte ' . ($this->User->Gender == 'm' ? 'Zjef' : 'Zjulma');
            $comment  = 'Je bent levensmoe als je met deze Bob meerijdt.';
        } elseif ($bal <= 4  ) {
            $nickname = 'Straalbezopen ' . ($this->User->Gender == 'm' ? 'Steven' : 'Stefanie');
            $comment  = 'Je bent safe, ' . ($this->User->Gender == 'm' ? 'hij' : 'ze') . ' vindt de auto toch niet meer terug vanavond.';
        } else {
            $nickname = 'Coma ' . ($this->User->Gender == 'm' ? 'Korneel' : 'Toosje');
            if ($this->Units < 20) {
                $comment = 'Dump de '  . ($this->User->Gender == 'm' ? 'bro' : 'ho'   ) . ' maar in de kofferbak &hellip; samen met de sleutels.';
            } else {
                $comment = 'Tha damn ' . ($this->User->Gender == 'm' ? 'dog' : 'bitch') . ' ain\'t drivin\' no more. 4 like 4evah.';
            }
        }

        // Zie: http://be.php.net/manual/en/function.sprintf.php
        return sprintf('<p>Bloedalcoholgehalte: %.2f ‰.<br>Bobs nickname is: &#8220;<strong>%s</strong>&#8221;!</p><p>%s</p>', $bal, $nickname, $comment);
    }

    /**
     * Berekent het bloedalcoholgehalte (blood alcohol level).
     *
     * @return float
     */
    protected function _calculate()
    {
        // Het deel van het gewicht dat alcohol kan opnemen is geslachtsafhankelijk
        $ratio = ($this->User->Gender == 'm') ? 0.7 : 0.5;

        // Bloedalcoholgehalte berekenen en teruggeven
        return ($this->Units * 10 ) / ($this->User->Weight * $ratio)
             - ($this->Hours - 0.5) * ($this->User->Weight * 0.002 );
    }
}