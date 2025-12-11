<x-seller-layout title="Orders">

<div class="seller-card">
    <table class="table">
        <tr>
            <th>Invoice</th>
            <th>Status</th>
            <th></th>
        </tr>

        @foreach ($orders as $o)
        <tr>
            <td>#{{ $o->id }}</td>
            <td>{{ $o->status }}</td>
            <td>
                <a href="{{ route('seller.orders.index', $o->id) }}" class="text-blue-500">View</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

</x-seller-layout>