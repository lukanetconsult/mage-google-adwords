<?php
/**
 * LICENSE:
 * This file is part of LUKA_GoogleAdWords.
 *
 * LUKA_GoogleAdWords is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * LUKA_GoogleAdWords is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with LUKA_GoogleAdWords.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 * @category  models
 * @package   LUKA_GoogleAdWords
 * @copyright Copyright (c) 2011 LUKA netconsult GmbH (www.luka.de)
 * @license   GNU General Public Licence 3 <http://www.gnu.org/licenses/gpl-3.0.txt>
 * @version   $Id$
 */

/**
 * Collection containing configured conversions
 *
 * @author  Axel Helmert <ah@luka.de>
 */
class LUKA_GoogleAdWords_Model_Conversion_Collection
extends Varien_Data_Collection
{
    /**
     * Create item
     *
     * @param array $itemData
     * @return LUKA_GoogleAdWords_Model_Conversion
     */
    public function createItem($itemData)
    {
        if (!is_array($itemData)) {
            return false;
        }

        $item = Mage::getModel('luka_googleaw/conversion');
        $item->setData($itemData);

        return $item;
    }

	/**
     * (non-PHPdoc)
     * @see Varien_Data_Collection::loadData()
     */
    public function loadData($printQuery = false, $logQuery = false)
    {
        if ($this->isLoaded()) {
            return $this;
        }

        $data = Mage::getStoreConfig('google/adwords_conversion/conversions');
        if ($data && !is_array($data)) {
            $data = @unserialize($data);

            if (!is_array($data)) {
                $data = false;
            }
        }

        if (!$data) {
            $this->_setIsLoaded(true);
            return $this;
        }

        foreach ($data as $itemData) {
            $item = $this->createItem($itemData);

            if ($item) {
                $this->addItem($item);
            }
        }

        return $this;
    }

    /**
     * Find item by action name
     *
     * @param Mage_Core_Controller_Varien_Action $action
     * @return LUKA_GoogleAdWords_Model_Conversion|false
     */
    public function getItemByAction(Mage_Core_Controller_Varien_Action $action)
    {
        foreach ($this as $item) {
            if (!$item->match($action)) {
                continue;
            }

            return $item;
        }

        return false;
    }
}