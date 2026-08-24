@extends('layouts.admin')
@section('title', 'Админка - Клуб')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Страница "Клуб"</h1>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success mx-3">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger mx-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Слайдер — Добавить фото</h2>

        <form enctype="multipart/form-data" method="post" action="{{ route('admin.club.slider.store') }}">
            @csrf
            <div class="card-body">
                <div class="d-flex align-items-flex-start mt-3">

                    <div class="form-group ml-5">
                        <div class="mb-2"><b>Изображение (нужно в jpg), разрешение 780 * 430</b></div>
                        <div class="custom-file" style="width: 300px;">
                            <input type="file" class="custom-file-input" name="image" id="newSlideImage">
                            <label class="custom-file-label" for="newSlideImage" data-browse="Выбрать">
                                Выберите изображение
                            </label>
                        </div>
                        <img id="newSlidePreview" class="mt-3 d-block d-none" src="" alt="Предпросмотр" width="240">
                    </div>

                    <div class="form-group ml-5">
                        <label><b>Alt-текст (описание изображения для SEO)</b>
                            <input type="text" class="form-control mt-1" name="alt"
                                   placeholder="Описание фото" style="width: 300px;">
                        </label>
                    </div>

                    <div class="form-group ml-5">
                        <label><b>Порядок сортировки</b>
                            <input type="number" class="form-control mt-1" name="sort"
                                   value="0" style="width: 100px;">
                        </label>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Добавить слайд</button>
            </div>
        </form>

        <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">
            Слайдер — Текущие фото ({{ $slides->count() }})
        </h2>

        @if($slides->isEmpty())
            <p class="text-center text-muted mt-3">Слайдов пока нет.</p>
        @else
            @foreach($slides as $slide)

                <div class="mt-4 d-flex align-items-flex-start">

                    <div class="form-group ml-5">
                        <div class="mb-2"><b>Фото</b></div>
                        <img src="/images/club/slider/{{ $slide->filename }}.jpg"
                             alt="{{ $slide->alt }}" width="240" class="d-block border">
                        <small class="text-muted">{{ $slide->filename }}</small>
                    </div>

                    <form method="post"
                          action="{{ route('admin.club.slider.update', $slide->id) }}"
                          class="ml-5">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label><b>Alt-текст</b>
                                <input type="text" class="form-control mt-1" name="alt"
                                       value="{{ $slide->alt }}" style="width: 300px;">
                            </label>
                        </div>

                        <div class="form-group">
                            <label><b>Сортировка</b>
                                <input type="number" class="form-control mt-1" name="sort"
                                       value="{{ $slide->sort }}" style="width: 100px;">
                            </label>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" class="custom-control-input"
                                       id="active_{{ $slide->id }}"
                                       name="is_active" value="1"
                                        {{ $slide->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="active_{{ $slide->id }}">
                                    Активен
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
                    </form>

                </div>

                {{-- Форма удаления ВЫНЕСЕНА за div.d-flex --}}
                <form method="post"
                      action="{{ route('admin.club.slider.destroy', $slide->id) }}"
                      class="ml-5 mb-3"
                      onsubmit="return confirm('Удалить слайд?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить слайд</button>
                </form>

                <hr style="height: 20px; background-color: #ffc1071a;">
            @endforeach
        @endif

    </section>

@endsection

@push('scripts')
    <script>
      document.getElementById('newSlideImage').addEventListener('change', function () {
        const preview = document.getElementById('newSlidePreview');
        const file = this.files[0];
        if (file) {
          preview.src = URL.createObjectURL(file);
          preview.classList.remove('d-none');
        }
      });
    </script>
@endpush
