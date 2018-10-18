@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Сериалы</h4>
                <p class="card-category"> {{ $serials_count }} всего</p>
                <form action="{{ route('admin::serials.create') }}" method="get">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon" style="position: absolute; top: 13px; right: 13px;">
                        <i class="material-icons">add</i>
                        <div class="ripple-container"></div>
                        <div class="ripple-container"></div>
                    </button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                        <tr><th>
                                ID
                            </th>
                            <th>
                                Название
                            </th>
                            <th>
                                Оригинальное название
                            </th>
                            <th>
                                Годы выхода
                            </th>
                            <th>
                                Страна
                            </th>
                            <th>
                                &nbsp;
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr></thead>
                        <tbody>
                        @foreach ($serials as $s)
                        <tr>
                            <td>
                                {{ $s->id }}
                            </td>
                            <td class="text-primary">
                                <a href="{{ route('admin::serials.edit', ['id' => $s->id]) }}">{{ $s->title_ru }}</a>
                            </td>
                            <td>
                                {{ $s->title_original }}
                            </td>
                            <td>
                                {{ $s->year_launch }} - {{ $s->year_last or 'наши дни' }}
                            </td>
                            <td >
                                {{ $s->country }}
                            </td>
                            <td>
                                <a href="{{ route('admin::serials.edit', [$s->id]) }}" title="Редактировать"><i class="material-icons">edit</i></a>
                                <form id="delete_from_{{ $s->id }}" action="{{ route('admin::serials.destroy', [$s->id]) }}" method="POST" style="display: inline-block">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <a href="#" title="Удалить" onclick="document.getElementById('delete_from_{{ $s->id }}').submit();"><i class="material-icons">clear</i></a>
                                </form>

                            </td>
                            <td>
                                <a target="_blank" href="{{ route('serial_front', [$s->id]) }}" title="Посмотреть на фронте"><i class="material-icons">launch</i></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        {{ $serials->links() }}
    </div>
@endsection