@php
    $classicCounter = 1;
    $rapidCounter = 1;
@endphp

<section class="block-rating {{ $type }}">
    <h2 class="block-rating__title second-title" id="students-rating" >Топ рейтинг учеников клуба&nbsp;А5</h2>
    <ul class="block-rating__list">
        <li class="block-rating__item"   >
            <h3 class="block-rating__subtitle">Быстрые шахматы&#160;| Рейтинг ФШР</h3>
            <time class="block-rating__time" datetime="{{ date('Y-m-01') }}"><span class="block-rating__time-month">{{ \App\Src\Functions::getMonth() }}</span> <span
                        class="block-rating__time-day">01</span> <span class="block-rating__time-year">{{ date('Y') }}</span></time>
            <p class="block-rating__description">Рейтинг учеников клуба по быстрым шахматам. Быстрые шахматы – это разновидность игры в шахматы, где каждому игроку дается от 10 до 60 минут на всю партию и при этом запись ходов не ведется</p>
            <ol class="block-rating__students-list students-list">
                @foreach($rapidRatings as $rapidRating)
                    <li class="students-list__item student-rating">
                        <picture class="student-rating__image-wrapper">
{{--                            <source media="(min-width: 1200px)" srcset="images/students/grishin-makar.webp" type="image/webp" width="110" height="110">
                            <source media="(min-width: 1200px)" srcset="images/students/grishin-makar.jpg" type="image/webp" width="110" height="110">--}}
                            <source srcset="{{ \App\Src\Functions::jpgToWebp($rapidRating->photo) }}" type="image/webp" width="90" height="90">
                            <img class="student-rating__image" src="{{ $rapidRating->photo }}" alt=" {{ $rapidRating->name }}." width="90" height="90">
                        </picture>
                        <div class="student-rating__order">{{ $rapidCounter++ }}</div>
                        <div class="student-rating__name">{{ $rapidRating->name }}</div>
                        <div class="student-rating__number">{{ $rapidRating->rating_rapid }}</div>
                        <div class="student-rating__change-line
                            @isset($rapidRating->rating_rapid_change_class)
                            student-rating__change-line--{{ $rapidRating->rating_rapid_change_class }}
                            @endisset
                        "></div>
                        <div class="student-rating__change">
                            @if($rapidRating->rating_rapid_change == 0)
                                не изменился
                            @else
                                {{ \App\Src\Functions::addPlusToInt($rapidRating->rating_rapid_change) }} за месяц
                            @endif
                        </div>
                    </li>
                @endforeach
            </ol>
        </li>
        <li class="block-rating__item" style="display: none" >
            <h3 class="block-rating__subtitle">Классические шахматы&#160;| Рейтинг ФШР</h3>
            <time class="block-rating__time" datetime="{{ date('Y-m-01') }}"><span class="block-rating__time-month"> {{ \App\Src\Functions::getMonth() }}</span> <span
                        class="block-rating__time-day">01</span> <span class="block-rating__time-year">{{ date('Y') }}</span></time>
            <p class="block-rating__description">Рейтинг учеников клуба по&nbsp;классическим шахматам. Классические шахматы – это разновидность игры в шахматы, где&nbsp;каждому игроку дается от 60 минут и должна вестись запись партии</p>
            <ol class="block-rating__students-list students-list">
                @foreach($classicRatings as $classicRating)
                    <li class="students-list__item student-rating">
                        <picture class="student-rating__image-wrapper">
    {{--                        <source media="(min-width: 1200px)" srcset="images/students/grishin-makar.webp" type="image/webp" width="110" height="110">
                            <source media="(min-width: 1200px)" srcset="images/students/grishin-makar.jpg" type="image/webp" width="110" height="110">--}}
                            <source srcset="{{ \App\Src\Functions::jpgToWebp($classicRating->photo) }}" type="image/webp" width="90" height="90">
                            <img class="student-rating__image" src="{{ $classicRating->photo }}" alt="{{ $classicRating->name }}." width="90" height="90">
                        </picture>
                        <span class="student-rating__order">{{ $classicCounter++ }}</span>
                        <div class="student-rating__name">{{ $classicRating->name }}</div>
                        <span class="student-rating__number">{{ $classicRating->rating_classic }}</span>
                        <div class="student-rating__change-line
                            @isset($classicRating->rating_classic_change_class)
                                student-rating__change-line--{{ $classicRating->rating_classic_change_class }}
                            @endisset
                        "></div>
                        <span class="student-rating__change">
                            @if($classicRating->rating_classic_change == 0)
                                не изменился
                            @else
                                {{ \App\Src\Functions::addPlusToInt($classicRating->rating_classic_change) }} за месяц
                            @endif
                        </span>
                    </li>
                @endforeach
            </ol>
        </li>
    </ul>
    <div class="block-rating__toggle">
        <button class="block-rating__toggle-rapid block-rating__toggle-rapid--active" type="button">Быстрые</button>
        <button class="block-rating__toggle-classic" type="button">Классика</button>
    </div>
    <!--<button class="block-rating__button button button--secondary">Смотреть всех учеников</button>-->
</section>
