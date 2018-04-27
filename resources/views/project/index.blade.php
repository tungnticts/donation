@extends('layouts.home')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (session('success'))
        <div role="alert" class="alert alert-success alert-icon alert-dismissible">
            <div class="icon"><span class="mdi mdi-check"></span></div>
            <div class="message">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Success!</strong> {{ session('success') }}
            </div>
        </div>
        @endif
        @if (session('fail'))
        <div role="alert" class="alert alert-danger alert-icon alert-dismissible">
            <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
            <div class="message">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Fail!</strong> {{ session('fail') }}
            </div>
        </div>
        @endif
    </div>
</div>
<div class="row">
    @foreach ($projects as $key => $project)
    <?php 
        $total_donating = 0;
        $total_money = 0;
        $packages = $project->package()->get();
        foreach ($packages as $package) {
            $total_donating += $package->order()->count();
            $total_money += $package->order()->count() * $package->price;
        }
    ?>
    <div class="col-md-4 margin_bottom_30">
        <div class="card">
            <img class="card-img-top" src="{{ $project->thumbnail }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $project->name }}</h5>
                <p class="card-text">{!! $project->summary !!} </p>
                <div class="row margin_bottom_10">
                    <span class="col-md-8">{{ number_format($project->aim_money) }} VND</span>
                    <span class="col-md-4 text_right">{{ round($total_money/$project->aim_money, 2) * 100 }}%</span>
                </div>
                <div class="progress margin_bottom_10">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $total_money/$project->aim_money * 100 }}%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="row margin_bottom_10 italic">
                <span class="col-md-6 text_size_10">Còn {{ date_diff(date_create(date('Y/m/d')), date_create($project->end_at))->days }} ngày </span>
                    <span class="col-md-6 text_size_10 text_right">{{ $total_donating }} người ủng hộ</span>
                </div>
                <a href="{{ route('project.detail', [ 'slug' => str_slug($project->name, '-'), 'id' => $project->id ]) }}" class="btn btn-primary btn-sm" style="float:right">Xem tiếp...</a>
            </div>
        </div>
    </div>
    @endforeach
   
</div>
<div class="row">
    <div class="col-md-12">
        {{ $projects->appends($_GET)->links() }}
    </div>
</div>
@endsection