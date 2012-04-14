<?php
class PCP_Productlink_Block_Renderer_Link extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row) {
        $_product = Mage::getModel('catalog/product')->load($row->getId());

        $data = '';

        if ( $_product->getUrlPath() ) {
            $data = '<a href="' . Mage::getUrl($_product->getUrlPath()) . '" target="_blank">' . $this->__('View') . '</a>';
        }

        return $data;
    }
}