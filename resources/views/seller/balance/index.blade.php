<x-seller-layout title="Store Balance">

<div class="seller-card">

    <h2 class="text-xl font-bold">Current Balance: Rp {{ number_format($balance,0,',','.') }}</h2>

    <h3 class="mt-6 mb-3 font-semibold">Balance History</h3>

    <table class="table">
        @foreach ($history as $h)
        <tr>
            <td>{{ $h->type }}</td>
            <td>Rp {{ number_format($h->amount,0,',','.') }}</td>
            <td>{{ $h->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
    </table>

</div>

</x-seller-layout>
