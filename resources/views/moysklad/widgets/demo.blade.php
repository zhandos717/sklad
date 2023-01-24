@extends('moysklad.layouts')
@section('title', 'Page Title')

@section('styles')
    <style>

        html {
            height: 100%;
            overflow: scroll;
        }

        body {
            line-height: 1;
            font-size: 12px;
            height: 100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            overflow-y: scroll !important;
            overflow-x: hidden !important;
        }

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
        const accountId = '{{$accountId??''}}';
        const entity = "customerorder";
        let objectId = "";

        window.addEventListener("message", function (event) {
            const receivedMessage = event.data;

            objectId = receivedMessage.objectId;

            document.getElementById("objectId").value = objectId;

            logReceivedMessage(receivedMessage);

            console.log(document.documentElement.getBoundingClientRect().height);


            if (receivedMessage.name === 'Open' || receivedMessage.name === 'Save') {
                const oReq = new XMLHttpRequest();
                oReq.addEventListener("load", function () {

                    document.querySelector('#load').classList.add('hidden')

                    window.document.getElementById("table").innerHTML = this.responseText;
                    console.log(receivedMessage.messageId)
                    const sendingMessage = {
                        name: "OpenFeedback",
                        height: document.documentElement.getBoundingClientRect().height,
                        correlationId: receivedMessage.messageId
                    };
                    logSendingMessage(sendingMessage);
                    hostWindow.postMessage(sendingMessage, '*');
                });
                oReq.open("GET", `/widgets/get-item?accountId= ${accountId}&entity=${entity}&objectId=${objectId}`);
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
    <div id="load">
        <img src="{{asset('assets/img/load.gif')}}" style="vertical-align:middle;"/>
        Выполняется "<span id="doing-action-name"></span>".
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
