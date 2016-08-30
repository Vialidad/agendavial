@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
    		<h2>Nueva actividad</h2>

    		<hr>

            @include('partials.errors')
    		
    		{!! Form::open(['route' => 'tickets.store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {{ Form::label('date', 'Fecha') }}

                    {{ Form::date('date',null,['class' => 'form-control']) }}

                    <br>

                    {{ Form::label('title', 'Detalle') }}

                    {{ 
                        Form::textarea('title', null, [
                            'rows'          => 2,
                            'class'         => 'form-control ckeditor',
                            'placeholder'   => 'Describe brevemente de que quieres que se trate el tutorial.'
                        ]) 
                    }}
                    
                </div>

    			<p>
    				<button type="submit" class="btn btn-primary">
		    			Enviar actividad
					</button>		
    			</p>
    		

    		{!! Form::close() !!}
        </div>
    </div>
</div>


@endsection