@extends('admin.master')
@section('content')
<div class="page-container my-4">
    <select name="mgid" id="">
        <option value="" disabled {{ old('wid') ? '' : 'selected' }}>المجموعات</option>

        @foreach($memberGroups as $memberGroup)
        <option value="{{ $memberGroup->mgid }}" {{ old('wid') == $memberGroup->mgid ? 'selected' : '' }}>
            {{ $memberGroup->name }}
        </option>
        @endforeach
    </select>

</div>
@endsection