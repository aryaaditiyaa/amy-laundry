<?php

namespace App\Exports;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromView, ShouldAutoSize
{
    private $keyword;
    private $startDate;
    private $endDate;
    private $status;

    /**
     * @param $keyword
     * @param $startDate
     * @param $endDate
     * @param $status
     */
    public function __construct($keyword, $startDate, $endDate, $status)
    {
        $this->keyword = $keyword;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
    }

    public function view(): View
    {
        $transactions = Transaction::query()
            ->when($this->keyword, function ($query) {
                return $query->where('code', $this->keyword);
            })
            ->when($this->startDate && !$this->endDate, function ($query) {
                return $query->whereDate('created_at', Carbon::parse($this->startDate)->startOfDay());
            })
            ->when($this->startDate && $this->endDate, function ($query) {
                return $query->whereBetween('created_at', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()]);
            })
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->withAggregate('creator', 'name')
            ->withSum('items as total_price', 'price')
            ->withCount('items')
            ->withWhereHas('user')
            ->get();

        return view('exports.transaction', compact('transactions'));
    }
}
