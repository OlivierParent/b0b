<?php
namespace b0b\Object;

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
 * Abstracte klasse met generieke getter- en settermethode.
 *
 * @author     Olivier Parent
 * @copyright  Copyright (c) 2012 Artevelde University College Ghent
 */
abstract class Object
{
    /**
     * Magische methode voor de generieke getter voor een property.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);             // Zie: http://www.php.net/manual/en/function.ucfirst.php
        if (method_exists($this, $method) ) {         // Zie: http://www.php.net/manual/en/function.method-exists.php
            return $this->{$method}();
        } else {
            $property = '_' . lcfirst($name);         // Zie: http://www.php.net/manual/en/function.lcfirst.php
            if (property_exists($this, $property) ) { // Zie: http://www.php.net/manual/en/function.property-exists.php
                return $this->{$property}; // De accolades zijn optioneel.
            } else {
                $this->_throwError($property);
            }
        }
    }

    /**
     * Magische methode voor de generieke setter voor een property.
     *
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);             // Zie: http://www.php.net/manual/en/function.ucfirst.php
        if (method_exists($this, $method) ) {         // Zie: http://www.php.net/manual/en/function.method-exists.php
            $this->{$method}($value);
        } else {
            $property = '_' . lcfirst($name);         // Zie: http://www.php.net/manual/en/function.lcfirst.php
            if (property_exists($this, $property) ) { // Zie: http://www.php.net/manual/en/function.property-exists.php
                $this->{$property} = $value; // De accolades zijn optioneel.
            } else {
                $this->_throwError($property);
            }
        }
    }

    /**
     * Werpt een Exception met de boodschap dat de property niet bestaat in de
     * klasse.
     *
     * @param string $property
     * @throws \ErrorException
     */
    protected function _throwError($property)
    {
        // Zie: http://www.php.net/manual/en/function.get-called-class.php
        throw new \ErrorException("Property <strong>{$property}</strong> does not exist in class <strong>" . get_called_class() . '<strong>');
    }
}