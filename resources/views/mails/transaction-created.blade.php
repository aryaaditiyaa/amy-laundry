<x-mail::message>
    # Order Created

    Code: #{{ $transaction->code }}
    Date: {{ \Carbon\Carbon::parse($transaction->created_at)->isoFormat('LLL') }}
    Payment Method: {{ \Illuminate\Support\Str::ucfirst($transaction->payment_method) }}

    =============================================

    Items:
    @foreach($transaction->items as $item)
- {{ $item->product?->name }} x{{ $item->qty }} {{ $item->product?->unit }} | {{ "Rp. " . $item->price }}
    @endforeach

    =============================================

    Total: {{ "Rp. " . number_format($transaction->total_price, 0 , '.' , ',') }}

    =============================================

    {{ config('app.name') }}
</x-mail::message>
