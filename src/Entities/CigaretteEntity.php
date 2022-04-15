<?php
namespace App\Entities;

use App\Machine\PurchasedItemInterface;

class CigaretteEntity implements PurchasedItemInterface
{
    /**
     * @var int
     */
    protected $itemQuantity;

    /**
     * @var float
     */
    protected $totalAmount;

    /**
     * @var float
     */
    protected $change;


    public function getItemQuantity(): int
    {
        return $this->itemQuantity;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    /**
     * @return array
     */
    public function getChange() :array
    {
        return $this->change;
    }

    /**
     * @param int $itemQuantity
     */
    public function setItemQuantity(int $itemQuantity)
    {
        $this->itemQuantity = $itemQuantity;
    }

    /**
     * @param float $totalAmount
     */
    public function setTotalAmount(float $totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @param float $change
     */
    public function setChange(float $change)
    {
        list($count,$coin) = explode(".",$change);
        $this->change= [$count,$coin];
    }

}