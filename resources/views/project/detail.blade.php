@extends('layouts.home')

@section('content')
<div class="row">
    <h2 class="col-md-12 card-title" style="margin-top:0.75rem;">{{ $project->name }}</h2>
</div>
<div class="row">
    <div class="col-md-6">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="{{ $project->thumbnail }}" alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('images/default.jpg') }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('images/default.jpg') }}" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="progress height_10">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $total_money_donating/$project->aim_money*100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="card-title" style="margin-top:0.75rem; color:darkgreen">{{ number_format($total_money_donating) }} VND</h4>
                <h6 class="card-subtitle mb-2 text-muted aim_money">{{ number_format($project->aim_money) }} VND mục tiêu</h6>
                <div class="row">
                    <span class="col-md-6">Còn {{ date_diff(date_create(date('Y/m/d')), date_create($project->end_at))->days }} ngày</span>
                    <span class="col-md-6 text_right">{{ $total_donating }} người ủng hộ.</span>
                </div>
                <div class="row" style="margin: 10px 0;">
                    <span class="col-md-6" style="padding:0;">Chọn gói ủng hộ</span>
                </div>
                <div class="list-group">
                    @foreach ($packages as $key => $package)
                    <a href="{{ route('cart.check_out', [ 'package_id' => $package->id ]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 col-md-9" style="padding:0">{{ $package->title }}</h5>
                            <small class="col-md-3" style="padding:0">{{ $package->order()->count() }} ủng hộ</small>
                        </div>
                        <p class="mb-1">{{ $package->content }}</p>
                        <small>{{ number_format($package->price) }} VND</small>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row description">
    <div class="card text-center w-100">
        <div class="card-header" style="text-align:left;">Mô tả về dự án</div>
        <div class="card-body" style="text-align:left;">
            <h5 class="card-title">{{ $project->name }}</h5>
            {!! $project->content !!}
        </div>
    </div>
</div>
@endsection