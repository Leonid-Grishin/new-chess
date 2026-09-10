@extends('layouts.admin')

@section('title', 'Цены')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item active" aria-current="page">
            Цены
        </li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Цены</h1>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">
                                Список цен
                            </h3>

                            <a href="{{ route('admin.prices.create') }}"
                               class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Добавить цену
                            </a>
                        </div>

                        <div class="card-body">

                            @if($prices->count())
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 60px">ID</th>
                                            <th>Название</th>
                                            <th>Описание</th>
                                            <th style="width: 150px">Цена</th>
                                            <th>Список</th>
                                            <th style="width: 100px">Порядок</th>
                                            <th style="width: 100px">Статус</th>
                                            <th style="width: 150px">Действия</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($prices as $price)
                                            <tr>
                                                <td>
                                                    {{ $price->id }}
                                                </td>

                                                <td>
                                                    <strong>
                                                        {!! nl2br(e($price->title)) !!}
                                                    </strong>
                                                </td>

                                                <td>
                                                    @if($price->description)
                                                        {{ $price->description }}
                                                    @else
                                                        <span class="text-muted">
                                                            Не указано
                                                        </span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($price->price)
                                                        <strong>
                                                            {{ $price->price }}
                                                        </strong>

                                                        @if(is_numeric($price->price))
                                                            ₽
                                                        @endif
                                                    @else
                                                        <span class="text-muted">
                                                            По запросу
                                                        </span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($price->items->count())
                                                        <ul class="mb-0 pl-3">
                                                            @foreach($price->items as $item)
                                                                <li>
                                                                    {{ $item->title }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span class="text-muted">
                                                            Пунктов нет
                                                        </span>
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    {{ $price->sort_order }}
                                                </td>

                                                <td class="text-center">
                                                    @if($price->is_active)
                                                        <span class="badge badge-success">
                                                            Активна
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">
                                                            Скрыта
                                                        </span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.prices.edit', ['price' => $price->id]) }}"
                                                       class="btn btn-info btn-sm"
                                                       title="Редактировать">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form action="{{ route('admin.prices.destroy', ['price' => $price->id]) }}"
                                                          method="post"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="btn btn-danger btn-sm"
                                                                title="Удалить"
                                                                onclick="return confirm('Подтвердите удаление цены')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info mb-0">
                                    Цены пока не добавлены.
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
