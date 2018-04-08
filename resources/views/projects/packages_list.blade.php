@extends('layouts.app')

@section('content')
<div class="card card-table">
    <div class="card-body" style="padding:10px;">
        <div class="col-sm-12">
            <table id="table1" class="table table-striped table-hover table-fw-widget dataTable no-footer" role="grid" aria-describedby="table1_info">
                <thead>
                    <tr role="row">
                        <th class="center">No.</th>
                        <th class="sorting_asc" style="width:35%">Tiêu đề</th>
                        <th class="number" style="width:8%">Mục tiêu</th>
                        <th class="sorting">Số lượng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packages as $key => $package)
                    <tr class="gradeA odd" role="row">
                        <td class="center">{{ $key + 1 }}</td>
                        <td class="sorting_1">
                          <p style="font-weight:500; font-size: 18px;">{{ $package->title }}</p>
                        </td>
                        <td class="number">{{ number_format($package->price) }} VND</td>
                        <td class="center">{{ $package->quantity }}</td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection