@php $editing = isset($rechargeAmount) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="amount"
            label="Amount"
            value="{{ old('amount', ($editing ? $rechargeAmount->amount : '')) }}"
            maxlength="255"
            placeholder="Amount"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="token"
            label="Token"
            value="{{ old('token', ($editing ? $rechargeAmount->token : '')) }}"
            maxlength="255"
            placeholder="Token"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="unit"
            label="Unit"
            value="{{ old('unit', ($editing ? $rechargeAmount->unit : '')) }}"
            maxlength="255"
            placeholder="Unit"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $rechargeAmount->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
