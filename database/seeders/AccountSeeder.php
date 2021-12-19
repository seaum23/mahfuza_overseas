<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            [
                'account' => 'Accounts receivable / পাবো',
                'payment_account' => '0',
                'account_type' => 'asset',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'account' => 'Accounts payable / পাবে',
                'payment_account' => '0',
                'account_type' => 'liability',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'account' => 'Cash',
                'payment_account' => '1',
                'account_type' => 'asset',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'account' => 'Visa Purchase',
                'payment_account' => '0',
                'account_type' => 'asset',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'account' => 'Visa sale',
                'payment_account' => '0',
                'account_type' => 'revenue',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'account' => 'Delegate Comission',
                'payment_account' => '0',
                'account_type' => 'revenue',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'account' => 'Agent Comission',
                'payment_account' => '0',
                'account_type' => 'expense',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'account' => 'Ticket Expense',
                'payment_account' => '0',
                'account_type' => 'expense',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'account' => 'Manpower Card Expense',
                'payment_account' => '0',
                'account_type' => 'expense',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'account' => 'Visa Processing Cost',
                'payment_account' => '0',
                'account_type' => 'expense',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
