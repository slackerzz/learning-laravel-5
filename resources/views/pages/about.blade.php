@extends('app')

@section('content')
    <h1>About Me</h1>

    @if (count($people))
        <h3>People I like:</h3>
        <ul>
            @foreach($people as $person)
                <li>{{ $person }}</li>
            @endforeach
        </ul>
    @endif
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores deleniti dicta dolore dolorum ex ipsam, laborum, nemo porro quaerat quasi quisquam repellendus soluta veritatis! Culpa doloremque enim hic provident rem.
    </p>
@stop