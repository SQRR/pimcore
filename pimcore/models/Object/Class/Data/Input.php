<?php 
/**
 * Pimcore
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pimcore.org/license
 *
 * @category   Pimcore
 * @package    Object_Class
 * @copyright  Copyright (c) 2009-2014 pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     New BSD License
 */

class Object_Class_Data_Input extends Object_Class_Data {

    use Object_Class_Data_Trait_Text;

    /**
     * Static type of this element
     *
     * @var string
     */
    public $fieldtype = "input";

    /**
     * @var integer
     */
    public $width;

    /**
     * Type for the column to query
     *
     * @var string
     */
    public $queryColumnType = "varchar";

    /**
     * Type for the column
     *
     * @var string
     */
    public $columnType = "varchar";
    
    /**
     * Column length
     *
     * @var integer
     */
    public $columnLength = 255;

    /**
     * Type for the generated phpdoc
     *
     * @var string
     */
    public $phpdocType = "string";

    /**
     * @var string
     */
    public $regex = "";

    /**
     * @return integer
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     * @param integer $width
     * @return void
     */
    public function setWidth($width) {
        $this->width = $width;
        return $this;
    }

    /**
     * @see Object_Class_Data::getDataForResource
     * @param string $data
     * @param null|Object_Abstract $object
     * @return string
     */
    public function getDataForResource($data, $object = null) {
        return $data;
    }

    /**
     * @see Object_Class_Data::getDataFromResource
     * @param string $data
     * @return string
     */
    public function getDataFromResource($data) {
        return $data;
    }

    /**
     * @see Object_Class_Data::getDataForQueryResource
     * @param string $data
     * @param null|Object_Abstract $object
     * @return string
     */
    public function getDataForQueryResource($data, $object = null) {
        return $data;
    }

    /**
     * @see Object_Class_Data::getDataForEditmode
     * @param string $data
     * @param null|Object_Abstract $object
     * @return string
     */
    public function getDataForEditmode($data, $object = null) {
        return $this->getDataForResource($data, $object);
    }

    /**
     * @see Object_Class_Data::getDataFromEditmode
     * @param string $data
     * @param null|Object_Abstract $object
     * @return string
     */
    public function getDataFromEditmode($data, $object = null) {
        return $this->getDataFromResource($data);
    }
    
    /**
     * @return integer
     */
    public function getColumnLength() {
        return $this->columnLength;
    }
    
    /**
     * @param integer $columnLength
     */
    public function setColumnLength($columnLength) {
        if($columnLength) {
            $this->columnLength = $columnLength;
        }
        return $this;
    }

    /**
     * @param string $regex
     */
    public function setRegex($regex)
    {
        $this->regex = $regex;
    }

    /**
     * @return string
     */
    public function getRegex()
    {
        return $this->regex;
    }
    
    /**
     * @return string
     */
    public function getColumnType() {
        return $this->columnType . "(" . $this->getColumnLength() . ")";
    }

    /**
     * @return string
     */
    public function getQueryColumnType() {
        return $this->queryColumnType . "(" . $this->getColumnLength() . ")";
    }

    /**
     * Checks if data is valid for current data field
     *
     * @param mixed $data
     * @param boolean $omitMandatoryCheck
     * @throws Exception
     */
    public function checkValidity($data, $omitMandatoryCheck = false){
        if(!$omitMandatoryCheck && $this->getRegex()) {
            if(!preg_match("#" . $this->getRegex() . "#", $data)) {
                throw new Exception("Value in field [ " . $this->getName() . " ] doesn't match input validation '" . $this->getRegex() . "'");
            }
        }

        parent::checkValidity($data, $omitMandatoryCheck);
    }

    /**
     * @param Object_Class_Data $masterDefinition
     */
    public function synchronizeWithMasterDefinition(Object_Class_Data $masterDefinition) {
        $this->columnLength = $masterDefinition->columnLength;
    }

}
