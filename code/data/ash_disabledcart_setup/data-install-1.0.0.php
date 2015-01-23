<?php
/**
 * Ash Disablecart Extension
 *
 * Enables read-only catalog maintenance mode.
 *
 * @category    Ash
 * @package     Ash_Disablecart
 * @copyright   Copyright (c) 2015 August Ash, Inc. (http://www.augustash.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

Mage::getModel('cms/block')->setData(array(
    'title'         => 'Shopping Cart Disabled',
    'identifier'    => 'disabled-cart',
    'is_active'     => 1,
    'stores'        => array(
        Mage::app()->getStore()->getId()
    ),
    'content'       => 'The website is currently <strong>undergoing routine '
                     . 'maintenance</strong>. Our checkout process is temporarily '
                     . 'disabled. Please try again soon.'
))->save();
