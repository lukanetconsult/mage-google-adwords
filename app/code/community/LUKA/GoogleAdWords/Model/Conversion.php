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
 * @category
 * @package
 * @copyright Copyright (c) 2011 LUKA netconsult GmbH (www.luka.de)
 * @license   GNU General Public Licence 3 <http://www.gnu.org/licenses/gpl-3.0.txt>
 * @version   $Id$
 */

/**
 * Conversion config model
 *
 * @author  Axel Helmert <ah@luka.de>
 */
class LUKA_GoogleAdWords_Model_Conversion extends Varien_Object
{
    /**
     * Match conversion to controller object
     *
     * @param Mage_Core_Controller_Varien_Action $action
     */
    public function match(Mage_Core_Controller_Varien_Action $action)
    {
        $actionName = $action->getFullActionName();
        $match = ($this->getAction() == $actionName);

        $this->setIsMatching($match);
        Mage::dispatchEvent('luka_googleaw_match_controller', array(
            'action' => $action,
            'conversion' => $this
        ));

        return (bool)$this->getIsMatching();
    }

    /**
     * Returns the current action
     *
     * @return string
     */
    public function getAction()
    {
        $action = $this->_getData('action');
        if ($action == 'CUSTOM') {
            $action = $this->getCustomAction();
        }

        return $action;
    }

    /**
     * Check if value is used
     *
     * @return bool
     */
    public function isUsingValue()
    {
        $flag = (bool)$this->_getData('use_value');
        return $flag;
    }

	/**
     * Current conversion code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->_getData('code');
    }

    /**
     * Conversion label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->_getData('label');
    }

    /**
     * Current color code
     *
     * @return string|null
     */
    public function getColor()
    {
        return $this->_getData('color');
    }

    /**
     * @return int|null
     */
    public function getFormat()
    {
        return $this->_getData('format');
    }
}