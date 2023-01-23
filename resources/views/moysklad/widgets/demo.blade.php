@extends('moysklad.layouts')
@section('title', 'Page Title')

@section('styles')
    <style>
        #fiscal-receipt {
            display: none;
        }

        @media print {
            #fiscal-receipt {
                display: block;
            }

            #click-form {
                display: none;
            }

            #table {
                display: none;
            }
        }
    </style>
@endsection

@section('js')
    <script>
        const hostWindow = window.parent;

        window.addEventListener("message", function (event) {
            const receivedMessage = event.data;
            if (receivedMessage.name === 'Open' || receivedMessage.name === 'Save') {
                var oReq = new XMLHttpRequest();
                oReq.addEventListener("load", function() {
                    window.document.getElementById("table").innerHTML = this.responseText;
                    hostWindow.postMessage({
                        name: "OpenFeedback",
                        correlationId: receivedMessage.messageId
                    }, '*');
                });
                
                document.getElementById("objectId").value = receivedMessage.objectId;

                oReq.open("GET", '/widgets/get-item?accountId={{$accountId??''}}&entity={{$entity}}&objectId=' + receivedMessage.objectId);
                oReq.send();
            }
        });

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

        function send(e, form) {
            document.querySelector('#doing-popup').classList.toggle('hidden')
            fetch(form.action, {method: 'post', body: new FormData(form)})
                .then((response) => {
                    return response.json();
                })
                .then((result) => {
                    document.querySelector('#fiscal-receipt').innerHTML = result.data.view
                    window.print();
                    document.querySelector('#doing-popup').classList.toggle('hidden')
                    document.querySelector('.alert-success').classList.toggle('hidden')
                    document.querySelector('.button').classList.toggle('hidden')
                });
            e.preventDefault();
        }
    </script>
@endsection

@section('content')
    <div id="table">
    </div>
    <div id="fiscal-receipt">
    </div>
    <div class="alert alert-success hidden">
        Операция фискализирована!
    </div>
    <form method="POST" onsubmit="send(event,this)" action="{{route('sale')}}" id="click-form" method="POST">
        <label>
            <input name="uuid" value="{{ \Ramsey\Uuid\Uuid::uuid4()->toString()  }}" hidden="">
        </label>
        @csrf
        <label>
            <input hidden name="accountId" value="{{$accountId}}">
        </label>
        <label>
            <input hidden name="objectId" id="objectId">
        </label>

        <div class="hidden" id="doing-popup">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                </div>
            </div>
        </div>
        <button class="button button--success" type="submit" value="12">
            Печать чека
        </button>
    </form>
@stop
