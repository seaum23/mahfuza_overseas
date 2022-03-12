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
            [ // 1
                'account' => 'Accounts receivable / Due',
                'payment_account' => '0',
                'account_type' => 'asset',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 2
                'account' => 'Accounts payable / Payable',
                'payment_account' => '0',
                'account_type' => 'liability',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 3
                'account' => 'Cash',
                'payment_account' => '1',
                'account_type' => 'asset',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 4
                'account' => 'Visa Purchase',
                'payment_account' => '0',
                'account_type' => 'asset',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 5
                'account' => 'Visa sale',
                'payment_account' => '0',
                'account_type' => 'revenue',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 6
                'account' => 'Delegate Comission',
                'payment_account' => '0',
                'account_type' => 'revenue',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 7
                'account' => 'Agent Comission',
                'payment_account' => '0',
                'account_type' => 'expense',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 8
                'account' => 'Ticket Expense',
                'payment_account' => '0',
                'account_type' => 'expense',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 9
                'account' => 'Manpower Card Expense',
                'payment_account' => '0',
                'account_type' => 'expense',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 10
                'account' => 'Visa Processing Cost',
                'payment_account' => '0',
                'account_type' => 'expense',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 11
                'account' => 'Advance Money',
                'payment_account' => '0',
                'account_type' => 'liability',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
