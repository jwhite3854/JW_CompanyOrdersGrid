<?php

class JW_CompanyOrdersGrid_Model_Observer {

    public function beforeBlockToHtml(Varien_Event_Observer $observer) {
        $grid = $observer->getBlock();

        if ($grid instanceof Mage_Adminhtml_Block_Sales_Order_Grid) {
            $grid->addColumnAfter(
                    'company', array(
                'header' => Mage::helper('customer')->__('Company Name'),
                'index' => 'company'
                    ), 'billing_name'
            );

        }
    }

    public function beforeCollectionLoad(Varien_Event_Observer $observer) {
        $collection = $observer->getOrderGridCollection();

        $tableName = Mage::getSingleton("core/resource")->getTableName('sales_flat_order_address');
        $collection->getSelect()->join($tableName, "main_table.entity_id = $tableName.parent_id AND $tableName.address_type='billing'", array('company'));
    }
    
    public function beforeInvoiceCollectionLoad(Varien_Event_Observer $observer) {
        $collection = $observer->getOrderGridCollection();

        $tableName = Mage::getSingleton("core/resource")->getTableName('sales_flat_order_address');
        $collection->getSelect()->join($tableName, "main_table.order_id = $tableName.parent_id AND $tableName.address_type='billing'", array('company'));
    }

}
