<x-seller-layout title="Withdraw Balance">

<div class="seller-card">

<form action="{{ route('seller.withdrawal.request') }}" method="POST">
    @csrf

    <label>Bank Name</label>
    <input type="text" name="bank_name" class="form-input mb-3">

    <label>Account Number</label>
    <input type="text" name="account_number" class="form-input mb-3">

    <label>Amount</label>
    <input type="number" name="amount" class="form-input mb-3">

    <button class="seller-btn mt-3">Request Withdrawal</button>
</form>

</div>

</x-seller-layout>