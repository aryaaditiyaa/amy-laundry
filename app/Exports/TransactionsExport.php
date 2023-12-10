<?php

namespace App\Exports;

use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings
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


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaction::query()
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
            ->withSum('items as total_price', 'price')
            ->withCount('items')
            ->withWhereHas('user')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Code',
            'Items Count',
            'Customer Name',
            'Customer Email',
            'Customer Phone Number',
//            'Customer Address',
            'Total Price',
            'Status',
            'Payment Method',
            'Created At',
        ];
    }

    public function map($row): array
    {
        return [
            $row->code,
            $row->items_count,
            $row->user?->name,
            $row->user?->email,
            $row->user?->phone_number,
//            $row->user?->address,
            $row->total_price,
            $row->status,
            $row->payment_method,
            Carbon::parse($row->created_at)->format('d-m-Y H:i'),
        ];
    }


}
