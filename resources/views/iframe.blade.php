@extends('moysklad.layouts')

@section('styles')

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .container {
            max-width: 960px;
        }
    </style>

@endsection

@section('content')

    <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Информация о пользователе</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Tекущий пользователь: </h6>
                        <small class="text-muted">{{ $uid ?? null  }}</small>
                    </div>
                    <span class="text-muted">({{ $fullName ?? null }})/span>
                </li>

            </ul>

        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Форма настроек</h4>
            <form method="post" action="{{ route('update.settings')  }}" class="needs-validation" novalidate="">
                @csrf
                <input type="hidden" name="accountId" value="{{$accountId ?? null}}"/>

                <div class="row gy-3">
                    <div class="col-md-12">
                        <label for="cc-name" class="form-label">Токен WIPON</label>
                        <input type="text" class="form-control" id="token" placeholder="" required>
                        <small class="text-muted">заполните поле</small>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>

                </div>
                <hr class="my-4">
                <button class="w-100 btn button button--success btn-lg text-white" type="submit">Сохранить</button>
            </form>
        </div>
    </div>


    <h2>Форма настроек</h2>
    <div class="markup-example js-example">
        <form method="post" action="{{ route('update.settings')  }}">
            @csrf


            <label>
                Введите токен Prosklada:

                <input class="ui-input" type="text" name="token">
            </label>

            <button class="button button--success">Сохранить</button>
        </form>
    </div>
    Настройки доступны только администратору аккаунта

    <h2>Информация о пользователе</h2>

    <ul>
        <li>Текущий пользователь:  </li>
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

@endsection


