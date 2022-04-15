<?php
namespace Tests\Entities;

use App\Entities\CigaretteTransactionEntity;
use Tests\MainTestCase;

class CigaretteTransactionEntityTest extends MainTestCase
{

    protected $entity;
    public function setUp(): void
    {
        parent::setUp();
        $this->entity= new CigaretteTransactionEntity();
        $this->entity->setItemQuantity($this->getItemQuantity());
        $this->entity->setPaidAmount($this->getPaidAmount());
    }


    public function testEntityAttributes()
    {
        $this->assertEquals($this->getPaidAmount(), $this->entity->getPaidAmount());
        $this->assertEquals($this->getItemQuantity(), $this->entity->getItemQuantity());
    }


    public function testEntityAttributesValues()
    {
        $itemQuantity= 2;
        $paidAmount= 12;
        $this->entity= new CigaretteTransactionEntity();
        $this->entity->setItemQuantity($itemQuantity);
        $this->entity->setPaidAmount($paidAmount);

        $this->assertEquals($paidAmount, $this->entity->getPaidAmount());
        $this->assertEquals($itemQuantity, $this->entity->getItemQuantity());
    }

}