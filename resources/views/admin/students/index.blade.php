@extends('layouts.admin')
@section('title', 'Ученики Школы')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item active" aria-current="page">Все Ученики</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Ученики школы A5</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3 ">
                        <ul class="alert alert-info px-5">
                            <li>При удалении ученики попадают на вкладку "Удаленые ученики" (справа на странице). Они не отображаются на сайте в общем рейтинге</li>
                            <li>Если требуется восстановить удаленого ученика, переходим на страницу "Удаленые ученики" и нажимаем синюю кнопку "восстановть"</li>
                            <li>Если требуется удалить ученика навсегда то это так же делается на странице "Удаленые ученики". Восстановть уже не получится, только заново создавать. В принципе, удалять ученика навсегда вряд ли потребуется</li>
                        </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header row justify-content-between">
                            <h3 class="card-title col-md-6">Список учеников</h3>
                            <a class="d-block col-md-6 text-right" href="{{ route('admin.students.trashed') }}">Удаленные ученики</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-3">Добавить
                                ученика</a>

                            <form action="{{ route('admin.students.ratingUpdate') }}" method="post" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-secondary mb-3" onclick="return confirm('Подтвердите обновление всего рейтинга')">Обновить весь рейтинг</button>
                            </form>

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

                                                    <a href="{{ route('admin.students.show', ['student' => $student->id]) }}" class="btn btn-info btn-sm float-left mr-1" title="Просмотр профиля">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.students.edit', ['student' => $student->id]) }}" class="btn btn-info btn-sm float-left mr-1" title="Редактировать">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form action="{{ route('admin.students.destroy', ['student' => $student->id]) }}" method="post" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Подтвердите удаление')" title="Переместить в удаленные">
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
                                <p>Учеников пока нет...</p>
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

