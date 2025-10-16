@extends('layouts.admin')
@section('title', 'Подписки')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item active" aria-current="page">Все Подписчики</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Подписчики: {{ count($subscribers) }}</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Список подписчиков</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($subscribers))

                                <form action="{{ route('admin.subscribers.clear') }}" method="post" class="float-left">
                                    @csrf
                                    <button type="submit" class="btn btn-danger mb-4 mr-3" onclick="return confirm('Подтвердите удаление')">Удалить все записи</button>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Дата</th>
                                            <th>Имя</th>
                                            <th>Почта</th>
                                            <th>Телефон</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subscribers as $subscriber)
                                            <tr>
                                                <td>{{ $subscriber->id }}</td>
                                                <td>{{ $subscriber->created_at }}</td>
                                                <td>{{ $subscriber->name }}</td>
                                                <td>{{ $subscriber->email }}</td>
                                                <td>{{ $subscriber->telephone }}</td>
                                                <td>
                                                    <form action="{{ route('admin.subscribers.destroy', ['subscriber' => $subscriber->id]) }}" method="post" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Подтвердите удаление')">
                                                            <i
                                                                    class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Подписчиков пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div>{{ $subscribers->links() }}</div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

