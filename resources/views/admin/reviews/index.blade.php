@extends('layouts.admin')
@section('title', 'Отзывы')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item active" aria-current="page">Все Отзывы</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Отзывы о школе А5</h1>
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
                            <h3 class="card-title">Список отзывов</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary mb-3">Добавить
                                отзыв</a>
                            @if (count($reviews))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Имя</th>
                                            <th>Дата</th>
                                            <th>Отзыв</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($reviews as $review)
                                            <tr>
                                                <td>{{ $review->id }}</td>
                                                <td>{{ $review->name }}</td>
                                                <td>{{ $review->created_at }}</td>
                                                <td>{{ $review->description }}</td>
                                                <td>

                                                    <a href="{{ route('admin.reviews.show', ['review' => $review->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.reviews.edit', ['review' => $review->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form action="{{ route('admin.reviews.destroy', ['review' => $review->id]) }}" method="post" class="float-left">
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
                                <p>Отзывов пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            {{ $reviews->links() }}
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

