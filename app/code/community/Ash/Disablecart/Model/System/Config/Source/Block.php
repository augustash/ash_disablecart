<?php
/**
 * Ash Disablecart Extension
 *
 * Enables read-only catalog maintenance mode.
 *
 * @category    Ash
 * @package     Ash_Disablecart
 * @copyright   Copyright (c) 2015 August Ash, Inc. (http://www.augustash.com)
 * @license     LICENSE.txt (MIT)
 */

/**
 * Block source model
 *
 * @category    Ash
 * @package     Ash_Disablecart
 * @author      August Ash Team <core@augustash.com>
 */
class Ash_Disablecart_Model_System_Config_Source_Block
{
    /**
     * Array of available blocks
     *
     * @var array
     */
    protected $_options = array();

    /**
     * Return array of blocks
     *
     * @return  array
     */
    public function toOptionArray()
    {
        if (empty($this->_options)) {
            $this->_options = Mage::getResourceModel('cms/block_collection')
                 ->load()->toOptionArray();
            array_unshift($this->_options, array(
                'value'=> '',
                'label'=> Mage::helper('adminhtml')->__('-- Please Select --'),
            ));
        }

        return $this->_options;
    }
}
