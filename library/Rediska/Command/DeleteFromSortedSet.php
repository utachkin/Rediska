<?php

/**
 * Add the specified member to the Set value at key
 * 
 * @param string $name  Key name
 * @param mixin  $value Member
 * @return boolean
 * 
 * @author Ivan Shumkov
 * @package Rediska
 * @version 0.3.0
 * @link http://rediska.geometria-lab.net
 * @licence http://www.opensource.org/licenses/bsd-license.php
 */
class Rediska_Command_DeleteFromSortedSet extends Rediska_Command_Abstract
{
    protected function _create($name, $value)
    {
        $connection = $this->_rediska->getConnectionByKeyName($name);

        $value = $this->_rediska->serialize($value);
        
        $command = array('ZREM', "{$this->_rediska->getOption('namespace')}$name", $value);

        $this->_addCommandByConnection($connection, $command);
    }

    protected function _parseResponse($response)
    {
        return (boolean)$response[0];
    }
}