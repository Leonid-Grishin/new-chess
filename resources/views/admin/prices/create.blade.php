@extends('layouts.admin')

@section('title', 'Добавить цену')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.prices') }}">Цены</a>
        </li>
        <li class="breadcrumb-item active">
            Добавить цену
        </li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>Добавить цену</h1>
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

            <form action="{{ route('admin.prices.store') }}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Название</label>

                            <textarea
                                    name="title"
                                    id="title"
                                    rows="2"
                                    class="form-control"
                                    required
                            >{{ old('title') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>

                            <textarea
                                    name="description"
                                    id="description"
                                    rows="3"
                                    class="form-control"
                            >{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Цена</label>

                            <input
                                    type="text"
                                    name="price"
                                    id="price"
                                    class="form-control"
                                    value="{{ old('price') }}"
                                    placeholder="1200 или по запросу"
                            >
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
                                    value="{{ old('sort_order', 0) }}"
                                    min="0"
                            >
                        </div>

                        <div class="form-check mb-4">
                            <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    id="is_active"
                                    class="form-check-input"
                                    {{ old('is_active', true) ? 'checked' : '' }}
                            >

                            <label class="form-check-label" for="is_active">
                                Показывать на сайте
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Список преимуществ
                        </h3>
                    </div>

                    <div class="card-body">
                        <div id="price-items">
                            <div class="price-item border rounded p-3 mb-3">
                                <div class="form-row align-items-end">
                                    <div class="col-md-9">
                                        <label>Пункт</label>

                                        <input
                                                type="text"
                                                name="items[0][title]"
                                                class="form-control"
                                                placeholder="Например: Обратная связь от тренера"
                                        >
                                    </div>

                                    <div class="col-md-2">
                                        <label>Порядок</label>

                                        <input
                                                type="number"
                                                name="items[0][sort_order]"
                                                class="form-control"
                                                value="0"
                                                min="0"
                                        >
                                    </div>

                                    <div class="col-md-1">
                                        <button
                                                type="button"
                                                class="btn btn-danger remove-item"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button
                                type="button"
                                id="add-item"
                                class="btn btn-success"
                        >
                            <i class="fas fa-plus"></i>
                            Добавить пункт
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Сохранить
                </button>

                <a href="{{ route('admin.prices') }}"
                   class="btn btn-secondary">
                    Отмена
                </a>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('price-items');
        const addButton = document.getElementById('add-item');

        let index = 1;

        addButton.addEventListener('click', function () {
          const item = document.createElement('div');

          item.className = 'price-item border rounded p-3 mb-3';

          item.innerHTML = `
                    <div class="form-row align-items-end">
                        <div class="col-md-9">
                            <label>Пункт</label>

                            <input
                                type="text"
                                name="items[${index}][title]"
                                class="form-control"
                                placeholder="Преимущество"
                                required
                            >
                        </div>

                        <div class="col-md-2">
                            <label>Порядок</label>

                            <input
                                type="number"
                                name="items[${index}][sort_order]"
                                class="form-control"
                                value="${index}"
                                min="0"
                            >
                        </div>

                        <div class="col-md-1">
                            <button
                                type="button"
                                class="btn btn-danger remove-item"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;

          container.appendChild(item);
          index++;
        });

        container.addEventListener('click', function (event) {
          const button = event.target.closest('.remove-item');

          if (!button) {
            return;
          }

          button.closest('.price-item').remove();
        });
      });
    </script>
@endpush
