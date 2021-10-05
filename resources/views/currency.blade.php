@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Currencies') }}</div>
                    <div class="card-body">

                        <form action="currency_table" method="GET">
                            @csrf
                            <label for="date"> Date from</label>
                            <input type='date' id="from" name="from" value="{{request('from')}}">
                            <label for="date"> Date to</label>
                            <input type='date' id="to" name="to" value="{{request('to')}}">
                            <button type="submit">Filter</button>
                        </form>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Char code</th>
                                <th>Value</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($currencies as $currency)
                                <tr>
                                    <td>{{ $currency->name }}</td>
                                    <td>{{ $currency->charCode }}</td>
                                    <td>{{ $currency->value }}</td>
                                    <td>{{ $currency->date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No currencies found.</td>
                                </tr>
                            @endforelse
                        </table>
                            {!! $currencies->links()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
