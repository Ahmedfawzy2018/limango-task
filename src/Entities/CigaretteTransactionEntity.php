<?php
namespace App\Entities;
use App\Machine\PurchaseTransactionInterface;

class CigaretteTransactionEntity implements PurchaseTransactionInterface
{

    /**
     * @var float
     */
    protected $paidAmount;

    /**
     * @var int
     */
    protected $itemQuantity;

    /**
     * @return int
     */
    public function getItemQuantity():int
    {
        return  $this->itemQuantity;
    }

    /**
     * @return float
     */
    public function getPaidAmount() :float
    {
        return $this->paidAmount;
    }

    /**
     * @param float $paidAmount
     */
    public function setPaidAmount(float $paidAmount)
    {
        $this->paidAmount = $paidAmount;
    }

    /**
     * @param int $itemQuantity
     */
    public function setItemQuantity(int $itemQuantity)
    {
        $this->itemQuantity = $itemQuantity;
    }


}