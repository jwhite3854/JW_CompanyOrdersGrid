<?php

class JW_CompanyOrdersGrid_Helper_Address extends Mage_Customer_Helper_Address
{

    public function getAttributes()
    {
        $this->_attributes = parent::getAttributes();

        if(!isset($this->_attributes['email'])) {
            $config = Mage::getSingleton('eav/config');
            $this->_attributes['email'] = $config->getAttribute('customer', 'email');
        }

        return $this->_attributes;
    }

}