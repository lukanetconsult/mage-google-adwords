<?php
/**
 * LICENSE: $license_text$
 *
 * @author    Axel Helmert <ah@luka.de>
 * @copyright Copyright (c) 2012 LUKA netconsult GmbH (www.luka.de)
 * @license   $license$
 * @version   $Id$
 */

/**
 * Conversion notification format source model
 */
class LUKA_GoogleAdWords_Model_Config_Source_Format
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray($addEmptyOption = false)
    {
        $helper = Mage::helper('luka_googleaw');
        $options = array(
            array('value' => 1, 'label'=> $helper->__('One-line notification')),
            array('value' => 2, 'label'=> $helper->__('Two-line notification')),
            array('value' => 3, 'label'=> $helper->__('No notification'))
        );

        if ($addEmptyOption) {
            array_unshift($options, array('value' => '', 'label' => $helper->__('Use default')));
        }

        return $options;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $options = array();
        foreach ($this->toOptionArray() as $item) {
            $options[$item['value']] = $item['label'];
        }

        return $options;
    }
}