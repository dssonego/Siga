@extends('layouts.app')
@extends('inc.topo')

@section('content')
<div class="container content">
    <div class="row">

        <table class="table">
            <thead class="thead-inverse">
            <tr>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Endereço</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($customers as $customer)

                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->cnpj }}</td>
                    <td>
                        @foreach ($customer->address as $address)
                            {{ $address->zipcode }}<br />
                            {{ $address->street }}<br />
                        @endforeach
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

    </div>
</div>
@endsection