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
 * @package    Metadata
 * @copyright  Copyright (c) 2009-2014 pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     New BSD License
 */

class Metadata_Predefined extends Pimcore_Model_Abstract {

    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $key;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $targetSubtype;


    /**
     * @var string
     */
    public $data;

    /**
     * @var string
     */
    public $config;

    /**
     * @var string
     */
    public $ctype;

    /**
     * @var string
     */
    public $language;

    /**
     * @var integer
     */
    public $creationDate;

    /**
     * @var integer
     */
    public $modificationDate;



    /**
     * @param integer $id
     * @return Metadata_Predefined
     */
    public static function getById($id) {
        $metadata = new self();
        $metadata->setId($id);
        $metadata->getResource()->getById();

        return $metadata;
    }

    /**
     * @param string $key
     * @return Metadata_Predefined
     */
    public static function getByName($key, $language = "") {

//        $cacheKey = "metadata_predefined_" . $key . "_" . $language;

//        try {
//            $metadata = Zend_Registry::get($cacheKey);
//            if(!$metadata) {
//                throw new Exception("Predefined metadata in registry is null");
//            }
//        } catch (Exception $e) {
            $metadata = new self();
            $metadata->setKey($key);
            $metadata->getResource()->getByKeyAndLanguage($key, $language);
//
//            Zend_Registry::set($cacheKey, $metadata);
//        }

        return $metadata;
    }

    /**
     * @return Metadata_Predefined
     */
    public static function create() {
        $type = new self();
        $type->save();

        return $type;
    }


    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getData() {
        return $this->data;
    }


    /**
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $type
     * @return void
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $data
     * @return void
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param integer $id
     * @return void
     */
    public function setId($id) {
        $this->id = (int) $id;
        return $this;
    }


    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param int $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = (int) $creationDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param int $modificationDate
     */
    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = (int) $modificationDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $targetSubtype
     */
    public function setTargetSubtype($targetSubtype)
    {
        $this->targetSubtype = $targetSubtype;
    }

    /**
     * @return string
     */
    public function getTargetSubtype()
    {
        return $this->targetSubtype;
    }


    public function minimize() {
        switch ($this->type) {
            case "document":
            case "asset":
            case "object":
                {
                    $element = Element_Service::getElementByPath($this->type, $this->data);
                    if ($element) {
                        $this->data = $element->getId();
                    } else {
                        $this->data = "";
                    }
                }
                break;
            case "date":
            {
                if ($this->data && !is_numeric($this->data)) {
                    $this->data = strtotime($this->data);
                }
            }
            default:
                //nothing to do
        }
    }


    public function expand() {
        switch ($this->type) {
            case "document":
            case "asset":
            case "object":
                {
                if (is_numeric($this->data)) {
                    $element = Element_Service::getElementById($this->type, $this->data);
                }
                if ($element) {
                    $this->data = $element->getFullPath();
                } else {
                    $this->data = "";
                }
            }

            break;
            default:
        //nothing to do
        }
    }




}
