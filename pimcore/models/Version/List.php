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
 * @package    Schedule
 * @copyright  Copyright (c) 2009-2014 pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     New BSD License
 */

class Version_List extends Pimcore_Model_List_Abstract {

    /**
     * Contains the results of the list. They are all an instance of Schedule_Task
     *
     * @var array
     */
    public $versions = array();

    /**
     * Tests if the given key is an valid order key to sort the results
     *
     * @todo remove the dummy-always-true rule
     * @return boolean
     */
    public function isValidOrderKey($key) {
        return true;
    }

    /**
     * @return array
     */
    public function getVersions() {
        return $this->versions;
    }

    /**
     * @param array $tasks
     * @return void
     */
    public function setVersions($versions) {
        $this->versions = $versions;
        return $this;
    }
}
