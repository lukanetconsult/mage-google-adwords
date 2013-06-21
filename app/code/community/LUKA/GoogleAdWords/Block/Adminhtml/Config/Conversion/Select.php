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
 * @category  views
 * @package   LUKA_GoogleAdWords
 * @copyright Copyright (c) 2011 LUKA netconsult GmbH (www.luka.de)
 * @license   GNU General Public Licence 3 <http://www.gnu.org/licenses/gpl-3.0.txt>
 * @version   $Id$
 */

/**
 *
 *
 * @author  Axel Helmert <ah@luka.de>
 */
class LUKA_GoogleAdWords_Block_Adminhtml_Config_Conversion_Select
extends Mage_Core_Block_Abstract
{
    /**
     * Returns option values
     *
     * @return array
     */
    public function getOptions()
    {
        $column = $this->getColumn();
        $options = array();

        if (is_array($column) && isset($column['options']) && is_array($column['options'])) {
            $options = $column['options'];
        }

        return $options;
    }

	/**
     * (non-PHPdoc)
     * @see Mage_Core_Block_Abstract::_toHtml()
     */
    protected function _toHtml()
    {
        $column = $this->getColumn();
        $html = '<select name="' . $this->getInputName() . '"'
              . (isset($column['class']) ? ' class="' . $column['class'] . '"' : '') . '>';

        foreach ($this->getOptions() as $option) {
            $html .= '<option value="' . $this->htmlEscape($option['value']) . '">'
                   . $this->htmlEscape($option['label'])
                   . '</option>';
        }

        $html .= '</select>';

        return $html;
    }
}