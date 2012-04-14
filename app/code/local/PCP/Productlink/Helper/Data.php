<?php
class PCP_Productlink_Helper_Data extends Mage_Core_Helper_Data {

    public function canViewProduct( $_product = null ) {

        if ( is_null($_product) ) {

            return false;

        }

        // Check if product is enabled

        if ( $_product->getStatus() == 2 ) {

            return false;

        }

        // Check if product is visible.

        if ( $_product->getVisibility() == 1 ) {

            return false;

        }

        return true;

    }

}