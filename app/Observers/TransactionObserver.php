<?php

namespace App\Observers;

use App\Mail\TransactionStatusMail;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\Mail;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        $transaction->loadAggregate('user', 'email');
        if ($transaction->isDirty('status')) {
            if ($transaction->status == 'pending') {
                TransactionHistory::query()
                    ->create([
                        'transaction_id' => $transaction->id,
                        'description' => 'Admin verification in progress. Please wait for confirmation.'
                    ]);
            } else if ($transaction->status == 'paid') {
                TransactionHistory::query()
                    ->create([
                        'transaction_id' => $transaction->id,
                        'description' => 'Payment verified! Your order is now confirmed for processing.'
                    ]);
            } else if ($transaction->status == 'finish') {
                $description = 'Your order is finished! Ready for pickup at your convenience.';

                TransactionHistory::query()
                    ->create([
                        'transaction_id' => $transaction->id,
                        'description' => $description
                    ]);

                if ($transaction->user_email) {
                    Mail::to($transaction->user_email)->send(new TransactionStatusMail());
                }
            }
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
