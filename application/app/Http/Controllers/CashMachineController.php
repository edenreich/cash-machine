<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CashMachineInterface as CashMachine;

use InvalidArgumentException;
use App\Exceptions\NoteUnavailableException;

class CashMachineController extends Controller
{
    /**
     * Displays the index page.
     *
     * @return void
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Withdraws money for the client.
     *
     * @param \Illuminate\Http\Request | $request
     * @param \App\Classes\CashMachine | $cashMachine
     * @return JSON
     */
    public function withdraw(Request $request, CashMachine $cashMachine)
    {
        $notes = $cashMachine->withdraw($request->input('notes'));

        return response()->json([
            'notes' => $notes
        ]);
    }
}
