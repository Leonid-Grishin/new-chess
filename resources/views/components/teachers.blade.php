<section class="teachers" id="coach">
    <h2 class="teachers__title second-title">О наших тренерах</h2>
    <p class="teachers__description">Наши тренеры имеют опыт работы с детьми. Стремятся привить детям любовь к самой игре и навык решения сложных задач, находясь в разных ситуациях. Умение слышать и слушать помогает находить подход к каждому ученику.</p>
    <ul class="teachers__list">
        @foreach($teachers as $teacher)
            <li class="teachers__item">
                <picture>
                    <source srcset="{{ \App\Src\Functions::jpgToWebp($teacher->image) }}" type="image/webp" width="740" height="495">
                    <img class="teachers__image" src="{{ $teacher->image }}" alt="{{ $teacher->name }}." width="740" height="495">
                </picture>
                <div class="teachers__item-container">
                    <h3 class="teachers__item-title">{{ $teacher->name }}</h3>
                    <p class="teachers__item-subtitle">{{ $teacher->rank }}</p>
                    @if(isset($teacher->achievements))
                        <ul class="teachers__features">
                            @foreach($teacher->achievements as $achievement)
                                <li class="teachers__features-item">{{ $achievement->title }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</section>
