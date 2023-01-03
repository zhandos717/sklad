<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">

    <title>Popup example</title>
    <style>
        body {
            overflow: hidden;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .content-container {
            overflow: auto;
            flex-grow: 1;
        }

        .buttons-container {
            padding-top: 15px;
            min-height: 55px;
        }
    </style>
    <link rel="stylesheet" href="/assets/css/uikit.css">
</head>

<body>
<div class="main-container">
    <div class="content-container">
        @if(isset($items))
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Наименование</th>
                    <th>Цена</th>
                    <th>Количество</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->quantity}}</td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                <tr>
                    <th colspan="2"> Сумма товаров</th>
                    <th colspan="2">   {{ $items->sum('total') }}</th>
                </tr>
                </tfoot>

            </table>
        @endif
    </div>
    <div class="buttons-container">
        <button class="button button--success">Сохранить</button>
        <button class="button">Отмена</button>
    </div>
</div>
</body>
</html>



