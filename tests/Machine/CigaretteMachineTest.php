<?php
namespace Tests\Machine;

use App\Entities\CigaretteEntity;
use App\Entities\CigaretteTransactionEntity;
use App\Exceptions\NotEnoughCreditException;
use App\Machine\CigaretteMachine;
use Tests\MainTestCase;

class CigaretteMachineTest extends MainTestCase
{
    protected $cigratteTransactionEntity;
    public function setUp(): void
    {
        parent::setUp();
        $this->cigratteTransactionEntity= new CigaretteTransactionEntity();
        $this->cigratteTransactionEntity->setItemQuantity($this->getItemQuantity());
        $this->cigratteTransactionEntity->setPaidAmount($this->getPaidAmount());
    }

    public function testExecuteMethodReturnObj()
    {
        $cigaretteEntity= (new CigaretteMachine())->execute($this->cigratteTransactionEntity);
        $this->assertInstanceOf(CigaretteEntity::class,$cigaretteEntity);

        $this->assertIsArray($cigaretteEntity->getChange());
        $this->assertEquals($this->cigratteTransactionEntity->getChange(), $cigaretteEntity->getChange());
    }


    public function testNotSuffecientCredit()
    {
        $cigratteTransactionEntity= new CigaretteTransactionEntity();
        $cigratteTransactionEntity->setItemQuantity(3);
        $cigratteTransactionEntity->setPaidAmount(10);

        $this->expectException(NotEnoughCreditException::class);
        $cigaretteEntity= (new CigaretteMachine())->execute($cigratteTransactionEntity);
    }
}