<?php
namespace Tests\Entities;

use App\Entities\CigaretteEntity;
use Tests\MainTestCase;

class CigaretteEntityTest extends MainTestCase
{

    protected $entity;

    public function setUp(): void
    {
        parent::setUp();
        $this->entity= new CigaretteEntity();
        $this->entity->setItemQuantity($this->getItemQuantity());
        $this->entity->setChange($this->getPaidAmount() - $this->getTotalAmount());
        $this->entity->setTotalAmount($this->getTotalAmount());
    }

    public function testEntityAttributes()
    {
        $this->assertEquals($this->getTotalAmount(), $this->entity->getTotalAmount());
        $this->assertEquals($this->getItemQuantity(), $this->entity->getItemQuantity());

        $this->assertIsArray($this->entity->getChange());
        $this->assertEquals($this->getChange(), $this->entity->getChange());
    }

    public function testEntityAttributesValues()
    {
        $itemQuantity= 2;
        $paidAmount= 12;
        $totalAmount= $itemQuantity * self::ITEM_PRICE;
        $change= [02,2];

        $this->entity= new CigaretteEntity();
        $this->entity->setItemQuantity($itemQuantity);
        $this->entity->setChange($paidAmount - $totalAmount);
        $this->entity->setTotalAmount($totalAmount);

        $this->assertEquals($totalAmount, $this->entity->getTotalAmount());
        $this->assertEquals($itemQuantity, $this->entity->getItemQuantity());

        $this->assertIsArray($this->entity->getChange());
        $this->assertEquals($change, $this->entity->getChange());
        $this->assertEquals($change[0], $this->entity->getChange()[0]);
        $this->assertEquals($change[1], $this->entity->getChange()[1]);

    }
}