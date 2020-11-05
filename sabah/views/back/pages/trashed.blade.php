@extends('back.layouts.master')
@section('title', 'Silinen makaleler')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-right"><strong>{{$articles->count()}}</strong> makale bulundu
      <a href="{{route('admin.makaleler.index')}}" class="btn btn-primary btn-sm"></i> Tum makaleler</a>
    </h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Foto</th>
            <th>Basliq</th>
            <th>Category</th>
            <th>Hit</th>
            <th>Tarix</th>
            <th>Islemler</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Foto</th>
            <th>Basliq</th>
            <th>Category</th>
            <th>Hit</th>
            <th>Tarix</th>
            <th>Islemler</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($articles as $article)
          <tr>
            <td>
              <img src="{{$article->image}}" width="200">
            </td>
            <td>{{$article->title}}</td>
            <td>{{$article->getCategory->name}}</td>
            <td>{{$article->hit}}</td>
            <td>{{$article->created_at->diffForHumans()}}</td>
            <td>
              <a href="{{route('admin.recover.article', $article->id)}}" title="Silmekten kurtar" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
              <a href="{{route('admin.hard.delete.article', $article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
