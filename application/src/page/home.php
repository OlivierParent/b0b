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

//$user = $session->readUser();

// Als de superglobal $_POST bestaat (isset()) en als vervolgens (and: &&) ook $_POST['button-bal'] bestaat:
if (isset($_POST) && isset($_POST['button-bal']) ) {
    if (!empty($_POST['gender']) &&
        !empty($_POST['weight'])
    ) {
        $user->Gender = $_POST['gender'];
        $user->Weight = $_POST['weight'];
        if (!empty($_POST['units']) &&
            !empty($_POST['hours'])
        ) {
            $bal = new \b0b\BloodAlcoholLevel($user, $_POST['units'], $_POST['hours']);
        }
    }
}

?>
<!DOCTYPE html>
<html>
<?php
    include 'partials/head.php';
?>
<body>
    <header>
        <h1>Hoe heet jouw b0b?</h1>
        <nav>
            <ul>
<?php if ($session->hasLoginId() ) : ?>
                <li><a href="<?php echo BASEPATH; ?>index.php/logout"><?php echo "{$user->Givenname} {$user->Familyname} afmelden"; ?></a></li>
<?php else : ?>
                <li><a href="<?php echo BASEPATH; ?>index.php/login">Aanmelden</a></li>
                <li><a href="<?php echo BASEPATH; ?>index.php/register">Registreren</a></li>
<?php endif; ?>
<?php if (DEBUG) : ?>
                <li><a href="<?php echo BASEPATH; ?>index.php/test">Testpagina</a></li>
<?php endif; ?>
            </ul>
        </nav>
    </header>
    <section>
        <form id="form-bal" method="post">
            <fieldset class="box style-a">
                <legend>b0bs persoonlijke gegevens</legend>
                <dl>
                    <dt><label for="gender">b0b is een</label></dt>
                    <dd><label class="wrap"><input id="gender" name="gender" type="radio" required value="m"<?php @\b0b\Utility::isChecked($user->Gender, 'm'); ?>> vent</label>
                        <label class="wrap"><input name="gender" type="radio" required value="f"<?php @\b0b\Utility::isChecked($user->Gender, 'f'); ?>> vrouw</label></dd>
                    <dt><label for="weight">en weegt</label></dt>
                    <dd><input id="weight" name="weight" type="text" required value="<?php echo @$user->Weight; ?>" maxlength="3"> kg</dd>
                </dl>
            </fieldset>
            <fieldset class="box style-b">
                <legend>b0bs alcoholconsumptie</legend>
                <dl>
                    <dt><label>b0b dronk</label></dt>
                    <dd>
                        <select id="units" name="units" required>
                            <option value="">-</option>
<?php for ($i = 1; $i <= 30; $i++) : ?>
                            <option value="<?php echo $i; ?>"<?php @\b0b\Utility::isSelected($bal->Units, $i); ?>><?php echo $i; ?></option>
<?php endfor; ?>
                        </select> glazen
                    </dd>
                    <dt><label for="hours">in</label></dt>
                    <dd><input id="hours" name="hours" type="text" required value="<?php echo @$bal->Hours; ?>" maxlength="2"> uur.</dd>
                </dl>
            </fieldset>
<?php if (isset($_POST) && isset($_POST['button-bal']) ) : ?>
            <div class="box style-c">
                <h2>b0bs bijnaam</h2>
<?php echo $bal; ?>
            </div>
            <p><input name="button-bal" type="submit" value="Zeg het mij nog eens!"> <input name="button-reset" type="submit" value="Opnieuw beginnen!"></p>
<?php else : ?>
            <p><input name="button-bal" type="submit" value="Zeg het mij!"></p>
<?php endif; ?>
        </form>
    </section>
<?php include 'partials/footer.php'; ?>
</body>
</html>