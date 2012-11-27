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

$userMapper = new b0b\Model\Mapper\User();
$rows = $userMapper->readAll();

?>
<!DOCTYPE html>
<html>
<?php
    $pageTitle = 'Testpagina';
    include 'partials/head.php';
?>
<body>
    <header>
        <h1>Hoe heet jouw b0b?</h1>
        <nav>
            <ul>
                <li><a href="?resetdatabase">Reset de database</a></li>
                <li><a href="<?php echo BASEPATH; ?>index.php">Start</a></li>
            </ul>
        </nav>
    </header>
    <section>
<?php
foreach ($rows as $row) {
    echo '<pre>';
    // Zie: http://www.php.net/manual/en/function.print-r.php
    print_r($row);
    echo '</pre>';
}
?>
    </section>
<?php include 'partials/footer.php'; ?>
</body>
</html>