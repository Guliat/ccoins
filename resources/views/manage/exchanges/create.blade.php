@extends('main')
@section('content')
<form action="{{ route('manage.exchanges.store') }}" method="post">
    @csrf
    <div class="columns is-multiline">
        <div class="column is-12 mt-5"></div>
        <div class="column is-4"></div>
        <div class="column is-4 box py-5 px-5">
            <div class="field">
                <label class="label">Exchange Name <small>(Coinbase)</small></label>
                <div class="control">
                    <input class="input" type="text" placeholder="Coinbase" name="name">
                </div>
            </div>
            <div class="field is-grouped pt-4">
                <div class="control">
                    <button type="submit" class="button is-success ">Create</button>
                </div>
                <div class="control">
                    <a href={{ route('manage.exchanges.index') }} class="button is-danger is-outlined">Cancel</a>
                </div>
            </div>
        </div>
        <div class="column is-4"></div>
    </div>
</form>
@endsection