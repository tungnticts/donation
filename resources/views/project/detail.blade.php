@extends('layouts.home')

@section('content')
<div class="row">
    <h2 class="col-md-12 card-title" style="margin-top:0.75rem;">{{ $project->name }}</h2>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="row" style="display:block; margin-bottom: 10px;">
            <img src="{{ asset('images/default.jpg') }}" class="img-thumbnail" alt="Responsive image">
        </div>
        <div class="row list-thumbnail">
            <div class="col-md-4">
            <img src="{{ asset('images/default.jpg') }}" class="img-thumbnail" alt="Responsive image">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/default.jpg') }}" class="img-thumbnail" alt="Responsive image">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/default.jpg') }}" class="img-thumbnail" alt="Responsive image">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="progress height_10">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="card-title" style="margin-top:0.75rem; color:darkgreen">1.000.000 VND</h4>
                <h6 class="card-subtitle mb-2 text-muted aim_money">{{ number_format($project->aim_money) }} VND mục tiêu</h6>
                <div class="row">
                    <span class="col-md-6">Còn {{ date_diff(date_create(date('Y/m/d')), date_create($project->end_at))->days }} ngày</span>
                    <span class="col-md-6 text_right">200 người ủng hộ.</span>
                </div>
                <div class="row" style="margin: 10px 0;">
                    <span class="col-md-6" style="padding:0;">Chọn gói ủng hộ</span>
                </div>
                <div class="list-group">
                    @foreach ($packages as $key => $package)
                    <a href="javascript:;" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 col-md-9" style="padding:0">{{ $package->title }}</h5>
                            <small class="col-md-3" style="padding:0">5 người ủng hộ</small>
                        </div>
                        <p class="mb-1">{{ $package->content }}</p>
                        <small>500.000 VND</small>
                    </a>
                    @endforeach
                </div>

                <div class="button">
                    <button type="button" class="btn btn-success btn-lg btn-block">Ủng hộ</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row description">
    <div class="card text-center w-100">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
</div>
@endsection