<?php
namespace Tests;

use PHPUnit\Framework\TestCase;

class MainTestCase extends TestCase
{
    const ITEM_PRICE = 4.99;

    private $itemQuantity;
    private $paidAmount;

    public function setUp() :void
    {
        $this->itemQuantity=2;
        $this->paidAmount=12;
    }

    /**
     * @return float
     */
    public function getTotalAmount() :float
    {
        return $this->itemQuantity * self::ITEM_PRICE;
    }

    /**
     * @return int
     */
    public function getItemQuantity(): int
    {
        return $this->itemQuantity;
    }

    /**
     * @return int
     */
    public function getPaidAmount(): int
    {
        return $this->paidAmount;
    }

    /**
     * @return float|int
     */
    public function getChange()
    {
        $change= $this->getPaidAmount() - $this->getTotalAmount();
        list($count, $coin) = explode('.', $change);
        return [$coin,$count];
    }





}