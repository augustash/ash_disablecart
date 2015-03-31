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

require_once 'Mage/Customer/controllers/AccountController.php';

/**
 * Customer account controller
 *
 * @category    Ash
 * @package     Ash_Disablecart
 * @author      August Ash Team <core@augustash.com>
 */
class Ash_Disablecart_AccountController extends Mage_Customer_AccountController
{
    /**
     * Action predispatch
     *
     * Check customer authentication for some actions
     *
     * @return  void
     */
    public function preDispatch()
    {
        parent::preDispatch();

        // logout users if shopping cart is disabled
        $this->_checkIfDisabled();
    }

    /**
     * If shopping cart is disabled, prevent users from logging into their
     * accounts.
     *
     * @return  void
     */
    protected function _checkIfDisabled()
    {
        if (Mage::helper('ash_disablecart')->isDisabled()) {
            // logout the user
            $this->_getSession()->logout()
                ->renewSession()
                ->setBeforeAuthUrl($this->_getRefererUrl());

            $this->_redirect('/checkout/cart');
            return;
        }
    }
}
