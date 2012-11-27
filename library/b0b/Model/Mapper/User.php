<?php
namespace b0b\Model\Mapper;

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
 * Klasse voor ModelMapper voor een gebruiker.
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2012 Artevelde University College Ghent
 */
class User extends ModelMapper
{
    /**
     * Voeg een nieuwe gebruiker toe aan de database.
     *
     * @param \b0b\Model\User $user
     * @return integer
     * @throws \Exception
     * @throws \ErrorException
     */
    public function create(\b0b\Model\User $user)
    {
        // SQL-statement.
        $sql = 'INSERT INTO users '
             . '(user_givenname, user_familyname, user_email, user_password, user_gender, user_weight) '
             . 'VALUES (:givenname, :familyname, :email, :password, :gender, :weight)';

        // Als het prepared statement gelukt is:
        if ($stmt = $this->Db->prepare($sql) ) {

            // Bind de variabelen aan het prepared statement.
            $stmt->bindValue(':givenname' , $user->Givenname ); // Waarde nu binden.
            $stmt->bindValue(':familyname', $user->Familyname); // Waarde nu binden.
            $stmt->bindValue(':email'     , $user->Email     ); // Waarde nu binden.
            $stmt->bindValue(':password'  , $user->Password  ); // Waarde nu binden.
            $stmt->bindValue(':gender'    , $user->Gender    ); // Waarde nu binden.
            $stmt->bindValue(':weight'    , $user->Weight    ); // Waarde nu binden.

            // Voer het prepared statement uit.
            if ($stmt->execute() ) {
                // Geeft de waarde terug van de AUTO_INCREMENT kolom van de laatst ingevoegde rij.
                return $this->Db->lastInsertId();
            }
            throw new \Exception('Could not create user');
        }
        throw new \ErrorException('Unexpected error');
    }

    /**
     * Haal alle rijen op uit de tabel 'users'.
     *
     * @return array
     * @throws \ErrorException
     */

    public function readAll()
    {
        // SQL-statement.
        $sql = 'SELECT * '
             . 'FROM users';

        // Als de query gelukt is:
        if ($rows = $this->Db->query($sql) ) {
            return $rows;
        }
        throw new \ErrorException('Unexpected error');
    }

    /**
     * Meld een gebruiker aan en vul de gegevens aan.
     *
     * @param \b0b\Model\User $user
     * @return \b0b\Model\User
     * @throws \Exception
     * @throws \ErrorException
     */
    public function readAuthenticate(\b0b\Model\User $user)
    {
        // SQL-statement.
        $sql = 'SELECT user_id, user_givenname, user_familyname, user_gender, user_weight '
             . 'FROM users '
             . 'WHERE '
             . 'user_email    = :email AND '
             . 'user_password = :password '
             . 'LIMIT 1';

        // Als het prepared statement gelukt is:
        if ($stmt = $this->Db->prepare($sql) ) {
            // De variabelen binden aan de parameters in het SQL-statement.
            $stmt->bindValue(':email'   , $user->Email   ); // Waarde nu binden.
            $stmt->bindValue(':password', $user->Password); // Waarde nu binden.

            // Bind de kolommen uit het resultaat aan variabelen.
            $stmt->bindColumn('user_id'        , $user_id        );
            $stmt->bindColumn('user_givenname' , $user_givenname );
            $stmt->bindColumn('user_familyname', $user_familyname);
            $stmt->bindColumn('user_gender'    , $user_gender    );
            $stmt->bindColumn('user_weight'    , $user_weight    );

            // Voer het prepared statement uit.
            if ($stmt->execute() ) {
                // Als er één rij uit het resultaat van het SQL-statement opgehaald is:
                if ($stmt->fetch() ) {
                    if (0 < $user_id) {
                        $user = new \b0b\Model\User();
                        $user->Id         = $user_id        ;
                        $user->Givenname  = $user_givenname ;
                        $user->Familyname = $user_familyname;
                        $user->Gender     = $user_gender    ;
                        $user->Weight     = $user_weight    ;

                        return $user;
                    }
                }
            }
            throw new \Exception("Could not authenticate user <strong>{$user->Email}</strong>");
        }
        throw new \ErrorException('Unexpected error');
    }

    /**
     * Haal de gebruiker op met een bepaalde lastLoginId.
     *
     * @param string $lastLoginId
     * @return \b0b\Model\User
     * @throws \Exception
     * @throws \ErrorException
     */
    public function readLastLogin($lastLoginId)
    {
        // SQL-statement
        $sql = 'SELECT user_id, user_givenname, user_familyname, user_gender, user_weight '
             . 'FROM users '
             . 'WHERE '
             . 'user_lastloginid = :lastLoginId';

        // Als het prepared statement gelukt is:
        if ($stmt = $this->Db->prepare($sql) ) {
            // De variabele binden aan de parameter in het SQL-statement.
            $stmt->bindValue(':lastLoginId', $lastLoginId); // Waarde nu binden.

            // Bind de kolommen uit het resultaat aan variabelen.
            $stmt->bindColumn('user_id'        , $user_id        );
            $stmt->bindColumn('user_givenname' , $user_givenname );
            $stmt->bindColumn('user_familyname', $user_familyname);
            $stmt->bindColumn('user_gender'    , $user_gender    );
            $stmt->bindColumn('user_weight'    , $user_weight    );

            // Voer het prepared statement uit.
            if ($stmt->execute() ) {
                // Als er één rij uit het resultaat van het SQL-statement opgehaald is:
                if ($stmt->fetch() ) {
                    if (0 < $user_id) {
                        $user = new \b0b\Model\User();
                        $user->Id         = $user_id        ;
                        $user->Givenname  = $user_givenname ;
                        $user->Familyname = $user_familyname;
                        $user->Gender     = $user_gender    ;
                        $user->Weight     = $user_weight    ;

                        return $user;
                    }
                }
            }
            throw new \Exception("Could not find user with lastLoginId <strong>{$lastLoginId}</strong>");
        }
        throw new \ErrorException('Unexpected error');
    }

    /**
     * Update de gebruiker met de laatste login ID.
     *
     * @param \b0b\Model\User $user
     * @return string $lastLoginId
     * @throws \Exception
     * @throws \ErrorException
     */
    public function updateLastLogin(\b0b\Model\User $user)
    {
        // SQL-statement.
        $sql = 'UPDATE users '
             . 'SET '
             . 'user_lastloginid = :lastLoginId '
             . 'WHERE '
             . 'user_id = :id';

        // Als het prepared statement gelukt is:
        if ($stmt = $this->Db->prepare($sql) ) {

            // De variabelen binden aan het parameters in het nieuw SQL-statement.
            $stmt->bindParam(':lastLoginId', $lastLoginId); // Waarde binden bij uitvoeren prepared statement.
            $stmt->bindValue(':id'         , $user->Id   ); // Waarde nu binden.

            $lastLoginId = \b0b\Utility::hash($user->Id, 'md5', true ); // Bereken een hash-code van 32 tekens gebaseerd op MD5 (Message Digest Algoritm 5).

            // Voer het prepared statement uit.
            if ($stmt->execute() ) {
                return $lastLoginId;
            }
            throw new \Exception('Could not update lastLoginId of user');
        }
        throw new \ErrorException('Unexpected error');
    }
}