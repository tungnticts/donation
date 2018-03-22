@extends('layouts.app')

@section('content')
<div class="row">
  <!--Hover table-->
  <div class="col-lg-12">
    <div class="card card-table">
      <div class="card-header">Hover &amp; Image
        <div class="tools dropdown"><span class="icon mdi mdi-download"></span><a href="#" role="button" data-toggle="dropdown" class="dropdown-toggle"><span class="icon mdi mdi-more-vert"></span></a>
          <div role="menu" class="dropdown-menu"><a href="#" class="dropdown-item">Action</a><a href="#" class="dropdown-item">Another action</a><a href="#" class="dropdown-item">Something else here</a>
            <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Separated link</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th style="width:37%;">User</th>
              <th style="width:36%;">Commit</th>
              <th>Date</th>
              <th class="actions"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="user-avatar"> <img src="{{ asset('images/avatar4.png') }}" alt="Avatar">Penelope Thornton</td>
              <td>Initial commit</td>
              <td>Aug 6, 2015</td>
              <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
            </tr>
            <tr>
              <td class="user-avatar"> <img src="{{ asset('images/avatar4.png') }}" alt="Avatar">Benji Harper</td>
              <td>Main structure markup</td>
              <td>Jul 28, 2015</td>
              <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
            </tr>
            <tr>
              <td class="user-avatar"> <img src="{{ asset('images/avatar4.png') }}" alt="Avatar">Justine Myranda</td>
              <td>Left sidebar adjusments</td>
              <td>Jul 15, 2015</td>
              <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
            </tr>
            <tr>
              <td class="user-avatar"> <img src="{{ asset('images/avatar4.png') }}" alt="Avatar">Sherwood Clifford</td>
              <td>Topbar dropdown style</td>
              <td>Jun 30, 2015</td>
              <td class="actions"><a href="#" class="icon"><i class="mdi mdi-delete"></i></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
