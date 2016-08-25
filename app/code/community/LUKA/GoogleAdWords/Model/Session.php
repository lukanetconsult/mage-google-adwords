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

/**
 * Class LUKA_GoogleAdWords_Model_Session
 *
 * @method array getEventQueue();
 * @method void setEventQueue(array $aQueue);
 */
class LUKA_GoogleAdWords_Model_Session extends Mage_Core_Model_Session_Abstract
{
    /**
     * LUKA_GoogleAdWords_Model_Session constructor.
     */
    public function __construct($data = array())
    {
        parent::__construct();

        $name = isset($data['name']) ? $data['name'] : null;
        $this->init('luka_googleaw', $name);

        $queue = $this->getEventQueue();
        if (!is_array($queue)) {
            $this->setEventQueue(array());
        }
    }

    /**
     * Adds conversion event to the queue
     *
     * @param string $type
     */
    public function pushEvent($type)
    {
        $queue = $this->getEventQueue();
        array_push($queue, $type);
        $this->setEventQueue($queue);
    }

    /**
     * Pops conversion event from the queue
     *
     * @return bool|string
     */
    public function popEvent()
    {
        $queue  = $this->getEventQueue();
        $result = false;
        if (is_array($queue) && !empty($queue)) {
            $result = array_pop($queue);
            $this->setEventQueue($queue);
        }
        return $result;
    }
}