@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <p class="date-t"><span class="glyphicon glyphicon-time"></span>
                {{ date("d/m/Y", strtotime($ticket->date)) }}
            </p>
            <h2 class="title-show">
                {!! $ticket->title !!}
                @include('tickets.partials.status', compact('ticket'))                
            </h2>
            
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            <p >
                Autor: {{ $ticket->author->name }}
            </p>


            <h3>Nuevo Comentario</h3>

            @include('partials.errors')

             {!! Form::open(['route' => ['comments.submit', $ticket->id], 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{ Form::label('comment', 'Comentarios:') }}

                        {{ Form::textarea('comment', null, [
                                'rows'          => 4,
                                'cols'          => 50,
                                'class'         => 'form-control',
                                'placeholder'   => 'Deje su comentario.'
                            ]) 
                        }}
                        
                    </div>
                <button type="submit" class="btn btn-primary">Enviar comentario</button>
 
            {!! Form::close() !!}

            <h3>Comentarios ({{ count($ticket->comments) }})</h3>

            @foreach($ticket->comments as $comment)
                <div class="well well-sm">
                    <p><strong>{{ $comment->user->name }}</strong></p>
                    <p>{{ $comment->comment }}</p>
                    @if($comment->link)
                        <p>
                            <a href="{{ $comment->link }}" rel="nofollow" target="_blank">
                                {{ $comment->link }}
                            </a>
                        </p>
                    @endif
                    <p class="date-t"><span class="glyphicon glyphicon-time"></span> {{ $comment->created_at->format('d/m/Y h:ia') }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
