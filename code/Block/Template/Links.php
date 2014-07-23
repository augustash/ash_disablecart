<?php
/**
 * Ash Disablecart Extension
 *
 * Enables read-only catalog maintenance mode.
 *
 * @category    Ash
 * @package     Ash_Disablecart
 * @copyright   Copyright (c) 2014 August Ash, Inc. (http://www.augustash.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Links list block
 *
 * @category    Ash
 * @package     Ash_Disablecart
 * @author      August Ash Team <core@augustash.com>
 */
class Ash_Disablecart_Block_Template_Links extends Mage_Page_Block_Template_Links
{
    /**
     * Prevent account/cart links from showing when shopping is disabled.
     *
     * @return  array
     */
    public function getLinks()
    {
        if (Mage::helper('ash_disablecart')->isDisabled()) {
            return array();
        }

        return parent::getLinks();
    }
}
