<?php
namespace App\Machine;
use App\Machine\MachineInterface;
use App\Machine\PurchaseTransactionInterface;
use App\Exceptions\NotEnoughCreditException;
use App\Entities\CigaretteEntity;
/**
 * Class CigaretteMachine
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
    const ITEM_PRICE = 4.99;

    public function execute(PurchaseTransactionInterface $purchaseTransaction)
    {
        $totalAmount = self::ITEM_PRICE * $purchaseTransaction->getItemQuantity();

        if ($purchaseTransaction->getPaidAmount() < $totalAmount)
        {
            $availablePacks = intval( $purchaseTransaction->getPaidAmount() / self::ITEM_PRICE);
            throw new NotEnoughCreditException("Not Enough Credit For Purchase!. ".$purchaseTransaction->getItemQuantity()." packs costs ".$totalAmount."€ However, ".
                $purchaseTransaction->getPaidAmount()."€ can bought you $availablePacks packs of cigarettes for ". self::ITEM_PRICE * $availablePacks."€");
        }

        $change = $purchaseTransaction->getPaidAmount() - $totalAmount;

        $cigaretteEntity= new CigaretteEntity();
        $cigaretteEntity->setItemQuantity($purchaseTransaction->getItemQuantity());
        $cigaretteEntity->setChange($change);
        $cigaretteEntity->setTotalAmount($purchaseTransaction->getPaidAmount());

        return $cigaretteEntity;
    }
}