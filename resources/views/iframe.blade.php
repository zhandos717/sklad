@extends('moysklad.layouts')
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

            <div class="alert alert-warning alert-dismissible  fade show hidden" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div x-data="{ open: false }">


                <div x-show="open" @click.outside="open = false">Contents...</div>
            </div>

            <form action="{{route('settings.update')}}" class="needs-validation" novalidate="" onsubmit="send(event,this)">
                @csrf
                <input type="hidden" name="accountId" value="{{$accountId ?? 'e0be3639-7d4c-11ed-0a80-07f300006563'}}"/>
                <div class="row gy-3">
                    <div class="col-md-12">
                        <label for="cc-name" class="form-label">Токен WIPON</label>
                        <input type="text" name="token" class="form-control" required="required">
                        <small class="text-muted">заполните поле</small>
                    </div>
                </div>
                <hr class="my-4">

                <button @click="open = ! open" id="btn" type="submit"
                        class="btn button button--success btn-lg text-white">
                    Toggle
                </button>
            </form>
            <div class="cardDiv">

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function send(e, form) {
            fetch(form.action, {method: 'post', body: new FormData(form)})
                .then(function (response){
                    console.log(response)
                });
            e.preventDefault();
        }
    </script>
@endsection
