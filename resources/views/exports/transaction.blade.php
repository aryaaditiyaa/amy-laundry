<table>
    <thead>
    <tr>
        <th colspan="10" style="text-align: center">Transaction Report</th>
    </tr>
    <tr>
        <td>Code</td>
        <td>Items Count</td>
        <td>Customer Name</td>
        <td>Customer Email</td>
        <td>Customer Phone Number</td>
        <td>Status</td>
        <td>Complaint</td>
        <td>Payment Method</td>
        <td>Created At</td>
        <td>Created By</td>
        <td>Total Price</td>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $item)
        <tr>
            <td>{{ $item->code }}</td>
            <td>{{ $item->items_count }}</td>
            <td>{{ $item->user?->name }}</td>
            <td>{{ $item->user?->email }}</td>
            <td>{{ $item->user?->phone_number }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->complaint?->description }}</td>
            <td>{{ $item->payment_method }}</td>
            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
            <td>{{ $item->creator_name }}</td>
            <td>{{ $item->total_price }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="10" style="text-align: center;font-weight: bold">Total</td>
        <td style="font-weight: bold">{{ $transactions->sum('total_price') }}</td>
    </tr>
    </tbody>
</table>
