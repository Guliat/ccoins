@extends('main')
@section('content')
<form action="{{ route('manage.coins.store') }}" method="post">
    @csrf
    <div class="columns is-multiline">
        <div class="column is-12 mt-5"></div>
        <div class="column is-4"></div>
        <div class="column is-4 box py-5 px-5">
            <div class="field">
                <label class="label">Symbol <small>(BTC)</small></label>
                <div class="control">
                    <input class="input" type="text" placeholder="BTC" name="symbol">
                </div>
            </div>
            <div class="field">
                <label class="label">Full Name <small>(Bitcoin)</small></label>
                <div class="control">
                    <input class="input" type="text" placeholder="Bitcoin" name="name">
                </div>
            </div>  
            <div class="field">
                <label class="label">API Link <small>(bitcoin)</small></label>
                <div class="control">
                    <input class="input" type="text" placeholder="bitcoin" name="api_link">
                </div>
            </div> 
            <div class="field is-grouped pt-4">
                <div class="control">
                    <button type="submit" class="button is-success ">Create</button>
                </div>
                <div class="control">
                    <a href={{ route('manage.coins.index') }} class="button is-danger is-outlined">Cancel</a>
                </div>
            </div>
        </div>
        <div class="column is-4"></div>
    </div>
</form>
@endsection