<section class="lessons-price">
    <h2 class="lessons-price__title second-title" id="lessons">Стоимость занятий</h2>
    <div class="lessons-price__slide-number slider-number"><span class="slider-number__wrapper">1</span>/6</div>
    <ul class="lessons-price__list">
        <li class="lessons-price__item lessons-price__item--dark">
            <h3 class="lessons-price__sub-title"><span class="lessons-price__sub-title-accent">Бесплатное</span><br> пробное занятие</h3>
            <p class="lessons-price__description">Для тех, кто хочет<br> попробовать</p>
            <ul class="lessons-price__sub-list">
                <li class="lessons-price__sub-item">Определение уровня игры</li>
                <li class="lessons-price__sub-item">Обратная связь от тренера</li>
                <li class="lessons-price__sub-item">Подбор подходящей группы</li>
                <li class="lessons-price__sub-item">Получение учебной литературы</li>
                <li class="lessons-price__sub-item">Специальные условия для покуки абонементов</li>
            </ul>
            <div class="lessons-price__button-wrapper">
                <button class="lessons-price__button button button--primary" type="button" data-name="{{ \App\Src\Functions::translateRoute(\Illuminate\Support\Facades\Route::currentRouteName()) }} > Цены > записаться на пробное">Записаться на занятие</button>
            </div>
        </li>
        @if($prices->isNotEmpty())
            @foreach($prices as $price)
                <li class="lessons-price__item">
                    <h3 class="lessons-price__sub-title">{!! $price->title !!}</h3>
                    @if($price->price)
                        <p class="lessons-price__price">{{ $price->price }} <span class="lessons-price__price-wrapper">&#8381;</span></p>
                    @else
                        <p class="lessons-price__price">по запросу</p>
                    @endif

                    <p class="lessons-price__description">{{ $price->description }}</p>
                    @if($price->items->isNotEmpty())
                        <ul class="lessons-price__sub-list">
                            @foreach($price->items as $item)
                                <li class="lessons-price__sub-item">{{ $item->title }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="lessons-price__button-wrapper">
                        <button class="lessons-price__button button button--primary" type="button" data-name="{{ \App\Src\Functions::translateRoute(\Illuminate\Support\Facades\Route::currentRouteName()) }} > Цены > записаться на разовое">Записаться на занятие</button>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</section>
