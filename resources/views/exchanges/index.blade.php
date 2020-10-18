@extends('main')
@section('content')
  <div class="column is-12 has-text-centered my-5">
    <a href="{{ route('exchanges.create') }}" class="button is-success is-medium">
      <i class="fas fa-plus"></i>
    </a>
  </div>
@if($exchanges->isNotEmpty())
  <div class="columns is-multiline is-centered is-marginless">
    <div class="column is-5 has-text-centered" id="exchanges">
      @foreach ($exchanges as $exchange)
      <div class="box">
        <div class="pt-1 is-size-2">
          {{ $exchange->name }}
        </div>
        <div class="pt-1 is-size-6">
          <b-modal v-model="exchange_note_modal_{{ $exchange->id }}" has-modal-card trap-focus :destroy-on-hide="false" aria-role="dialog" aria-modal>
            <div class="modal-card" style="width: 350px">
              <form action="{{ route('exchange.note.update') }}" method="post">
              @csrf
              @method('put')
                <header class="modal-card-head">Edit note for exchange &nbsp;<b>{{ $exchange->name }}</b></header>
                <section class="modal-card-body">
                  <input type="hidden" name="exchange_id" value="{{ $exchange->id }}">
                 <textarea name="note" class="textarea">{{ $exchange->pivot->note }}</textarea>
                </section>
                <footer class="modal-card-foot">
                  <button type="submit" class="button is-success">Save</button>
                  <a class="button is-danger is-outlined" @click="exchange_note_modal_{{ $exchange->id }} = false">Cancel</a>
                </footer>
              </form>
            </div>
          </b-modal>
          <hr />
          <span class="has-text-centered is-size-5 heading">Notes</span>
          @if($exchange->pivot->note)
            <pre>{{ $exchange->pivot->note }}</pre>
          @endif
          <button class="button is-dark is-inverted has-tooltip-arrow has-tooltip-dark" data-tooltip="Edit note" @click="exchange_note_modal_{{ $exchange->id }} = true">
            <i class="fa fa-marker"></i>
          </button>
        </div>
      </div>
      @endforeach
    </div>
  </div>
@else
  <p class="is-size-5 has-text-centered">
    You must add exchanges to see them. <br /> Start with big plus button.
  </p>
@endif
@endsection
@section('scripts')
<script>
new Vue({
  el: '#exchanges',
  data: {
    <?php foreach($exchanges as $exchange) { echo 'exchange_note_modal_'.$exchange->id.': false, ';} ?>
    },
})
</script>
@endsection