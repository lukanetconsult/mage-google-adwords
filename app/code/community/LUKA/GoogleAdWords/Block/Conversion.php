<?php
/**
 * Google AdWords Conversion Tracking module for Magento
 *
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
 * @category   Views
 * @package    LUKA_GoogleAdWords
 * @copyright  Copyright (c) 2009 LUKA netconsult GmbH (www.luka.de)
 * @license    GNU General Public Licence 3 <http://www.gnu.org/licenses/gpl-3.0.txt>
 * @version    $Id: Conversion.php 9866 2011-11-28 12:10:26Z helmert $
 */

/**
 * HTML Block for conversion tracking code
 *
 * @author    Axel Helmert <ah@luka.de>
 * @copyright Copyright (c) 2009 LUKA netconsult GmbH (www.luka.de)
 * @version   $Id: Conversion.php 9866 2011-11-28 12:10:26Z helmert $
 * @package   LUKA_GoogleAdWords
 */
class LUKA_GoogleAdWords_Block_Conversion extends Mage_Core_Block_Template
{
    /**
     * Current conversion model
     *
     * @var LUKA_GoogleAdWords_Model_Conversion
     */
    private $_currentConversion = null;

    /**
     * Collection containing current conversions
     *
     * @var LUKA_GoogleAdWords_Model_Conversion_Collection
     */
    private $_conversionCollection = null;

    /**
     * Block constructor
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('luka/google/adwords/conversion.phtml');

        return $this;
    }

    /**
     * Init current conversion
     */
    protected function _initCurrentConversion()
    {
        $action = $this->getAction();
        $conversion = $this->getConversionCollection()->getItemByAction($action);
        $this->setCurrentConversion($conversion);

        return $this;
    }

    /**
     * Init conversion collection
     */
    protected function _initConversionCollection()
    {
        $collection = Mage::getModel('luka_googleaw/conversion_collection');
        $this->setConversionCollection($collection);

        return $this;
    }

    /**
     * Check if AdWords conversion tracking is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        $enabled = Mage::getStoreConfigFlag('google/adwords_conversion/enable');
        return $enabled;
    }

    /**
     * Check if this conversion is active
     *
     * @return bool
     */
    public function isActive()
    {
        $result = $this->isEnabled() && $this->getCurrentConversion();
        return $result;
    }

    /**
     * Returns Possible tracking data
     *
     * @return LUKA_GoogleAdWords_Model_Conversion_Collection
     */
    public function getConversionCollection()
    {
        if ($this->_conversionCollection === null) {
            $this->_initConversionCollection();
        }

        return $this->_conversionCollection;
    }

    /**
     * set current conversion collection
     *
     * @param LUKA_GoogleAdWords_Model_Conversion_Collection $collection
     */
    public function setConversionCollection(LUKA_GoogleAdWords_Model_Conversion_Collection $collection)
    {
        $this->_conversionCollection = $collection;
        return $this;
    }

    /**
     * Set current conversion
     *
     * @param LUKA_GoogleAdWords_Model_Conversion $conversion
     */
    public function setCurrentConversion($conversion = null)
    {
        if (($conversion !== null) && (!$conversion instanceof LUKA_GoogleAdWords_Model_Conversion)) {
            $conversion = false;
        }

        $this->_currentConversion = $conversion;
        return $this;
    }

    /**
     * Current conversion
     *
     * @return LUKA_GoogleAdWords_Model_Conversion|false
     */
    public function getCurrentConversion()
    {
        if ($this->_currentConversion === null) {
            $this->_initCurrentConversion();
        }

        return $this->_currentConversion;
    }


    /**
     * Returns the conversion id
     *
     * @return int
     */
    public function getConversionId()
    {
        return $this->getCurrentConversion()->getCode();
//         if (!$this->hasConversionId()) {
//             $conversionId = (int)Mage::getStoreConfig('google/adwords_conversion/conversion_id');
//             $this->setConversionId($conversionId);
//         }

//         return $this->getData('conversion_id');
    }

    /**
     * Returns the language for this conversion
     *
     * @return string
     */
    public function getConversionLanguage()
    {
        if (!$this->hasConversionLanguage()) {
            $locale = new Zend_Locale(Mage::getStoreConfig('google/adwords_conversion/locale'));
            $this->setConversionLanguage($locale->getLanguage());
        }

        return $this->getData('conversion_language');
    }

    /**
     * Returns the conversion label
     *
     * @return string
     */
    public function getConversionLabel()
    {
        return $this->getCurrentConversion()->getLabel();
//         if (!$this->hasConversionLabel()) {
//             $label = (string)Mage::getStoreConfig('google/adwords_conversion/label');
//             $this->setConversionLabel($label);
//         }

//         return $this->getData('conversion_label');
    }

    /**
     * Returns the conversion color
     *
     * @return string
     */
    public function getConversionColor()
    {
        $color = $this->getCurrentConversion()->getColor();
        if (!$color) {
            if (!$this->hasConversionColor()) {
                $color = (string)Mage::getStoreConfig('google/adwords_conversion/color');
                $this->setConversionColor($color);
            }

            $color = $this->getData('conversion_color');
        }

        return $color;
    }

    /**
     * Returns the current order
     *
     * @return Mage_Sales_Model_Order|null
     */
    public function getOrder()
    {
        if (!$this->hasOrder()) {
            /* @var $session Mage_Checkout_Model_Session */
            /* @var $order Mage_Sales_Model_Order */
            $orderId = Mage::getSingleton('checkout/session')->getLastOrderId();
            $order   = null;

            if ($orderId) {
                $order = Mage::getModel('sales/order');
                $order->load($orderId);

                if (!$order->getId()) {
                    $order = null;
                }
            }

            $this->setOrder($order);
        }

        return $this->_getData('order');
    }

    /**
     * Returns the conversion value
     *
     * @return string
     */
    public function getConversionValue()
    {
        if (!$this->getCurrentConversion()->isUsingValue()) {
            return false;
        }

        if (!$this->hasConversionValue() && $this->getOrder()) {
            $total = $this->getOrder()->getSubtotal();
            $this->setConversionValue($total);
        }

        return $this->getData('conversion_value');
    }

    /**
     * Returns the url to the google conversion tracking script
     *
     * @return string
     */
    public function getConversionScriptUrl()
    {
        $url = 'http://www.googleadservices.com/pagead/conversion.js';

        if ($this->getRequest()->isSecure()) {
            $url = 'https://www.googleadservices.com/pagead/conversion.js';
        }

        return $url;
    }

    /**
     * @return int
     */
    public function getConversionFormat()
    {
        $format = (int)$this->getCurrentConversion()->getFormat();
        if ($format < 1 || $format > 3) {
            $format = (int)Mage::getStoreConfig('google/adwords_conversion/format');

            if ($format < 1 || $format > 3) {
                $format = 3;
            }
        }

        return $format;
    }

    /**
     * Returns the non JS fallback url
     *
     * @return string
     */
    public function getFallbackUrl()
    {
        $url = 'http';

        if ($this->getRequest()->isSecure()) {
            $url .= 's';
        }

        $url .= '://www.googleadservices.com/pagead/conversion/'
              . $this->getConversionId() . '/';

        $query = array('label' => $this->getConversionLabel());
        $value = (float)$this->getConversionValue();

        if ($value > 0) {
            $query['value'] = $value;
        }

        /* @var $uri Zend_Uri_Http */
        $uri = Zend_Uri::factory($url);
        $uri->setQuery($query);

        return $uri->getUri();
    }
}
