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
        $changeReturn=[];
        foreach ($this->change as $key => $value) {
            $changeReturn[]= $key;
            $changeReturn[]= $value;
        }
        return $changeReturn;
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
        $result = $this->countCurrency($change);
        $this->change= $result;
        
    }

    function countCurrency($amount)
    {
        $notes = array(200, 100, 50, 20, 10,5, 1);
        $noteCounter = array(0, 0, 0, 0, 0, 0, 0);
        $change = array();
        for ($i = 0; $i < 6; $i++)
        {
            if ($amount >= $notes[$i])
            {
                $noteCounter[$i] = intval($amount /$notes[$i]);
                $amount = $amount -$noteCounter[$i] * $notes[$i];
            }
        }    
        
        for ($i = 0; $i < 6; $i++)
        {
            if ($noteCounter[$i] != 0 )
            {
                $change[$notes[$i]] = $noteCounter[$i] ;
            }
        }
        return $change;
    }


}