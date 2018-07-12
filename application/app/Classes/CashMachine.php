<?php

namespace App\Classes;

use App\Interfaces\CashMachineInterface;

use InvalidArgumentException;
use App\Exceptions\NoteUnavailableException;

class CashMachine implements CashMachineInterface
{
	/**
	 * Stores the available notes.
	 *
	 * @var array
	 */
	protected $notes = [100.00, 80.00, 50.00, 20.00, 10.00];

	/**
	 * Withdraws an amount for the client.
	 *
	 * @param float | $amount
	 * @return array
	 */
	public function withdraw($amount) : array
	{
		if (empty($amount)) {
			return [];
		}

		if ($amount < 0) {
			throw new InvalidArgumentException;
		}	

		$notes = [];
		
		do {
			
			foreach ($this->notes as $note) {
				if ($amount >= $note) {
					$notes[] = $note;
					$amount -= $note;
					break;
				}

				if ($amount % 10 != 0) {
					throw new NoteUnavailableException;
				}
			}

		} while ($amount > 0);


		return $notes;
	}
}
