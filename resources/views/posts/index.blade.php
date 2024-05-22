<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Listagem de posts</h1>

    @forelse($posts as $post)
        <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }} ({{$post->comments->count()}})</a>
        <hr>
    @empty
        <p>Nenhum post cadastrado!</p>
    @endforelse

    {!! $posts->links() !!}
</body>
</html>