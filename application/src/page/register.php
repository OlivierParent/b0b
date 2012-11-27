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

// Als superglobal $_POST bestaat (isset()) en als vervolgens (and: &&) ook $_POST['button-register'] bestaat:
if (isset($_POST) && isset($_POST['button-register']) ) {

    // Als alle variabelen (and: &&) niet (!) leeg (empty()) zijn:
    if (!empty($_POST['givenname'   ]) &&
        !empty($_POST['familyname'  ]) &&
        !empty($_POST['email'       ]) &&
        !empty($_POST['password-raw']) && $_POST['password-raw'] === $_POST['password-repeat'] &&
        !empty($_POST['gender'      ]) &&
        !empty($_POST['weight'      ])
    ) {

        $user = new \b0b\Model\User();
        $user->Givenname   = $_POST['givenname'   ];
        $user->Familyname  = $_POST['familyname'  ];
        $user->Email       = $_POST['email'       ];
        $user->PasswordRaw = $_POST['password-raw'];
        $user->Gender      = $_POST['gender'      ];
        $user->Weight      = $_POST['weight'      ];

        $userMapper = new \b0b\Model\Mapper\User();
        $user->Id = $userMapper->create($user);

        // Als $user->Id een waarde bevat:
        if ($user->Id) {
            // Rij voor de gebruiker in de tabel users updaten met een lastLoginId.
            $lastLoginId = $userMapper->updateLastLogin($user);
            // $lastLoginId in de sessie opslaan.
            $session->createLoginId($lastLoginId);
            // De gegevens van de gebruiker in de sessie opslaan.
            $session->createUser($user);
            // Stuur de browser door naar de homepagina.
            \b0b\Utility::redirect(BASEPATH . "index.php?id={$user->Id}");
        }
    }
}

?>
<!DOCTYPE html>
<html>
<?php
    $pageTitle = 'Registreren';
    include 'partials/head.php';
?>
<body>
    <header>
        <h1>Registreer je b0b</h1>
        <nav>
            <ul>
                <li><a href="<?php echo BASEPATH; ?>index.php/login">Aanmelden</a></li>
                <li><a href="<?php echo BASEPATH; ?>index.php">Start</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <form id="form-register" method="post">
            <fieldset class="box style-a">
                <legend>Account</legend>
                <dl>
                    <dd><input id="givenname"       name="givenname"       type="text"     required placeholder="Voornaam"           ></dd>
                    <dd><input id="familyname"      name="familyname"      type="text"     required placeholder="Familienaam"        ></dd>
                    <dd><input id="email"           name="email"           type="email"    required placeholder="E-mailadres"        ></dd>
                    <dd><input id="password-raw"    name="password-raw"    type="password" required placeholder="Wachtwoord"         ></dd>
                    <dd><input id="password-repeat" name="password-repeat" type="password" required placeholder="Wachtwoord herhalen"></dd>
                </dl>
            </fieldset>
            <fieldset class="box style-b">
                <legend>Persoonlijke gegevens</legend>
                <dl>
                    <dd><label class="wrap"><input name="gender" type="radio" required value="m"> vent</label>
                        <label class="wrap"><input name="gender" type="radio" required value="f"> vrouw</label></dd>
                    <dd><input id="weight" name="weight" type="text" required maxlength="3"> kg</dd>
                </dl>
            </fieldset>
            <p><input name="button-register" type="submit" value="Registreer mij!"></p>
        </form>
    </section>
<?php include 'partials/footer.php'; ?>
</body>
</html>