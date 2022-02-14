<?php

use Illuminate\Database\Seeder;

class AccountCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['ACCOUNTS PAYABLE','Liability','Decrease','Increase'],
            ['ACCOUNTS RECEIVABLE','Asset','Increase','Decrease'],
            ['ACCUMULATED DEPRECIATION','Contra Asset','Decrease','Increase'],
            ['ADVERTISING EXPENSE','Expense','Increase','Decrease'],
            ['ALLOWANCE FOR UNCOLLECTIBLE ACCOUNTS','Contra Asset','Decrease','Increase'],
            ['AMORTIZATION EXPENSE','Expense','Increase','Decrease'],
            ['AVAILABLE FOR SALE SECURITIES','Asset','Increase','Decrease'],
            ['Bank Accounts','Asset','Increase','Decrease'],
            ['Bank OD A/c','Liability','Decrease','Increase'],
            ['BONDS PAYABLE','Liability','Decrease','Increase'],
            ['BUILDING','Asset','Increase','Decrease'],
            ['CAPITAL STOCK','Equity','Decrease','Increase'],
            ['CASH','Asset','Increase','Decrease'],
            ['CASH OVER','Revenue','Decrease','Increase'],
            ['CASH SHORT','Expense','Increase','Decrease'],
            ['CHARITABLE CONTRIBUTIONS PAYABLE','Liability','Decrease','Increase'],
            ['COMMON STOCK','Equity','Decrease','Increase'],
            ['COST OF GOODS SOLD','Expense','Increase','Decrease'],
            ['CURRENCY EXCHANGE GAIN','Gain','Decrease','Increase'],
            ['CURRENCY EXCHANGE LOSS','Loss','Increase','Decrease'],
            ['DEPRECIATION EXPENSE','Expense','Increase','Decrease'],
            ['DISCOUNT ON BONDS PAYABLE','Liability','Decrease','Increase'],
            ['DISCOUNT ON NOTES PAYABLE','Contra Liability','Increase','Decrease'],
            ['DIVIDEND INCOME','Revenue','Decrease','Increase'],
            ['DIVIDENDS','Dividend','Increase','Decrease'],
            ['DIVIDENDS PAYABLE','Liability','Decrease','Increase'],
            ['DOMAIN NAME','Asset','Increase','Decrease'],
            ['EMPLOYEE BENEFITS EXPENSE','Expense','Increase','Decrease'],
            ['EQUIPMENT','Asset','Increase','Decrease'],
            ['FEDERAL INCOME TAX PAYABLE','Liability','Decrease','Increase'],
            ['FEDERAL UNEMPLOYMENT TAX PAYABLE','Liability','Decrease','Increase'],
            ['FREIGHT-IN','Part of Calculation of Net Purchases','Increase','Decrease'],
            ['FREIGHT-OUT','Expense','Increase','Decrease'],
            ['FUEL EXPENSE','Expense','Increase','Decrease'],
            ['GAIN','Gain','Decrease','Increase'],
            ['HEALTH/CHILD FLEX PAYABLE','Liability','Decrease','Increase'],
            ['INCOME SUMMARY','Not a Financial Statement Account','Debited for Total Expenses','Credited for Total Revenues'],
            ['INSURANCE EXPENSE','Expense','Increase','Decrease'],
            ['INSURANCE PAYABLE','Liability','Decrease','Increase'],
            ['INTEREST EXPENSE','Expense','Increase','Decrease'],
            ['INTEREST INCOME','Revenue','Decrease','Increase'],
            ['INTEREST PAYABLE','Liability','Decrease','Increase'],
            ['INTEREST RECEIVABLE','Asset','Increase','Decrease'],
            ['INVENTORY','Asset','Increase','Decrease'],
            ['INVESTMENT IN BONDS','Asset','Increase','Decrease'],
            ['INVESTMENT INCOME','Revenue','Decrease','Increase'],
            ['INVESTMENTS','Asset','Increase','Decrease'],
            ['LAND','Asset','Increase','Decrease'],
            ['LOAN PAYABLE','Liability','Decrease','Increase'],
            ['LOAN & ADVANCE','Asset','Increase','Decrease'],
            ['LOSS','Loss','Increase','Decrease'],
            ['MEDICARE/MEDICAID PAYABLE','Liability','Decrease','Increase'],
            ['MISCELLANEOUS EXPENSE','Expense','Increase','Decrease'],
            ['NOTES PAYABLE','Liability','Decrease','Increase'],
            ['NOTES RECEIVABLE','Asset','Increase','Decrease'],
            ['OBLIGATION UNDER CAPITAL LEASE','Liability','Decrease','Increase'],
            ['PAID-IN CAPITAL IN EXCESS OF PAR – COMMON','Equity','Decrease','Increase'],
            ['PAID-IN CAPITAL IN EXCESS OF PAR – PREFERRED','Equity','Decrease','Increase'],
            ['PATENT','Asset','Increase','Decrease'],
            ['PAYROLL TAX EXPENSE','Expense','Increase','Decrease'],
            ['PETTY CASH','Asset','Increase','Decrease'],
            ['POSTAGE EXPENSE','Expense','Increase','Decrease'],
            ['PREMIUM ON BONDS PAYABLE','Liability Adjunct Account','Decrease','Increase'],
            ['PREPAID INSURANCE','Asset','Increase','Decrease'],
            ['PREPAID RENT','Asset','Increase','Decrease'],
            ['PURCHASE DISCOUNTS','Reduces Calculation of Net Purchases','Decrease','Increase'],
            ['PURCHASE DISCOUNTS LOST','Expense','Increase','Decrease'],
            ['PURCHASES','Part of Calculation of Net Purchases','Increase','Decrease'],
            ['PURCHASE RETURNS','Reduces Calculation of Net Purchases','Decrease','Increase'],
            ['RENT EXPENSE','Expense','Increase','Decrease'],
            ['REPAIR EXPENSE','Expense','Increase','Decrease'],
            ['RETAINED EARNINGS','Equity','Decrease','Increase'],
            ['RETIREMENT CONTRIBUTION PAYABLE','Liability','Decrease','Increase'],
            ['REVENUE','Revenue','Decrease','Increase'],
            ['SALARIES EXPENSE','Expense','Increase','Decrease'],
            ['SALARIES PAYABLE','Liability','Decrease','Increase'],
            ['SALES','Revenue','Decrease','Increase'],
            ['SALES DISCOUNTS','Contra Revenue','Increase','Decrease'],
            ['SALES RETURNS','Contra Revenue','Increase','Decrease'],
            ['SERVICE CHARGE','Expense','Increase','Decrease'],
            ['SERVICE REVENUE','Revenue','Decrease','Increase'],
            ['SOCIAL SECURITY PAYABLE','Liability','Decrease','Increase'],
            ['STATE INCOME TAX PAYABLE','Liability','Decrease','Increase'],
            ['STATE UNEMPLOYMENT TAX PAYABLE','Liability','Decrease','Increase'],
            ['SUNDRY CREDITORS','Current liabilities','Decrease','Increase'],
            ['SUNDRY DEBTORS','Current Assets','Increase','Decrease'],
            ['SUPPLIES','Asset','Increase','Decrease'],
            ['SUPPLIES EXPENSE','Expense','Increase','Decrease'],
            ['TRADING SECURITIES','Asset','Increase','Decrease'],
            ['TREASURY STOCK','Contra Equity','Increase','Decrease'],
            ['UNCOLLECTIBLE ACCOUNTS EXPENSE','Expense','Increase','Decrease'],
            ['UNEARNED REVENUE','Liability','Decrease','Increase'],
            ['UNREALIZED GAIN','Gain','Decrease','Increase'],
            ['UNREALIZED LOSS','Loss','Increase','Decrease'],
            ['UNREALIZED GAIN – OTHER COMPREHENSIVE INCOME','Increase in Equity Via Other Comprehensive Income','Decrease','Increase'],
            ['UNREALIZED LOSS – OTHER COMPREHENSIVE INCOME','Decrease in Equity Via Other Comprehensive Income','Increase','Decrease'],
            ['UTILITIES EXPENSE','Expense','Increase','Decrease'],
            ['WARRANTY EXPENSE','Expense','Increase','Decrease'],
            ['WARRANTY LIABILITY','Liability','Decrease','Increase']
        ];

        foreach($data as $obj){

            /*
             *  0 => "ACCOUNTS PAYABLE"
                  1 => "Liability"
                  2 => "Decrease"
                  3 => "Increase"

             * */

            DB::table('account_categories')->insert([
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'ac_name' => $obj[0],
                'ac_type' => $obj[1],
                'dr' => $obj[2],
                'cr' => $obj[3],
                'status' => 1
            ]);
        }
    }
}


