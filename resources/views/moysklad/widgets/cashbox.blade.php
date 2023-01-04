@extends('moysklad.layouts')
@section('title', 'Popup')
@section('js')
    <script>
        function logReceivedMessage(msg) {
            logMessage("→ Received", msg)
        }

        function logSendingMessage(msg) {
            logMessage("← Sending", msg)
        }

        function logMessage(prefix, msg) {
            const messageAsString = JSON.stringify(msg);
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

                    console.log(data);
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
        }

        $('.button').click(function () {
            const form = $(this).parents('form');
            const button = $(this);
            const buttonId = Number(button.attr('value'));

            if (button.hasClass('require-popup')) {
                const sendingMessage = {
                    "name": "ShowPopupRequest",
                    "messageId": buttonId,
                    "popupName": "formsPopup",
                    "popupParameters": form.serialize()
                };
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
                data: form.serialize(),
                success: function (res, textStatus, jqXHR) {
                    console.log(res.data.view);
                    $('#doing-popup').hide();
                    $('#object').show();
                    $('#object-new').html(res.data.view);
                    print();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#doing-popup').hide();
                    $('#result-error').show();
                }
            });

            return false;
        });
    </script>
@endsection
@section('styles')
 <style>
     .hide{
         display: none;
     }
     @media print {
         #click-form{
             display: none;
         }
         #object-new{
             display: block;
         }
     }
  </style>
@endsection
@section('content')
    <div class="content">
        <div id="object"></div>
        <div class="hide" id="object-new"></div>
        <form action="{{route('sale')}}" id="click-form" method="POST">
            @csrf
            <input hidden name="accountId" value="{{$accountId}}">
            <input hidden name="objectId" value="{{$objectId}}">
            <button class="button button--success" type="submit" value="12">
                Печать чека
            </button>
            <div class="hidden" id="doing-popup">
                <img src="https://i.gifer.com/origin/4d/4dc11d17f5292fd463a60aa2bbb41f6a.gif"
                     style="vertical-align:middle;"/>
                Выполняется "
                <span id="doing-action-name"></span>".
            </div>
            <div class="hidden" id="result-error">⚠ Ошибка при отправке запроса.<br/> Попробуйте позже или обратитесь к
                администратору аккаунта МойСклад.
            </div>
        </form>
    </div>
@endsection
