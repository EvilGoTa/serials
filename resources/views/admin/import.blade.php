@extends('layouts.admin')

@section('content')
    <div class="col-xl-3">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">insert_drive_file</i>
                </div>
                <p class="card-category">Загруженный файл</p>
                <h3 class="card-title">import_v2.csv
                </h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> вчера
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">save_alt</i>
                </div>
                <p class="card-category"></p>
                <button type="submit" class="btn btn-primary pull-right">Запустить импорт<div class="ripple-container"></div></button>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> вчера
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">save_alt</i>
                </div>
                <p class="card-category"></p>
                <button type="submit" class="btn btn-primary pull-right">Запустить импорт<div class="ripple-container"></div></button>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i> вчера
                </div>
            </div>
        </div>
    </div>
@endsection