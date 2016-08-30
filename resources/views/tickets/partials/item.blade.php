<div data-id="{{ $ticket->id }}" class="well well-sm ticket">
    <p class="date-t"><span class="glyphicon glyphicon-time"></span>
        {{ date("d/m/Y", strtotime($ticket->date)) }}
    </p>
    <h4 class="list-title">
        {!! $ticket->title !!}

        @include('tickets.partials.status', compact('ticket'))

        @if(Auth::check() and currentUser()->name == 'juan bupo' and $ticket->status == 'open')
            <p>
                <a href="{{ route('tickets.status', $ticket->id) }}" class="btn btn-default">Finalizar</a>
            </p>
        @endif 

    </h4>
    <p>
        
        <a href="{{ route('tickets.details', $ticket) }}">
            <span class="comments-count">{{ $ticket->num_comments }} comentarios</span>.
        </a>
        
    </p>
</div>