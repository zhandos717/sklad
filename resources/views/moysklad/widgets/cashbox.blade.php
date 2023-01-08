@extends('moysklad.layouts')
@section('title', 'info')
@section('content')
    <table class="ui-table">
        <thead>
        <tr>
            <th>Наименование</th>
            <th>Кол-во</th>
            <th>Цена</th>
            <th>Сумма</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td> {{ $item->product->name  }}</td>
                <td> {{ $item->quantity  }}</td>
                <td> {{ $item->price  }}</td>
                <td> {{ $item->total  }}</td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-size: 200%;">{{ $items->sum('total')  }} тг.</td>
        </tr>
        <tbody>
    </table>
@endsection
