<?php

namespace D3\Birthdayvoucher\Modules\Application\Model;

use OxidEsales\Eshop\Core\Exception\VoucherException;

/**
 * Class d3_oxvoucher_d3birtdayvoucherdate
 */
class d3_oxvoucher_birtdayvoucherdate extends d3_oxvoucher_birtdayvoucherdate_parent
{
    /**
     * @param array $aVouchers
     * @param float $dPrice
     *
     * @return array
     * @throws VoucherException
     */
    public function checkVoucherAvailability($aVouchers, $dPrice)
    {
        $this->_d3CheckForDate();
        return parent::checkVoucherAvailability($aVouchers, $dPrice);
    }

    /**
     * @return bool
     * @throws VoucherException
     */
    protected function _d3CheckForDate()
    {
        if ($this->oxvouchers__d3voucherexpirationdate->value == '0000-00-00') {
            return true;
        }

        if ($this->oxvouchers__d3voucherexpirationdate->value >= date('Y-m-d')) {
            return true;
        }

        /** @var VoucherException $oEx */
        $oEx = oxNew(VoucherException::class, 'D3_BIRTHDAYVOCHER_EXCEPTION_VOUCHER_ISOUTOFDATE');
        $oEx->setVoucherNr($this->getFieldData('oxvoucherNr'));
        throw $oEx;
    }
}


