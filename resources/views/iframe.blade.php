<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">

    <title>DummyApp</title>
    <meta name="description" content="DummyApp for Marketplace of MoySklad">
    <meta name="author" content="onekludov@moysklad.ru">

    <style>
        body {
            line-height: 1.5;
            font-size: 24px;
            padding-bottom: 200px;
        }

        input {
            font-size: 24px;
        }

        select {
            font-size: 24px;
        }

        .info-box {
            display: inline-block;
            padding: 25px;
        }

        .settings-required {
            border: red dashed 1px;
            background-color: lightsalmon;
        }

        .settings-required::before {
            content: "ТРЕБУЕТСЯ НАСТРОЙКА";
        }

        .ready-for-work {
            border: green dashed 1px;
            background-color: lightgreen;
        }

        .ready-for-work::before {
            content: "ПРИЛОЖЕНИЕ ГОТОВО К РАБОТЕ";
        }
    </style>
</head>
<body>

<h2>Информация о пользователе</h2>

<ul>
    <li>Текущий пользователь: {{ $uid ?? null  }} ({{ $fullName ?? null }})</li>
    <li>Идентификатор аккаунта: {{ $accountId ?? null }}</li>
    <li>Уровень доступа: <b>{{ isset($isAdmin) ? 'администратор аккаунта' : 'простой пользователь'}}</b></li>
</ul>

<h2>Состояние приложения</h2>

<div class="info-box {{ isset($isSettingsRequired) ? 'settings-required' : 'ready-for-work' }}">

    <p>
        Сообщение: {{$infoMessage ?? null}}<br>
        Выбран склад: {{$store ?? null}}
    </p>

</div>

<h2>Форма настроек</h2>

<form method="post" action="{{ route('update.settings')  }}">
    @csrf
    Укажите сообщение:
    <input type="text" size="50" name="infoMessage"><br>
    Выберите склад:
    <select name="store">
        @if(isset($storesValues))
            @foreach ($storesValues as $v)
                <option value="{{$v}}">{{$v}}</option>
            @endforeach
        @endif
    </select><br>
    <input type="hidden" name="accountId" value="{{$accountId??null}}"/>
    <input type="submit">
</form>

Настройки доступны только администратору аккаунта

</body>
</html>
