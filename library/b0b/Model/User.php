<?php
namespace b0b\Model;

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
 * Klasse voor een gebruiker.
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2012 Artevelde University College Ghent
 */
class User extends \b0b\Object\Object
{
    /**
     * Id van de gebruiker.
     *
     * @var integer
     */
    protected $_id;         // Aanspreken met $this->Id dankzij klasse \b0b\Object\Object.

    /**
     * Voornaam van de gebruiker.
     *
     * @var string
     */
    protected $_givenname;  // Aanspreken met $this->Givenname dankzij klasse \b0b\Object\Object.

    /**
     * Familienaam van de gebruiker.
     *
     * @var string
     */
    protected $_familyname; // Aanspreken met $this->Familyname dankzij klasse \b0b\Object\Object.

    /**
     * E-mail van de gebruiker.
     *
     * @var string
     */
    protected $_email;      // Aanspreken met $this->Email dankzij klasse \b0b\Object\Object.

    /**
     * Wachtwoord van de gebruiker.
     *
     * @var string
     */
    protected $_password;   // Aanspreken met $this->Password dankzij klasse \b0b\Object\Object.

    /**
     * Geslacht van de gebruiker.
     *
     * @var string
     */
    protected $_gender;     // Aanspreken met $this->Gender dankzij klasse \b0b\Object\Object.

    /**
     * Lichaamsgewicht van de gebruiker in kg.
     *
     * @var float
     */
    protected $_weight;     // Aanspreken met $this->Weight dankzij klasse \b0b\Object\Object.

    /**
     * Magische methode voor de constructor.
     *
     * @param mixed $gender
     * @param float $weight
     */
    public function __construct($gender = null, $weight = null)
    {
        $this->Gender = $gender;
        $this->Weight = $weight;
    }

    /**
     * Setter om het wachtwoord versleuteld op te slaan.
     *
     * @param string $password
     */
    public function setPasswordRaw($password)
    {
        $this->Password = \b0b\Utility::hash($password);
    }
}