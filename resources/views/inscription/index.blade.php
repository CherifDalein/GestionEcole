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
                <h5 class="card-header">Table Basic <a href="{{ route('inscription.add')}}" class="btn rounded-pill btn-outline-primary">Ajouter</a></h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nom de l'etudiant</th>
                        <th>Prenom de l'etudiant</th>
                        <th>Date de naissance de l'etudiant</th>
                        <th>Lieu de naissance de l'etudiant</th>
                        <th>Numero de carte de l'etudiant</th>
                        <th>Classe</th>
                        <th>Annee Scolaire</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($inscriptions as $inscription)
                        <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>{{$inscription->nom_etudiant}}</strong></td>
                        <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>{{$inscription->prenom_etudiant}}</strong></td>
                        <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>{{$inscription->date_de_naissance}}</strong></td>
                        <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>{{$inscription->lieu_de_naissance}}</strong></td>
                        <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>{{$inscription->numero_piece}}</strong></td>
                        <td>{{$inscription->classes?$inscription->classes->nom_classe:''}}</td>
                        <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>{{$inscription->annee_scolaire}}</strong></td>
                        <td>
                          <form action="{{ route('inscription.state', $inscription->id) }}" method="POST">
                                @csrf
                                @if($inscription->state == 0)
                                    <button class="btn" type="submit" onclick="return confirm('Voulez-vous activer le inscription ?');">
                                        <span class="badge bg-label-danger me-1">Désactivé</span>
                                    </button>
                                @else
                                  <button class="btn" type="submit" onclick="return confirm('Voulez-vous désactiver le inscription ?');">
                                      <span class="badge bg-label-success me-1">Activé</span>
                                  </button>
                                @endif
                          </form> 
                        </td>
                        <td>
                          <div class="btn-group" role="group" aria-label="Actions">
                                  {{-- View Start --}}
                                  <a href="{{ route('inscription.show', $inscription) }}" class="btn btn-sm btn-info">
                                      <i class="bx bx-show mr-1"></i>
                                  </a>
                                  {{-- View End --}}
                                  <a href="{{ route('inscription.edit', $inscription->id) }}" class="btn btn-sm btn-primary">
                                      <i class="bx bx-edit mr-1"></i>
                                  </a>
                                  <form class="btn-group" id="destroy{{ $inscription->id }}" action="{{ route('inscription.destroy', $inscription->id) }}" method="post">
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

               