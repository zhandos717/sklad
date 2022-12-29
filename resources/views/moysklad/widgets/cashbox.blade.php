@extends('moysklad.layouts')
@section('title', 'Page Title')
@section('js')
    <script>
        const hostWindow = window.parent;
        const token = "7c4d83ee4b3ce4fa922a1ac9292f59799a7f1a2a";
        const uid = "admin@zhan96";
        const accountId = "e0be3639-7d4c-11ed-0a80-07f300006563";
        const entity = "customerorder";
        let objectId = "";

        window.addEventListener("message", function (event) {
            var receivedMessage = event.data;

            logReceivedMessage(receivedMessage);

            if (receivedMessage.name === 'Open' || receivedMessage.name === 'Save') {
                const oReq = new XMLHttpRequest();
                oReq.addEventListener("load", function () {
                    window.document.getElementById("object").innerHTML = this.responseText;
                    prepareButtons();
                    var sendingMessage = {
                        name: "OpenFeedback",
                        correlationId: receivedMessage.messageId
                    };
                    logSendingMessage(sendingMessage);
                    hostWindow.postMessage(sendingMessage, '*');
                });
                objectId = receivedMessage.objectId;
                oReq.open("GET", "https://kassakz1.nirguna.ru/1/widgets/get-object.php?token=7c4d83ee4b3ce4fa922a1ac9292f59799a7f1a2a&uid=admin@zhan96&accountId=e0be3639-7d4c-11ed-0a80-07f300006563&entity=customerorder&objectId=" + receivedMessage.objectId);
                oReq.send();
            } else if (receivedMessage.name === 'ShowPopupResponse' && receivedMessage.popupName === 'formsPopup' && receivedMessage.popupResolution === 'normal' && (typeof receivedMessage.popupResponse !== 'undefined')) {
                clickButton(receivedMessage.correlationId, receivedMessage.popupResponse);
            }
        });

        function logReceivedMessage(msg) {
            logMessage("→ Received", msg)
        }

        function logSendingMessage(msg) {
            logMessage("← Sending", msg)
        }

        function logMessage(prefix, msg) {
            var messageAsString = JSON.stringify(msg);
            console.log(prefix + " message: " + messageAsString);
        }

        function body() {
            return window.document.body;
        }

        function clickButton(buttonId, popupFormParameters) {
            const form = $('#click-form');
            const button = form.children('button[value=' + buttonId + ']');

            $('#object').hide();
            $('#doing-action-name').text(button.text());
            $('#doing-popup').show();

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: {'buttonId': buttonId, 'popupFormParameters': popupFormParameters},
                success: function (data, textStatus, jqXHR) {
                    $('#doing-popup').hide();
                    $('#object').show();
                    $('#object-new').html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#doing-popup').hide();
                    $('#result-error').show();
                }
            });
        }

        function prepareButtons() {
            if ($('#result-error').css('display') != 'none') {
                $('#result-error').hide();
                $('#object').show();
            }
            if ($('#object-new').css('display') != 'none') {
                $('#object-new').hide();
                $('#object').show();
            }
            $('#click-form button[name="buttonId"]').click(function () {
                var form = $(this).parents('form');
                var button = $(this);
                var buttonId = Number(button.attr('value'));

                if (button.hasClass('require-popup')) {
                    var sendingMessage = {
                        "name": "ShowPopupRequest",
                        "messageId": buttonId,
                        "popupName": "formsPopup",
                        "popupParameters": {
                            "token": token,
                            "uid": uid,
                            "accountId": accountId,
                            "entity": entity,
                            "objectId": objectId,
                            "buttonId": buttonId,
                        }
                    }
                    logSendingMessage(sendingMessage);
                    hostWindow.postMessage(sendingMessage, '*');
                    return false;
                }

                $('#object').hide();
                $('#doing-action-name').text(button.text());
                $('#doing-popup').show();

                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: {'buttonId': button.attr('value')},
                    success: function (data, textStatus, jqXHR) {
                        $('#doing-popup').hide();
                        $('#object').show();
                        $('#object-new').html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('#doing-popup').hide();
                        $('#result-error').show();
                    }
                });

                return false;
            });
        }
    </script>
@endsection
@section('content')
    <div class="content">

        <button type="button" class="btn button button--success btn-lg text-white" data-bs-toggle="modal"
                data-bs-target="#myModal">
            Выбить чек
        </button>

    </div>

    {{--    {{ dump($items) }}--}}


    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Информация о продаже</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
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
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

@stop

