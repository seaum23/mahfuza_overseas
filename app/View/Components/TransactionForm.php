<?php

namespace App\View\Components;

use App\Models\Account;
use Illuminate\View\Component;

class TransactionForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $accounts = Account::where('payment_account', 0)->get();
        $payment_accounts = Account::where('payment_account', 1)->get();
        return view('components.transaction-form', [
            'accounts' => $accounts,
            'payment_accounts' => $payment_accounts,
        ]);
    }
}
