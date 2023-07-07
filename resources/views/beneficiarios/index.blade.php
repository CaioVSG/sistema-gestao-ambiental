<x-app-layout>
    @section('content')
        <div class="container-fluid" style="padding-top: 3rem; padding-bottom: 6rem; padding-left: 10px; padding-right: 20px">
            <div class="form-row justify-content-between">
                <div class="col-md-9">
                    <div class="form-row">
                        <div class="col-md-8">
                            <h4 class="card-title">Beneficiarios</h4>
                        </div>
                    </div>
                    <div div class="form-row">
                        @if (session('success'))
                            <div class="col-md-12" style="margin-top: 5px;">
                                <div class="alert alert-success" role="alert">
                                    <p>{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <form>
                        @csrf
                        <div class="form-row mb-3">
                            <div class="col-md-7">
                                <input type="text" class="form-control w-100" name="buscar" placeholder="Digite o nome do Beneficiario">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn" style="background-color: #00883D; color: white;">Buscar</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-xs-4 d-flex align-items-start">
                      
                                <a title="Adicionar beneficiario" class="ml-2" href="{{route('beneficiarios.create')}}">
                                    <img class="icon-licenciamento " src="{{asset('img/Grupo 1666.svg')}}" style="height: 35px" alt="Icone de adicionar documento">
                                </a>
                        
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <div class="tab-content tab-content-custom" id="myTabContent">
                                <div class="tab-pane fade show active" id="beneficiarios" role="tabpanel"
                                    aria-labelledby="beneficiarios-tab">
                                    <div class="table-responsive">
                                        <table class="table mytable" id="beneficiarios_table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">NIS</th>
                                                    <th scope="col">CPF</th>
                                                    <th scope="col">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($beneficiario as $item)
                                                    <tr>
                                                        <th scope="row">{{ $item->id }}</th>
                                                        <td>{{ $item->nome }}</td>
                                                        <td>{{ $item->nis }}</td>
                                                        <td>{{ $item->cpf }}</td>
                                                        <td>  <a href="{{route('beneficiarios.show', ['id' => $item->id])}}"><img class="icon-licenciamento" width="20px;" src="{{asset('img/Visualizar.svg')}}"  alt="Visualizar Beneficiario" title="Visualizar Beneficiario"></a></td>
                                                    </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="col-md-12 shadow-sm p-2 px-3"
                        style="background-color: #ffffff; border-radius: 00.5rem; margin-top: 5.2rem;">
                        <div style="font-size: 21px;" class="tituloModal">
                            Legenda
                        </div>
                        <div class="mt-2 borda-baixo"></div>
                        <ul class="list-group list-unstyled">
                            <li>
                                @can('isSecretario', \App\Models\User::class)
                                    <div title="Visualizar Beneficiario" class="d-flex align-items-center my-1 pt-0 pb-1">
                                        <img class="icon-licenciamento aling-middle" width="20"
                                            src="{{ asset('img/Visualizar.svg') }}" alt="Visualizar Beneficiario">
                                        <div style="font-size: 15px;" class="aling-middle mx-3">
                                            Visualizar Beneficiário
                                        </div>
                                    </div>
                                  
                                @endcan
                               
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

       
     
    @endsection
</x-app-layout>
