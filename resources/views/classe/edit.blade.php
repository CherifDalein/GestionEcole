@extends('index')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Horizontal Layouts</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Basic Layout <a href="{{ route('classe.')}}" class="btn rounded-pill btn-outline-primary">Lister</a></h5>
            <small class="text-muted float-end">Default label</small>
          </div>
          <div class="card-body">
          <div class="row">
            <div class="col-md-12">
                @if(session()->has('message'))
                  <div class="alert alert-icon alert-success">
                      {{session('message')}}
                  </div>
                @endif
            </div>
            <form action="{{ route('classe.update', $classe->id) }}" method="post">
              @csrf
              @method('put')
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Nom classe</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nom_classe" id="basic-default-name"  value="{{$classe->nom_classe}}"/>
                </div>
              
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Detail</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="detail_classe" id="basic-default-name"  value="{{$classe->detail_classe}}"/>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-1">
                  <button type="submit" class="btn btn-primary">Send</button>
                </div>
                <div class="col-sm-1">
                  <button type="reset" class="btn btn-danger">Cancel</button>
                </div>
              </div>
              
            </form>
          </div>
        </div>
      </div>
  </div>
@endsection