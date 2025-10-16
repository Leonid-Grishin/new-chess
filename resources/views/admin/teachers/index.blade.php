@extends('layouts.admin')
@section('title', 'Преподаватели')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item active" aria-current="page">Все Преподаватели</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Преподаватели школы А5</h1>
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
                            <h3 class="card-title">Список преподавателей</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary mb-3">Добавить
                                преподавателя</a>
                            @if (count($teachers))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Порядок сортировки</th>
                                            <th>Имя Фамилия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($teachers as $teacher)
                                            <tr>
                                                <td>{{ $teacher->id }}</td>
                                                <td>{{ $teacher->order }}</td>
                                                <td>{{ $teacher->name }}</td>

                                                <td>

                                                    <a href="{{ route('admin.teachers.edit', ['teacher' => $teacher->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form action="{{ route('admin.teachers.destroy', ['teacher' => $teacher->id]) }}" method="post" class="float-left">
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
                                <p>Учителей пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->


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

