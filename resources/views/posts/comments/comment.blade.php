<hr>

@if(auth()->check())

@if(session('success'))
    <div style="padding: 10px; background: green; color: white;">
        {{ session('success') }}
    </div>
    <br>
@endif

@if( $errors->any() )
    <div style="padding:10px; background: orange">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br>
@endif

<form action="{{route('comment.store')}}" method="post" class="form">
    @csrf

    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <div>
        <input type="text" name="title" id="title" placeholder="Título">
    </div>
    <br>
    <div>
        <textarea name="body" id="body" cols="30" rows="10" placeholder="Escreva um comentário..."></textarea>
    </div>

    <div>
        <button type="submit" name="enviar">Enviar</button>
    </div>

</form>
@else
    <p>É necessário fazer o login. <a href="{{route('login')}}">Login</a></p>
@endif

<hr>

<h2>Comentários ({{ $post->comments->count() }})</h2>

@forelse($post->comments as $comment)
    <p><b>{{ $comment->user->name }} comentou:</b></p>
    <p><b>{{ $comment->title }}:</b> {{ $comment->body }}</p>
@empty
@endforelse
