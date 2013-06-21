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
 * @category  blocks
 * @package   LUKA_GoogleAdWords
 * @copyright Copyright (c) 2011 LUKA netconsult GmbH (www.luka.de)
 * @license   GNU General Public Licence 3 <http://www.gnu.org/licenses/gpl-3.0.txt>
 * @version   $Id$
 */

/**
 * Conversions config
 *
 * @author  Axel Helmert <ah@luka.de>
 */
class LUKA_GoogleAdWords_Block_Adminhtml_Config_Conversions
extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    /**
     * (non-PHPdoc)
     * @see Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract::__construct()
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('luka/google/adwords/config/conversions.phtml');

    }

	/**
     * (non-PHPdoc)
     * @see Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract::_prepareToRender()
     */
    protected function _prepareToRender()
    {
        $this->addColumn('action', array(
            'label' => $this->__('Page'),
            'size' => 28,
            'renderer' => $this->getLayout()->createBlock('luka_googleaw/adminhtml_config_conversion_select'),
            'options' => array(
                array('value' => 'checkout_onepage_success', 'label' => $this->__('Onepage Checkout Success')),
                array('value' => 'paypal_standard_success', 'label' => $this->__('PayPal Standard Checkout Success')),
                array('value' => 'CUSTOM', 'label' => $this->__('Use Custom Action Name'))
            )
        ));

        $this->addColumn('custom_action', array(
            'label' => $this->__('Custom Action'),
            'size' => 28
        ));

        $this->addColumn('code', array(
            'label' => $this->__('ID'),
            'size' => 28
        ));

        $this->addColumn('label', array(
            'label' => $this->__('Label'),
            'size' => 28
        ));

        $this->addColumn('format', array(
            'label' => $this->__('Format'),
            'size' => 16
        ));

        $this->addColumn('color', array(
            'label' => $this->__('Color'),
            'size' => 16
        ));

        $this->addColumn('format', array(
            'label' => $this->__('Notification Format'),
            'size' => 16,
            'renderer' => $this->getLayout()->createBlock('luka_googleaw/adminhtml_config_conversion_select'),
            'options' => Mage::getModel('luka_googleaw/config_source_format')->toOptionArray(true)
        ));

        $this->addColumn('use_value', array(
            'label' => $this->__('Submit Order Value'),
            'size' => 16,
            'renderer' => $this->getLayout()->createBlock('luka_googleaw/adminhtml_config_conversion_select'),
            'options' => array(
                array('value' => 1, 'label' => $this->helper('adminhtml')->__('Yes')),
                array('value' => 0, 'label' => $this->helper('adminhtml')->__('No'))
            )
        ));
    }

	/**
     * (non-PHPdoc)
     * @see Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract::addColumn()
     */
    public function addColumn($name, $params)
    {
        parent::addColumn($name, $params);

        if (isset($params['options']) && is_array($params['options'])) {
            $this->_columns[$name]['options'] = $params['options'];
        }
    }
}