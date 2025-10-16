@extends('layouts.admin')
@section('title', 'Заявки')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item active" aria-current="page">Все Заявки</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Заявки: {{ count($requests) }}</h1>
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
                            <h3 class="card-title">Список заявок</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($requests))

                            <form action="{{ route('admin.requests.clear') }}" method="post" class="float-left">
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
                                            <th>Телефон</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($requests as $request)
                                            <tr>
                                                <td>{{ $request->id }}</td>
                                                <td>{{ $request->created_at }}</td>
                                                <td>{{ $request->name }}</td>
                                                <td>{{ $request->phone }}</td>
                                                <td>
                                                    <form action="{{ route('admin.requests.destroy', ['request' => $request->id]) }}" method="post" class="float-left">
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
                                <p>Заявок пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div>{{ $requests->links() }}</div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

