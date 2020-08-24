@extends('main')
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="has-text-centered">
            <div class="is-size-0 has-text-dark mb-0">
                CCoins
            </div>
            <div class="subtitle is-size-6 has-text-dark">
                by aleXandar encheW
            </div>
            <div class="links pt-5">
                <a href="#">ADD TRADE</a>
                <a href="#">ALL TRADES</a>
                <a href="#">TRADES PER EXCHAGE</a>
                <a href="#">TRADES PER COIN</a>
                <a href="#">|</a>
                <a href="{{ route('coins.index') }}">COINS</a>
                <a href="{{ route('exchanges.index') }}">EXCHANGES</a>
            </div>
        </div>
    </div>
@endsection
