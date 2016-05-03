@extends('layouts.app')
@extends('inc.topo')

@section('content')
    <div class="container content">
        <div class="row">

            <table class="table">
                <thead class="thead-inverse">
                <tr>
                    <th>Rua</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($addresses as $address)
                    <tr>
                        <td>{{ $address->street }} {{ $address->customer->name }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>
@endsection