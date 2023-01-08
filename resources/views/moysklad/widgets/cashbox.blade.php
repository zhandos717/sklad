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
        <td colspan="4" class="text-center">{{ $items->sum('total')  }} тг.</td>
    </tr>
    <tbody>
</table>

<form method="POST" onsubmit="send(event,this)" action="{{route('sale')}}" id="click-form" method="POST">
    <label>
        <input name="uuid" value="{{ \Ramsey\Uuid\Uuid::uuid4()->toString()  }}" hidden="">
    </label>
    @csrf
    <label>
        <input hidden name="accountId" value="{{$accountId}}">
    </label>
    <label>
        <input hidden name="objectId" id="objectId" value="{{$objectId}}">
    </label>
    <button class="button button--success" type="submit">
        Печать чека
    </button>
    <div class="hidden" id="doing-popup">
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
            </div>
        </div>
        <span id="message">
            </span>
    </div>
</form>

<div id="fiscal-receipt">
</div>
<div class="alert alert-success hidden">
    Операция фискализирована!
</div>

<script>
    function send(e, form) {
        document.querySelector('#doing-popup').classList.toggle('hidden')
        fetch(form.action, {method: 'post', body: new FormData(form)})
            .then((response) => {
                return response.json();
            })
            .then((result) => {
                console.log(result);
                document.querySelector('#fiscal-receipt').innerHTML = result.data.view
                window.print();
                document.querySelector('#doing-popup').classList.toggle('hidden')
                document.querySelector('.alert-success').classList.toggle('hidden')
                document.querySelector('.button').classList.toggle('hidden')
            });
        e.preventDefault();
    }
</script>
