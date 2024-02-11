<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\TransactionHistory;
use App\Models\TransactionItem;
use Illuminate\Console\Command;

class DeleteAllTransactionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:truncate-transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Delete all transactions and it's related data";

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        TransactionItem::query()->delete();
        TransactionHistory::query()->delete();
        Transaction::query()->delete();

        $this->info('Deleted successfully');
    }
}
