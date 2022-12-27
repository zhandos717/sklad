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
                <span class="text-dark">Информация о пользователе</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="my-0">Tекущий пользователь </h6>
                            <small class="text-muted  col-12">{{ $fullName ?? null }}</small>
                        </div>
                        <div class="col-12">
                            <span class="text-muted">{{ $uid ?? null  }}</span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="my-0">Идентификатор аккаунта: </h6>
                        </div>
                        <div class="col-12">
                            <span class="text-muted">{{ $accountId ?? null }} </span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Уровень доступа: </h6>
                    </div>
                    <span
                        class="text-muted">{{ isset($isAdmin) ? 'администратор аккаунта' : 'простой пользователь'}}</span>
                </li>
            </ul>
        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Форма настроек</h4>
            <form method="POST" action="{{ route('update.settings')  }}" class="needs-validation" novalidate="">
                @csrf
                <input type="hidden" name="accountId" value="{{$accountId ?? null}}"/>
                <div class="row gy-3">
                    <div class="col-md-12">
                        <label for="cc-name" class="form-label">Токен WIPON</label>
                        <label for="token"></label>
                        <input type="text" class="form-control" id="token" placeholder="" required="required">
                        <small class="text-muted">заполните поле</small>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <button class="btn button button--success btn-lg text-white" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
