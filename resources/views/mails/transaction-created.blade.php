<x-mail::message>

    # Order Created

    =============================================

    Jl. Kober No.14, RT.6/RW.2, Balekambang, Kec. Kramat jati, Kota Jakarta Timur, Daerah Khusus
    Ibukota Jakarta 13530

    =============================================

    Code: #{{ $transaction->code }}
    Date: {{ \Carbon\Carbon::parse($transaction->created_at)->isoFormat('LLL') }}
    Type: {{ ucfirst(str_replace('_', ' ', $transaction->type)) }}
    Payment Method: {{ \Illuminate\Support\Str::ucfirst($transaction->payment_method) }}
    Delivery Option: {{ ucfirst(str_replace('_', ' ', $transaction->delivery_option ?? 'Self-service')) }}
    Delivery Fee: {{ "Rp. " . number_format($transaction->delivery_fee, 0 , '.' , ',') }}

    =============================================

    Items:
    @foreach($transaction->items as $item)
- {{ $item->product?->name }} x{{ $item->qty }} {{ $item->product?->unit }} | {{ "Rp. " . $item->price }}
    @endforeach

    =============================================

    Total: {{ "Rp. " . number_format($transaction->total_price + $transaction->delivery_fee, 0 , '.' , ',') }}
</x-mail::message>
