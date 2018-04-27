@extends('layouts.home')
{{-- @section('title', $project->name)
@section('url', route('project.detail', [ 'slug' => str_slug($project->name, '-'), 'id' => $project->id ]))
@section('description', $project->summary)
@section('image', asset($project->thumbnail)) --}}
@section('content')
  <div class="row">
    @foreach($products as $product)
    <div class="col-md-3">
      <div class="card">
        <img class="card-img-top" src="{{ $product->thumbnail }}" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">{{ $product->title }}</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="row">
    <div class="col-md-12">
        {{ $products->appends($_GET)->links() }}
    </div>
  </div>
@endsection