@extends('layouts.admin')
@section('title', 'Удаленные ученики Школы')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.students') }}">Все Ученики</a></li>
        <li class="breadcrumb-item active" aria-current="page">Удаленные Ученика</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Удаленые ученики школы A5</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header row justify-content-between">
                            <a class="d-block col-md-6" href="{{ route('admin.students') }}">Список учеников</a>
                            <h3 class=" card-title d-block col-md-6 text-right">Удаленные ученики</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            @if (count($students))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Фото</th>
                                            <th>Имя</th>
                                            <th>Телефон</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $student->id }}</td>
                                                <td><img src="{{ asset($student->photo) }}" alt="{{ $student->name }}" width="50" height="50"></td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->telephone }}</td>
                                                <td>
                                                    <form action="{{ route('admin.students.restore', ['student' => $student->id]) }}" method="post" class="float-left">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-primary btn-sm mr-1" title="Восстановить">
                                                            <i class="fas fa-user-plus"></i>
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('admin.students.destroyForever', ['student' => $student->id]) }}" method="post" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Подтвердите удаление')" title="Удалить навсегда">
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
                                <p>Удаленных учеников пока нет...</p>
                            @endif
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

