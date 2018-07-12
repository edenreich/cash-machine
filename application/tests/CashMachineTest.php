<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use App\Classes\CashMachine;
use App\Interfaces\CashMachineInterface;

use App\Exceptions\NoteUnavailableException;

class CashMachineTest extends TestCase
{
    private $cashMachine;

    public function setUp()
    {
        parent::setUp();

        $this->cashMachine = $this->app->make(CashMachineInterface::class);
    }

    public function tearDown()
    {
        unset($this->cashMachine);
    }

    /**
     *
     * @test 
     */
    public function it_resolves_cashmachine_out_of_the_ioc_container()
    {
        $this->assertInstanceOf(CashMachine::class, $this->cashMachine);
    }

    /**
     * 
     * @test
     * @expectedException \App\Exceptions\NoteUnavailableException 
     */
    public function it_throws_an_exception_when_entering_a_none_availabe_notes_amount()
    {
        $this->cashMachine->withdraw(9.00);
    }

    /**
     * 
     * @test
     * @expectedException \InvalidArgumentException 
     */
    public function it_throws_an_exception_when_entering_invalid_amount()
    {
        $this->cashMachine->withdraw(-130.00);
    }

    /**
     * 
     * @test 
     */
    public function it_returns_an_empty_set_if_null_is_entered()
    {
        $notes = $this->cashMachine->withdraw(0);
    
        $this->assertTrue(is_array($notes));
        $this->assertEmpty($notes);
    }

    /** 
     *
     * @test
     */
    public function it_retrieve_cash_notes_when_a_valid_amount_is_entered()
    {
        $notes = $this->cashMachine->withdraw(90);

        $this->assertEquals([80.00, 10.00], $notes);
    }
}
