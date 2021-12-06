<div class="chat-content">
    {{-- @dump($chat) --}}
    @foreach ($chat as $row)
    <div class="talk-bubble tri-right round {{ $row->id_pengirim == auth()->user()->id ? 'right-top right' : 'left-top left' }}">
        <div class="talktext">
          <p>{{ $row->pesan }}</p>
        </div>
    </div>

    @endforeach
  </div>
