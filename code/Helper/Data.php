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

/**
 * Data helper
 *
 * @category    Ash
 * @package     Ash_Disablecart
 * @author      August Ash Team <core@augustash.com>
 */
class Ash_Disablecart_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_DISABLED_MODE     = 'ash_disablecart/general/enabled';
    const XML_PATH_DISABLED_REMINDER = 'ash_disablecart/general/reminder';
    const XML_PATH_DISABLED_MESSAGE  = 'ash_disablecart/general/message_block';

    /**
     * Determines if shopping cart should be disabled.
     *
     * @return  boolean
     */
    static public function isDisabled()
    {
        if (Mage::getStoreConfigFlag(self::XML_PATH_DISABLED_MODE)) {
            return true;
        }

        return false;
    }

    /**
     * Determines if appropriate to display disabled reminder.
     *
     * @return  boolean
     */
    static public function canDisplayReminder()
    {
        if (Mage::getStoreConfigFlag(self::XML_PATH_DISABLED_MODE)
            && Mage::getStoreConfigFlag(self::XML_PATH_DISABLED_REMINDER)) {
            return true;
        }

        return false;
    }
}
