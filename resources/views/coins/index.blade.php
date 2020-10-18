@extends('main')
@section('content')
  <div class="column is-12 has-text-centered my-5">
    <a href="{{ route('coins.create') }}" class="button is-success is-medium">
      <i class="fas fa-plus"></i>
    </a>
  </div>
@if($coins->isNotEmpty())
  <div class="columns is-marginless is-multiline" id="coins">
    @foreach ($coins as $coin)
      <div class="column is-one-quarter-fullhd is-one-third-desktop has-text-centered">
        <div class="box has-text-centered">
          <div class="pt-1 is-size-3">
            {{ $coin->name }}
          </div>
          <div class="pt-1">
            <span class="tag is-dark is-medium">{{ $coin->symbol }}</span>
          </div>
          <div class="pt-1 is-size-6">
            <b-modal v-model="coin_note_modal_{{ $coin->id }}" has-modal-card trap-focus :destroy-on-hide="false" aria-role="dialog" aria-modal>
              <div class="modal-card" style="width: 350px">
                <form action="{{ route('coin.note.update') }}" method="post">
                @csrf
                @method('put')
                  <header class="modal-card-head">Edit note for coin &nbsp;<b>{{ $coin->name }}</b></header>
                  <section class="modal-card-body">
                    <input type="hidden" name="coin_id" value="{{ $coin->id }}">
                  <textarea name="note" class="textarea">{{ $coin->pivot->note }}</textarea>
                  </section>
                  <footer class="modal-card-foot">
                    <button type="submit" class="button is-success">Save</button>
                    <a class="button is-danger is-outlined" @click="coin_note_modal_{{ $coin->id }} = false">Cancel</a>
                  </footer>
                </form>
              </div>
            </b-modal>
            <hr />
            <span class="has-text-centered is-size-5 heading">Notes</span>
            @if($coin->pivot->note)
              {{ $coin->pivot->note }}
              <br />
            @endif
            <button class="button is-dark is-inverted has-tooltip-arrow has-tooltip-dark" data-tooltip="Edit note" @click="coin_note_modal_{{ $coin->id }} = true">
              <i class="fa fa-marker"></i>
            </button>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@else
  <p class="is-size-5 has-text-centered">
    You must add coins to see them. <br /> Start with big plus button.
  </p>
@endif
@endsection
@section('scripts')
<script>
new Vue({
  el: '#coins',
  data: {
    <?php foreach($coins as $coin) { echo 'coin_note_modal_'.$coin->id.': false, ';} ?>
    },
})
</script>
@endsection