@extends('layouts.admin')

@section('title', 'Редактировать цену')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.prices') }}">Цены</a>
        </li>
        <li class="breadcrumb-item active">
            Редактировать цену
        </li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>Редактировать цену</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.prices.update', $price) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Основная информация</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Название карточки</label>

                            <textarea
                                    name="title"
                                    id="title"
                                    rows="2"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Например: Абонемент&#10;на 4 занятия"
                            >{{ old('title', $price->title) }}</textarea>

                            @error('title')
                            <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>

                            <textarea
                                    name="description"
                                    id="description"
                                    rows="3"
                                    class="form-control"
                            >{{ old('description', $price->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Цена</label>

                            <input
                                    type="text"
                                    name="price"
                                    id="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price', $price->price) }}"
                                    placeholder="Например: 4500 или по запросу"
                            >

                            @error('price')
                            <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sort_order">
                                Порядок отображения
                            </label>

                            <input
                                    type="number"
                                    name="sort_order"
                                    id="sort_order"
                                    class="form-control"
                                    value="{{ old('sort_order', $price->sort_order) }}"
                                    min="0"
                            >
                        </div>

                        <div class="form-check">
                            <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    id="is_active"
                                    class="form-check-input"
                                    {{ old('is_active', $price->is_active) ? 'checked' : '' }}
                            >

                            <label class="form-check-label" for="is_active">
                                Показывать карточку на сайте
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            Список преимуществ
                        </h3>

                        <button
                                type="button"
                                class="btn btn-success btn-sm"
                                id="add-price-item"
                        >
                            <i class="fas fa-plus"></i>
                            Добавить пункт
                        </button>
                    </div>

                    <div class="card-body">
                        <div id="price-items">
                            @foreach($price->items as $index => $item)
                                <div class="price-item border rounded p-3 mb-3">
                                    <div class="form-row align-items-end">
                                        <div class="col-md-9">
                                            <label>Текст пункта</label>

                                            <input
                                                    type="text"
                                                    name="items[{{ $index }}][title]"
                                                    class="form-control"
                                                    value="{{ old("items.$index.title", $item->title) }}"
                                                    required
                                            >
                                        </div>

                                        <div class="col-md-2">
                                            <label>Порядок</label>

                                            <input
                                                    type="number"
                                                    name="items[{{ $index }}][sort_order]"
                                                    class="form-control"
                                                    value="{{ old("items.$index.sort_order", $item->sort_order) }}"
                                                    min="0"
                                            >
                                        </div>

                                        <div class="col-md-1">
                                            <button
                                                    type="button"
                                                    class="btn btn-danger remove-price-item"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <p
                                id="empty-items-message"
                                class="text-muted mb-0"
                                style="{{ $price->items->count() ? 'display:none' : '' }}"
                        >
                            Пункты пока не добавлены.
                        </p>
                    </div>
                </div>

                <div class="mb-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Сохранить изменения
                    </button>

                    <a href="{{ route('admin.prices') }}"
                       class="btn btn-secondary">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const itemsContainer = document.getElementById('price-items');
        const addButton = document.getElementById('add-price-item');
        const emptyMessage = document.getElementById('empty-items-message');

        let itemIndex = {{ $price->items->count() }};

        function updateEmptyMessage() {
          emptyMessage.style.display =
            itemsContainer.children.length === 0 ? 'block' : 'none';
        }

        addButton.addEventListener('click', function () {
          const item = document.createElement('div');

          item.className = 'price-item border rounded p-3 mb-3';

          item.innerHTML = `
                    <div class="form-row align-items-end">
                        <div class="col-md-9">
                            <label>Текст пункта</label>

                            <input
                                type="text"
                                name="items[${itemIndex}][title]"
                                class="form-control"
                                placeholder="Например: Обратная связь от тренера"
                                required
                            >
                        </div>

                        <div class="col-md-2">
                            <label>Порядок</label>

                            <input
                                type="number"
                                name="items[${itemIndex}][sort_order]"
                                class="form-control"
                                value="${itemIndex}"
                                min="0"
                            >
                        </div>

                        <div class="col-md-1">
                            <button
                                type="button"
                                class="btn btn-danger remove-price-item"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;

          itemsContainer.appendChild(item);
          itemIndex++;

          updateEmptyMessage();
        });

        itemsContainer.addEventListener('click', function (event) {
          const removeButton =
            event.target.closest('.remove-price-item');

          if (!removeButton) {
            return;
          }

          removeButton.closest('.price-item').remove();

          updateEmptyMessage();
        });

        updateEmptyMessage();
      });
    </script>
@endpush
