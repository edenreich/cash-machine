<?php

namespace App\Interfaces;

interface CashMachineInterface
{
	/**
	 * Withdraws an amount for the client.
	 *
	 * @param float | $amount
	 * @return array
	 */
	public function withdraw($amount) : array;
}