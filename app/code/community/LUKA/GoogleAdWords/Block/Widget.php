<?php
/**
 * LICENSE: $license_text$
 *
 * @author    Axel Helmert <ah@luka.de>
 * @copyright Copyright (c) 2014 LUKA netconsult GmbH (www.luka.de)
 * @license   $license$
 */

class LUKA_GoogleAdWords_Block_Widget extends LUKA_GoogleAdWords_Block_Conversion implements Mage_Widget_Block_Interface
{
    /**
     * {@inheritdoc}
     * @see LUKA_GoogleAdWords_Block_Conversion::_initCurrentConversion()
     */
    protected function _initCurrentConversion()
    {
        $conversion = Mage::getModel('luka_googleaw/conversion');
        $conversion->setData($this->getData());

        return $conversion;
    }
}
