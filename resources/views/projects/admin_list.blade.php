@extends('layouts.app')

@section('content')
<div class="card card-table">
    <div class="card-body" style="padding:10px;">
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
            <div class="col-sm-12" style="text-align: right;">
                <a href="{{ route('project.create') }}" class="btn btn-primary">Tạo project</a>
            </div>
        </div>
        <div class="col-sm-12">
            <table id="table1" class="table table-striped table-hover table-fw-widget dataTable no-footer" role="grid" aria-describedby="table1_info">
                <thead>
                    <tr role="row">
                        <th class="center">No.</th>
                        <th class="sorting" style="width:150px">Thumbnail</th>
                        <th class="sorting_asc" style="width:35%">Tiêu đề</th>
                        <th class="number" style="width:8%">Mục tiêu</th>
                        <th class="sorting">Ngày tạo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $key => $project)
                    <tr class="gradeA odd" role="row">
                        <td class="center">{{ $key + 1 }}</td>
                        <td><img class="img-thumbnail" style="width: 130px" src="{{ $project->thumbnail }}"/></td>
                        <td class="sorting_1">
                            <p style="font-weight:500; font-size: 18px;">{{ $project->name }}</p>
                            <p>{!! $project->summary !!}</p>
                        </td>
                        <td class="number">{{ number_format($project->aim_money) }} VND</td>
                        <td class="center">{{ $project->created_at }}</td>
                        <td class="action">
                            <a href="{{ route('project.edit', [ $project->id ]) }}" style="margin-right: 10px"><i class="mdi mdi-settings" style="font-size: 20px;"></i></a>
                            <a href="{{ route('project.packages_list', [ 'project_id' => $project->id ]) }}" class="btn btn-primary btn-sm" style="margin-right: 10px">Packages</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin: 10px 0;">
                {{ $projects->appends($_GET)->links() }}
            </div>
            
        </div>
    </div>
</div>
@endsection