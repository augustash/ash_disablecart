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
 * Observer model
 *
 * @category    Ash
 * @package     Ash_Disablecart
 * @author      August Ash Team <core@augustash.com>
 */
class Ash_Disablecart_Model_Observer
{
    /**
     * Leverage the built-in functionality of Magento to disable the checkout
     * process.
     *
     * @param   Varien_Event_Observer $observer
     * @return  Ash_Disablecart_Model_Observer
     */
    public function disableOnepageCheckout(Varien_Event_Observer $observer)
    {
        if (Mage::helper('ash_disablecart')->isDisabled()) {
            $enabled = false;
        } else {
            $enabled = true;
        }

        $config = new Mage_Core_Model_Config();
        $config->saveConfig('checkout/options/onepage_checkout_enabled', $enabled, 'default', 0);
        $config->saveConfig('wishlist/general/active', $enabled, 'default', 0);

        return $this;
    }

    /**
     * Inject a message before each page is rendered.
     *
     * @param   Varien_Event_Observer $observer
     * @return  Ash_Disablecart_Model_Observer
     */
    public function displayMaintenanceMessage(Varien_Event_Observer $observer)
    {
        if (Mage::helper('ash_disablecart')->canDisplayReminder()) {
            $block = Mage::app()->getLayout()->createBlock('cms/block')
                ->setBlockId(Mage::getStoreConfig(Ash_Disablecart_Helper_Data::XML_PATH_DISABLED_MESSAGE));
            Mage::getSingleton('core/session')->addError($block->toHtml());
        }

        return $this;
    }

    /**
     * Disable customer's ability to add to cart.
     *
     * @param   Varien_Event_Observer $observer
     * @return  Ash_Disablecart_Model_Observer
     */
    public function disableAddToCart(Varien_Event_Observer $observer)
    {
        if (Mage::helper('ash_disablecart')->isDisabled()) {
            $updates = $observer->getLayout()->getUpdate();
            $updates
                ->addUpdate('<reference name="product.info"><remove name="product.info.options.wrapper" /></reference>')
                ->addUpdate('<reference name="product.info"><remove name="product.info.addto" /></reference>')
                ->addUpdate('<reference name="product.info"><remove name="product.info.addtocart" /></reference>');
        }

        return $this;
    }
}
