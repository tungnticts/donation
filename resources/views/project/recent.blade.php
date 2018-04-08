@foreach($recent_projects as $project)
<div class="col-md-4 margin_bottom_30">
    <div class="card">
        <img class="card-img-top" src="{{ $project->thumbnail }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ $project->name }}</h5>
            <p class="card-text">{!! $project->summary !!} </p>
            <div class="row margin_bottom_10">
                <span class="col-md-8">{{ number_format($project->aim_money) }} VND</span>
                <span class="col-md-4 text_right">{{ $project->total_money/$project->aim_money * 100 }}%</span>
            </div>
            <div class="progress margin_bottom_10">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $project->total_money/$project->aim_money * 100 }}%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="row margin_bottom_10 italic">
            <span class="col-md-6 text_size_10">Còn {{ date_diff(date_create(date('Y/m/d')), date_create($project->end_at))->days }} ngày </span>
                <span class="col-md-6 text_size_10 text_right">{{ $project->total_donating }} người ủng hộ</span>
            </div>
            <a href="{{ route('project.detail', [ $project->id ]) }}" class="btn btn-primary btn-sm" style="float:right">Xem tiếp...</a>
        </div>
    </div>
</div>
@endforeach