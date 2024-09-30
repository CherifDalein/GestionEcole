@extends('index')
@section('content')
<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="col-md-12">
                  @if(session()->has('message'))
                      <div class="alert alert-icon alert-success alert-dismissible" role="alert">
                          {{ session('message') }}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @endif
                </div>
                <h5 class="card-header">Table Basic <a href="{{ route('module.add')}}" class="btn rounded-pill btn-outline-primary">Ajouter</a></h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nom module</th>
                        <th>Diminutif</th>
                        <th>Description</th>
                        <th>Url</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($modules as $module)
                        <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>{{$module->nom}}</strong></td>
                      
                        <td>{{$module->dimunitif}}</td>
                        <td>{{$module->description}}</td>
                        <td><a href="{{$module->url}}">{{$module->url}}</a></td>
                        <td>
                          <form action="{{ route('module.state', $module->id) }}" method="POST">
                                @csrf
                                @if($module->state == 0)
                                    <button class="btn" type="submit" onclick="return confirm('Voulez-vous activer le module ?');">
                                        <span class="badge bg-label-danger me-1">Désactivé</span>
                                    </button>
                                @else
                                  <button class="btn" type="submit" onclick="return confirm('Voulez-vous désactiver le module ?');">
                                      <span class="badge bg-label-success me-1">Activé</span>
                                  </button>
                                @endif
                          </form> 
                        </td>
                        <td>
                          <div class="btn-group" role="group" aria-label="Actions">
                                  {{-- View Start --}}
                                  <a href="{{ route('module.show', $module) }}" class="btn btn-sm btn-info">
                                      <i class="bx bx-show mr-1"></i>
                                  </a>
                                  {{-- View End --}}
                                  <a href="{{ route('module.edit', $module->id) }}" class="btn btn-sm btn-primary">
                                      <i class="bx bx-edit mr-1"></i>
                                  </a>
                                  <form class="btn-group" id="destroy{{ $module->id }}" action="{{ route('module.destroy', $module->id) }}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Voulez-vous supprimer ?')">
                                          <i class="bx bx-trash mr-1"></i>
                                      </button>
                                  </form>
                              </div>
                        </td>
                      </tr>
                      <tr>
                      @endforeach
                    </tbody>

                  </table>
                </div>
              </div>
              
              <!--/ Basic Bootstrap Table -->
@endsection

               