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

$user = $session->readUser();

// Als $_POST bestaat (isset()) en als vervolgens (and: &&) ook $_POST['button-logout'] bestaat:
if (isset($_POST) && isset($_POST['button-logout']) ) {
    // Autmatisch inloggen uitschakelen.
    $session->disableAutoLogin();
    // De sessie vernietigen.
    $session->destroy();
    // Stuur de browser door naar de homepagina.
    \b0b\Utility::redirect(BASEPATH . 'index.php');
}

?>
<!DOCTYPE html>
<html>
<?php
    $pageTitle = 'Afmelden';
    include 'partials/head.php';
?>
<body>
    <header>
        <h1>Meld je b0b af</h1>
            <nav>
            <ul>
                <li><a href="<?php echo BASEPATH; ?>index.php">Start</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <form id="form-logout" method="post">
            <fieldset class="box style-c">
                <legend><?php echo "{$user->Givenname} {$user->Familyname} afmelden"; ?></legend>
                <p><input name="button-logout" type="submit" value="Meld mij af!"></p>
            </fieldset>
        </form>
    </section>
<?php include 'partials/footer.php'; ?>
</body>
</html>