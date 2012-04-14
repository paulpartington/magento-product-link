<?php
class PCP_Productlink_Block_Catalog_Product_Edit extends Mage_Adminhtml_Block_Catalog_Product_Edit
{

    public function __construct() {
        parent::__construct();
    }

    protected function _prepareLayout()
    {
        if (!$this->getRequest()->getParam('popup')) {
            $this->setChild('back_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                        'label'     => Mage::helper('catalog')->__('Back'),
                        'onclick'   => 'setLocation(\''.$this->getUrl('*/*/', array('store'=>$this->getRequest()->getParam('store', 0))).'\')',
                        'class' => 'back'
                    ))
            );
        } else {
            $this->setChild('back_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                        'label'     => Mage::helper('catalog')->__('Close Window'),
                        'onclick'   => 'window.close()',
                        'class' => 'cancel'
                    ))
            );
        }

        if (!$this->getProduct()->isReadonly()) {
            $this->setChild('reset_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                        'label'     => Mage::helper('catalog')->__('Reset'),
                        'onclick'   => 'setLocation(\''.$this->getUrl('*/*/*', array('_current'=>true)).'\')'
                    ))
            );

            $this->setChild('save_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                        'label'     => Mage::helper('catalog')->__('Save'),
                        'onclick'   => 'productForm.submit()',
                        'class' => 'save'
                    ))
            );
        }

        if (!$this->getRequest()->getParam('popup')) {
            if (!$this->getProduct()->isReadonly()) {
                $this->setChild('save_and_edit_button',
                    $this->getLayout()->createBlock('adminhtml/widget_button')
                        ->setData(array(
                            'label'     => Mage::helper('catalog')->__('Save and Continue Edit'),
                            'onclick'   => 'saveAndContinueEdit(\''.$this->getSaveAndContinueUrl().'\')',
                            'class' => 'save'
                        ))
                );
            }
            if ($this->getProduct()->isDeleteable()) {
                $this->setChild('delete_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                        ->setData(array(
                            'label'     => Mage::helper('catalog')->__('Delete'),
                            'onclick'   => 'confirmSetLocation(\''.Mage::helper('catalog')->__('Are you sure?').'\', \''.$this->getDeleteUrl().'\')',
                            'class'  => 'delete'
                        ))
                );
            }

            if ($this->getProduct()->isDuplicable()) {
                $this->setChild('duplicate_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                        'label'     => Mage::helper('catalog')->__('Duplicate'),
                        'onclick'   => 'setLocation(\'' . $this->getDuplicateUrl() . '\')',
                        'class'  => 'add'
                    ))
                );
            }
        }

        if ( Mage::helper('productlink')->canViewProduct( $this->getProduct() ) ) {
            $this->setChild('view_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                        'label'     => Mage::helper('catalog')->__('View'),
                        'onclick'   => 'window.open(\''.Mage::getUrl($this->getProduct()->getUrlPath()).'\')',
                        'class'     => 'view'
                ))
            );
        }

        return parent::_prepareLayout();
    }

    public function getViewButtonHtml() {
        return $this->getChildHtml('view_button');
    }

}