<h1>Новая {{ $requestData->email ? 'подписка' : 'заявка'}} с сайта a5chess.ru</h1>
<p>Имя: {{ $requestData->name }}</p>
@if($requestData->email)
    <p>Почта: {{ $requestData->email }}</p>
@endif
@if($requestData->phone)
    <p>Телефон: {{ $requestData->phone }}</p>
@endif
<p>Позиция: {{ $requestData->place }}</p>
