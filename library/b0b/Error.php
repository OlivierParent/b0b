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
 * Klasse voor foutmeldingen.
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2012 Artevelde University College Ghent
 */
class Error extends Object\Object
{
    /**
     * Titel van de foutmelding.
     *
     * @var string
     */
    protected $_title; // Aanspreken met $this->Title dankzij klasse Object\Object.
    /**
     * Boodschap van de foutmelding.
     *
     * @var string
     */
    protected $_message; // Aanspreken met $this->Message dankzij klasse Object\Object.

    /**
     * Magische methode voor de constructor.
     *
     * @param string $title
     * @param string $message
     */
    public function __construct($title = null, $message = null)
    {
        $this->Title   = $title;
        $this->Message = $message;
    }

    /**
     * Magische methode die uitgevoerd wordt op het ogenblik dat het object
     * naar een string gecast wordt.
     *
     * @return string
     */
    public function __toString()
    {
        return "<div class=\"box style-d\"><h2>{$this->Title}</h2><p>\n{$this->Message}</p></div>";
    }
}