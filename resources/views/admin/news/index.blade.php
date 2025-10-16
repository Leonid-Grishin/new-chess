@extends('layouts.admin')
@section('title', 'Все Новости')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item active" aria-current="page">Все Новости</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Новости школы A5</h1>
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
                            <h3 class="card-title">Список категорий</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.news.create') }}" class="btn btn-primary mb-3">Добавить
                                новость</a>
                            @if (count($news))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Заголовок</th>
                                            <th>Дата</th>
                                            <th>Ссылка</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($news as $new)
                                            <tr>
                                                <td>{{ $new->id }}</td>
                                                <td>{{ $new->title }}</td>
                                                <td>{{ $new->date }}</td>
                                                <td>{{ $new->link }}</td>
                                                <td>

                                                    <a href="{{ route('admin.news.show', ['news' => $new->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.news.edit', ['news' => $new->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form action="{{ route('admin.news.destroy', ['news' => $new->id]) }}" method="post" class="float-left">
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
                                <p>Новостей пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            {{ $news->links() }}
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

