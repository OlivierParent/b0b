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

// Als de superglobal $_POST bestaat (isset()) en als vervolgens (and: &&) ook $_POST['button-login'] bestaat:
if (isset($_POST) && isset($_POST['button-login']) ) {
    // Als $_POST['email'] en $_POST['passwd'] beide niet (!) leeg (empty()) zijn:
    if (!empty($_POST['email']) && !empty($_POST['password-raw']) ) {
        $user = new \b0b\Model\User();
        $user->Email       = $_POST['email'       ];
        $user->PasswordRaw = $_POST['password-raw'];

        $userMapper = new b0b\Model\Mapper\User();
        try {
            $user = $userMapper->readAuthenticate($user);
            $session->createUser($user);

            // Als 'Onthoud mij.' aangevinkt stond:
            if (isset($_POST['remember']) ) {
                $lastLoginId = $userMapper->updateLastLogin($user);
                $session->enableAutoLogin($lastLoginId);
            } else {
                $session->createLoginId(); // Als $lastLoginId niet meegegeven wordt, dan wordt de session id gebruikt.
            }
            // Stuur de browser door naar de homepagina.
            \b0b\Utility::redirect(BASEPATH . 'index.php');
        } catch (\Exception $e) {
            die ($e->getMessage() );
        } catch (\ErrorException $e) {
            die ($e->getMessage() );
        }
    }
}

?>
<!DOCTYPE html>
<html>
<?php
    $pageTitle = 'Aanmelden';
    include 'partials/head.php';
?>
<body>
    <header>
        <h1>Meld je b0b aan</h1>
        <nav>
            <ul>
                <li><a href="<?php echo BASEPATH; ?>index.php/register">Registreren</a></li>
                <li><a href="<?php echo BASEPATH; ?>index.php">Start</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <form id="form-login" method="post">
            <fieldset class="box style-b">
                <legend>Aanmelden</legend>
                <dl>
                    <dd><input name="email"        type="email"    required placeholder="E-mailadres"></dd>
                    <dd><input name="password-raw" type="password" required placeholder="Wachtwoord" ></dd>
                    <dd><label class="wrap"><input name="remember" type="checkbox" checked> Onthoud mij.</label></dd>
                </dl>
            </fieldset>
            <p><input name="button-login" type="submit" value="Meld mij aan!"></p>
        </form>
    </section>
<?php include 'partials/footer.php'; ?>
</body>
</html>