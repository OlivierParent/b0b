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
 * Klasse voor Sessiebeheer.
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2012 Artevelde University College Ghent
 */
class Session
{
    /**
     * Om verwarring met andere gegevens in de sessie te vermijden.
     */
    const PREFIX        = 'b0b-user-';

    /**
     * Om overal dezelfde naam te gebruiken.
     */
    const LAST_LOGIN_ID = 'b0b-user-lastLoginId';

    /**
     * Magische methode voor de constructor.
     */
    public function __construct()
    {
        // Start of hervat de sessie, zie: http://olivierparent.be/courses/php/webpaginas/sessies/
        session_start();

        $this->_autoLogin();
    }

    /**
     * Sessie verwijderen.
     */
    public function destroy()
    {
        // Sessie verwijderen, zie: http://olivierparent.be/courses/php/webpaginas/sessies/
        session_destroy(); // Sessie vernietigen, maar $_SESSION blijft in geheugen tot volgende page load
        $_SESSION = null;  // $_SESSION leegmaken
    }

    /**
     * Methode om de gebruiker automatisch in te loggen.
     */
    protected function _autoLogin()
    {
        if (!$this->hasLoginId() && isset($_COOKIE) && isset($_COOKIE[self::LAST_LOGIN_ID]) ) {
            $lastLoginId = $_COOKIE[self::LAST_LOGIN_ID];
            $this->createLoginId($lastLoginId);

            $userMapper = new \b0b\Model\Mapper\User();
            $user = $userMapper->readLastLogin($lastLoginId);
            $this->createUser($user);
        }
    }

    /**
     * Automatisch inloggen aanzetten.
     *
     * @param string $lastLoginId
     */
    public function enableAutoLogin($lastLoginId)
    {
        // Een cookie aanmaken met de naam 'bob-id' en als inhoud de waarde van $lastLoginId dat over 14 dagen vervalt
        // Zie: http://www.php.net/manual/en/function.setcookie.php
        setcookie(self::LAST_LOGIN_ID, $lastLoginId, \b0b\Utility::timeInDays(14), '/');
    }

    /**
     * Automatisch inloggen afzetten.
     */
    public function disableAutoLogin()
    {
        // Cookie verwijderen
        if (isset($_COOKIE) && isset($_COOKIE[self::LAST_LOGIN_ID]) ) {
            unset($_COOKIE[self::LAST_LOGIN_ID]);
            // Zie: http://www.php.net/manual/en/function.setcookie.php
            setcookie(self::LAST_LOGIN_ID, null, -1, '/');
        }
    }

    /**
     * Sla de gebruikergegevens op in de sessie.
     *
     * @param \b0b\Model\User $user
     */
    public function createUser(\b0b\Model\User $user)
    {
        $_SESSION[self::PREFIX . 'givenname' ] = $user->Givenname ;
        $_SESSION[self::PREFIX . 'familyname'] = $user->Familyname;
        $_SESSION[self::PREFIX . 'email'     ] = $user->Email     ;
        $_SESSION[self::PREFIX . 'gender'    ] = $user->Gender    ;
        $_SESSION[self::PREFIX . 'weight'    ] = $user->Weight    ;
    }

    /**
     * Haal de gebruiker op uit de sessie.
     *
     * @return \b0b\Model\User
     */
    public function readUser()
    {
        $user = new \b0b\Model\User();
        if (isset($_SESSION[self::PREFIX . 'givenname' ]) )  {
            $user->Givenname  = $_SESSION[self::PREFIX . 'givenname' ];
        }
        if (isset($_SESSION[self::PREFIX . 'familyname']) ) {
            $user->Familyname = $_SESSION[self::PREFIX . 'familyname'];
        }
        if (isset($_SESSION[self::PREFIX . 'email'     ]) ) {
            $user->Email      = $_SESSION[self::PREFIX . 'email'     ];
        }
        if (isset($_SESSION[self::PREFIX . 'gender'    ]) ) {
            $user->Gender     = $_SESSION[self::PREFIX . 'gender'    ];
        }
        if (isset($_SESSION[self::PREFIX . 'weight'    ]) ) {
            $user->Weight     = $_SESSION[self::PREFIX . 'weight'    ];
        }

        return $user;
    }

    /**
     * Sla een lastLoginId op in de sessie.
     *
     * @param string $lastLoginId
     */
    public function createLoginId($lastLoginId = null)
    {
        if ($lastLoginId == null) {
            // Zie: http://www.php.net/manual/en/function.session-id.php
            $lastLoginId = session_id();
        }

        $_SESSION[self::LAST_LOGIN_ID] = $lastLoginId;
    }

    /**
     * Controleren of de gebruiker een loginId in de sessie heeft.
     *
     * @return boolean
     */
    public function hasLoginId()
    {
        return isset($_SESSION) && isset($_SESSION[self::LAST_LOGIN_ID]);
    }
}