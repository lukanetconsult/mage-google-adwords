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
 * @copyright Copyright (c) 2016 LUKA netconsult GmbH (www.luka.de)
 * @license   GNU General Public Licence 3 <http://www.gnu.org/licenses/gpl-3.0.txt>
 * @version   $Id$
 */

class LUKA_GoogleAdWords_Model_Observer
{
    public function queueRegistrationConversion()
    {
        /** @var LUKA_GoogleAdWords_Helper_Data $helper */
        $helper = Mage::helper('luka_googleaw');
        $helper->pushConversionEvent('event::user_registration');
    }

    public function queuePageViewConversion($observer)
    {
        /** @var Mage_Core_Controller_Front_Action $action */
        $action     = $observer->getControllerAction();
        $actionName = $action->getFullActionName();

        /** @var LUKA_GoogleAdWords_Helper_Data $helper */
        $helper = Mage::helper('luka_googleaw');
        $helper->pushConversionEvent($actionName);
    }
}