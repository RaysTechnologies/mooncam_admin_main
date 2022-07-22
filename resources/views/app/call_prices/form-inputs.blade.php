@php $editing = isset($callPrice) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="video_call"
            label="Video Call"
            value="{{ old('video_call', ($editing ? $callPrice->video_call : '')) }}"
            maxlength="255"
            placeholder="Video Call"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="live_streaming"
            label="Live Streaming"
            value="{{ old('live_streaming', ($editing ? $callPrice->live_streaming : '')) }}"
            maxlength="255"
            placeholder="Live Streaming"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="video_call_price_limit"
            label="Video Call Price Limit"
            value="{{ old('video_call_price_limit', ($editing ? $callPrice->video_call_price_limit : '')) }}"
            maxlength="255"
            placeholder="Video Call Price Limit"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="live_streaming_call_price_limit"
            label="Live Streaming Call Price Limit"
            value="{{ old('live_streaming_call_price_limit', ($editing ? $callPrice->live_streaming_call_price_limit : '')) }}"
            maxlength="255"
            placeholder="Live Streaming Call Price Limit"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="photo_price"
            label="Photo Price"
            value="{{ old('photo_price', ($editing ? $callPrice->photo_price : '')) }}"
            maxlength="255"
            placeholder="Photo Price"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="host_profile_id" label="Host Profile" required>
            @php $selected = old('host_profile_id', ($editing ? $callPrice->host_profile_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Host Profile</option>
            @foreach($hostProfiles as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
