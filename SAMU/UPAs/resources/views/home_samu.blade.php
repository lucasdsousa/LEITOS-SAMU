@extends('layouts.app')

@section('content')
<script>

$(function () {
  $('[data-tt="tooltip"]').tooltip()
})

</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Painel de Controle</div>
                    <form action="/" method="POST">
                    @csrf
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <h3>Bem vindo, Administrador {{ Auth::user()->name }}!</h3>
                        </div>

                        <div class="card-body">
                            <h5><strong>Aqui você visualiza os leitos por UPA e solicita a ocupação para uma emergência.</strong></h5>
                        </div>

                        <div class="card-body">
                            <a class="btn btn-outline-danger mr-5 mt-3" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                            </a>
                        </div>
                    </form> 
                </div>                      
            </div>

        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header"><strong>Leitos por UPA</strong></div>
                    
                    <div class="card-body">
                        <button class="btn btn-outline-primary mr-3 my-2" type="button" data-toggle="modal" data-tt="tooltip" data-placement="top" title="Leitos Disponíveis: {{ $qtd_tomba }}" data-target="#modalTomba">
                            {{ $tomba }}
                        </button>

                        <button class="btn btn-outline-primary mr-3 my-2" type="button" data-toggle="modal" data-tt="tooltip" data-placement="top" title="Leitos Disponiveis: {{ $qtd_pqipe }}" data-target="#modalPqipe" aria-expanded="false" aria-controls="collapsePqipe">
                            {{ $pqipe }}
                        </button>

                        <button class="btn btn-outline-primary mr-3 my-2" type="button" data-toggle="modal" data-tt="tooltip" data-placement="top" title="Leitos Disponiveis: {{ $qtd_ruanova }}" data-target="#modalRuaNova" aria-expanded="false" aria-controls="collapseQueim">
                            {{ $ruanova }}
                        </button>

                        <button class="btn btn-outline-primary mr-3 my-2" type="button" data-toggle="modal" data-tt="tooltip" data-placement="top" title="Leitos Disponiveis: {{ $qtd_feirax }}" data-target="#modalFeiraX" aria-expanded="false" aria-controls="collapseQueim">
                            {{ $feirax }}
                        </button>

                        <button class="btn btn-outline-primary mr-3 my-2" type="button" data-toggle="modal" data-tt="tooltip" data-placement="top" title="Leitos Disponiveis: {{ $qtd_george }}" data-target="#modalGeorge" aria-expanded="false" aria-controls="collapseQueim">
                            {{ $george }}
                        </button>

                        <button class="btn btn-outline-primary mr-3 my-2" type="button" data-toggle="modal" data-tt="tooltip" data-placement="top" title="Leitos Disponiveis: {{ $qtd_humild }}" data-target="#modalHumild" aria-expanded="false" aria-controls="collapseQueim">
                            {{ $humild }}
                        </button>

                        <button class="btn btn-outline-primary mr-3 my-2" type="button" data-toggle="modal" data-tt="tooltip" data-placement="top" title="Leitos Disponiveis: {{ $qtd_saojose }}" data-target="#modalSaoJose" aria-expanded="false" aria-controls="collapseQueim">
                            {{ $saojose }}
                        </button>

                        <button class="btn btn-outline-primary mr-3 my-2" type="button" data-toggle="modal" data-tt="tooltip" data-placement="top" title="Leitos Disponiveis: {{ $qtd_mangab }}" data-target="#modalMangab" aria-expanded="false" aria-controls="collapseQueim">
                            {{ $mangab }}
                        </button>

                        <button class="btn btn-outline-primary mr-3 my-2" type="button" data-toggle="modal" data-tt="tooltip" data-placement="top" title="Leitos Disponiveis: {{ $qtd_queim }}" data-target="#modalQueim" aria-expanded="false" aria-controls="collapseQueim">
                            {{ $queim }}
                        </button>

                        <button class="btn btn-outline-primary mr-3 my-2" type="button" data-toggle="modal" data-tt="tooltip" data-placement="top" title="Leitos Disponiveis: {{ $qtd_cleris }}" data-target="#modalCleris" aria-expanded="false" aria-controls="collapseQueim">
                            {{ $cleris }}
                        </button>

                        <!-- Div da Policlinica Tomba -->
                        <div class="modal fade" id="modalTomba" tabindex="-1" role="dialog" aria-labelledby="modalTomba" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Policlinica Tomba</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body container">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-success">Leitos Normais</th>
                                                    <th scope="col" class="text-info">Isolamento</th>
                                                    <th scope="col" style="color:#5F9EA0">Covid-19</th>
                                                    <th scope="col" class="text-danger">Salas Vermelhas</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                        
                                                <tr>                                  
                                                    <td>
                                                        @foreach($leitos_tomba_normal as $leito)
                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_tomba_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_tomba_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_tomba" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_tomba">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_tomba_isolamento as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_tomba_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_tomba_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_tomba" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_tomba">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>


                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_tomba_covid as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_tomba_o" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_tomba_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_tomba" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_tomba">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_tomba_verm as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_tomba_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_tomba_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_tomba" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_tomba">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- @foreach($leitos_tomba_disp as $ltomba)
                                        <form action="/{{ $ltomba->id }}" method="POST">
                                        @csrf                                
                                            <div class="card-body">     
                                                
                                                <h5><strong>LEITO {{ $tomba }}</strong></h5>

                                                @if($ltomba->tipo_leito == "Normal")
                                                    <h5>Tipo de leito: <strong class="text-success">{{ $ltomba->tipo_leito }}</strong></h5>
                                                @endif
                                                
                                                @if($ltomba->tipo_leito == "Isolamento")
                                                    <h5>Tipo de leito: <strong class="text-primary">{{ $ltomba->tipo_leito }}</strong></h5>
                                                @endif
                                                
                                                @if($ltomba->tipo_leito == "Covid-19")
                                                    <h5>Tipo de leito: <strong style="color: #5F9EA0">{{ $ltomba->tipo_leito }}</strong></h5>
                                                @endif
                                                
                                                @if($ltomba->tipo_leito == "Sala Vermelha")
                                                    <h5>Tipo de leito: <strong class="text-warning">{{ $ltomba->tipo_leito }}</strong></h5>
                                                @endif
                                                
                                                <h5>Status: <strong class="text-success">{{ $ltomba->status }}</strong></h5>
                                                
                                                <button type="submit" class="btn btn-warning text-light"><strong>Ocupar Leito</strong></button>                                       
                                            </div>
                                        </form>
                                        <hr>                                        @endforeach -->
                                    </div>
                                </div>                                
                            </div>                    
                        </div>

                        <!-- Div da Policlinica Parque Ipê -->
                        <div class="modal fade" id="modalPqipe" tabindex="-1" role="dialog" aria-labelledby="modalPqipe" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Policlinica Parque Ipê</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-success">Leitos Normais</th>
                                                    <th scope="col" class="text-info">Isolamento</th>
                                                    <th scope="col" style="color:#5F9EA0">Covid-19</th>
                                                    <th scope="col" class="text-danger">Salas Vermelhas</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                        
                                                <tr>                                  
                                                    <td>
                                                        @foreach($leitos_pqipe_normal as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_pqipe_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_pqipe_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_pqipe" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_pqipe">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_pqipe_isolamento as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_pqipe_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_pqipe_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_pqipe" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_pqipe">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>


                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_pqipe_covid as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_pqipe_o" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_pqipe_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_pqipe" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_pqipe">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_pqipe_verm as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning text-light" data-toggle="collapse" data-target="#info_v_pqipe_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_pqipe_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning text-light" data-toggle="collapse" data-target="#info_v_pqipe" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_pqipe">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>                    
                        </div>

                        <!-- Div da Policlinica RUA NOVA -->
                        <div class="modal fade" id="modalRuaNova" tabindex="-1" role="dialog" aria-labelledby="modalRuaNova" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Policlinica Rua Nova</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-success">Leitos Normais</th>
                                                    <th scope="col" class="text-info">Isolamento</th>
                                                    <th scope="col" style="color:#5F9EA0">Covid-19</th>
                                                    <th scope="col" class="text-danger">Salas Vermelhas</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                        
                                                <tr>                                  
                                                    <td>
                                                        @foreach($leitos_ruanova_normal as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_ruanova_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_ruanova_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_ruanova" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_ruanova">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_ruanova_isolamento as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_ruanova_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_ruanova_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_ruanova" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_ruanova">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>


                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_ruanova_covid as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_ruanova_o" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_ruanova_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_ruanova" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_ruanova">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_ruanova_verm as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_ruanova_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_ruanova_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_ruanova" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_ruanova">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>                    
                        </div>

                        <!-- Div da Policlinica FEIRA X -->
                        <div class="modal fade" id="modalFeiraX" tabindex="-1" role="dialog" aria-labelledby="modalFeiraX" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Policlinica FEIRA X</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-success">Leitos Normais</th>
                                                    <th scope="col" class="text-info">Isolamento</th>
                                                    <th scope="col" style="color:#5F9EA0">Covid-19</th>
                                                    <th scope="col" class="text-danger">Salas Vermelhas</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                        
                                                <tr>                                  
                                                    <td>
                                                        @foreach($leitos_feirax_normal as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_feirax_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_feirax_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_feirax" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_feirax">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_feirax_isolamento as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_feirax_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_feirax_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_feirax" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_feirax">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>


                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_feirax_covid as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_feirax_o" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_feirax_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_feirax" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_feirax">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_feirax_verm as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_feirax_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_feirax_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_feirax" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_feirax">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>                    
                        </div>

                        <!-- Div da Ploclinica GEORGE AMERICO-->
                        <div class="modal fade" id="modalGeorge" tabindex="-1" role="dialog" aria-labelledby="modalGeorge" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upa Ploclinica GEORGE AMERICO</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-success">Leitos Normais</th>
                                                    <th scope="col" class="text-info">Isolamento</th>
                                                    <th scope="col" style="color:#5F9EA0">Covid-19</th>
                                                    <th scope="col" class="text-danger">Salas Vermelhas</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                        
                                                <tr>                                  
                                                    <td>
                                                        @foreach($leitos_george_normal as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_george_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_george_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_george" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_george">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_george_isolamento as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_george_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_george_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_george" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_george">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>


                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_george_covid as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_george_o" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_george_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_george" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_george">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_george_verm as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_george_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_george_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_george" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_george">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>                    
                        </div>

                        <!-- Div da Policlinica HUMILDES -->
                        <div class="modal fade" id="modalHumild" tabindex="-1" role="dialog" aria-labelledby="modalHumild" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Policlinica HUMILDES</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-success">Leitos Normais</th>
                                                    <th scope="col" class="text-info">Isolamento</th>
                                                    <th scope="col" style="color:#5F9EA0">Covid-19</th>
                                                    <th scope="col" class="text-danger">Salas Vermelhas</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                        
                                                <tr>                                  
                                                    <td>
                                                        @foreach($leitos_humild_normal as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_humild_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_humild_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_humild" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_humild">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_humild_isolamento as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_humild_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_humild_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_humild" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_humild">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>


                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_humild_covid as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_humild_o" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_humild_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_humild" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_humild">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_humild_verm as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_humild_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_humild_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_humild" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_humild">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>                    
                        </div>

                        <!-- Div da Policlinica SÃO JOSÉ -->
                        <div class="modal fade" id="modalSaoJose" tabindex="-1" role="dialog" aria-labelledby="modalSaoJose" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Policlinica SÃO JOSÉ</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-success">Leitos Normais</th>
                                                    <th scope="col" class="text-info">Isolamento</th>
                                                    <th scope="col" style="color:#5F9EA0">Covid-19</th>
                                                    <th scope="col" class="text-danger">Salas Vermelhas</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                        
                                                <tr>                                  
                                                    <td>
                                                        @foreach($leitos_saojose_normal as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_saojose_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_saojose_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_saojose" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_saojose">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_saojose_isolamento as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_saojose_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_saojose_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_saojose" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_saojose">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>


                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_saojose_covid as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_saojose_o" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_saojose_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_saojose" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_saojose">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_saojose_verm as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_saojose_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_saojose_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_saojose" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_saojose">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>                    
                        </div>

                        <!-- Div da UPA MANGABEIRA -->
                        <div class="modal fade" id="modalMangab" tabindex="-1" role="dialog" aria-labelledby="modalMangab" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upa MANGABEIRA</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-success">Leitos Normais</th>
                                                    <th scope="col" class="text-info">Isolamento</th>
                                                    <th scope="col" style="color:#5F9EA0">Covid-19</th>
                                                    <th scope="col" class="text-danger">Salas Vermelhas</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                        
                                                <tr>                                  
                                                    <td>
                                                        @foreach($leitos_mangab_normal as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_mangab_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_mangab_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_mangab" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_mangab">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_mangab_isolamento as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_mangab_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_mangab_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_mangab" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_mangab">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>


                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_mangab_covid as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_mangab_o" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_mangab_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_mangab" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_mangab">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_mangab_verm as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_mangab_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_mangab_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_mangab" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_mangab">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>                    
                        </div>

                        <!-- Div da UPA QUEIMADINHA -->
                        <div class="modal fade" id="modalQueim" tabindex="-1" role="dialog" aria-labelledby="modalQueim" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upa QUEIMADINHA</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-success">Leitos Normais</th>
                                                    <th scope="col" class="text-info">Isolamento</th>
                                                    <th scope="col" style="color:#5F9EA0">Covid-19</th>
                                                    <th scope="col" class="text-danger">Salas Vermelhas</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                        
                                                <tr>                                  
                                                    <td>
                                                        @foreach($leitos_queim_normal as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_queim_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_queim_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_queim" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_queim">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_queim_isolamento as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_queim_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_queim_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_queim" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_queim">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>


                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_queim_covid as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_queim_o" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_queim_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_queim" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_queim">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_queim_verm as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_queim_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_queim_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_queim" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_queim">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>                    
                        </div>

                        <!-- Div da UPA CLERISTON ANDRADE-->
                        <div class="modal fade" id="modalCleris" tabindex="-1" role="dialog" aria-labelledby="modalCleris" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upa CLERISTON ANDRADE</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-success">Leitos Normais</th>
                                                    <th scope="col" class="text-info">Isolamento</th>
                                                    <th scope="col" style="color:#5F9EA0">Covid-19</th>
                                                    <th scope="col" class="text-danger">Salas Vermelhas</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                        
                                                <tr>                                  
                                                    <td>
                                                        @foreach($leitos_cleris_normal as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_cleris_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_cleris_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-success" data-toggle="collapse" data-target="#info_n_cleris" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_n_cleris">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_cleris_isolamento as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_cleris_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_cleris_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-info text-light" data-toggle="collapse" data-target="#info_i_cleris" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_i_cleris">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>


                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_cleris_covid as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_cleris_o" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_cleris_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn text-light" data-toggle="collapse" data-target="#info_c_cleris" type="button" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_c_cleris">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($leitos_cleris_verm as $leito)                                           

                                                        <form action="/{{ $leito->id }}" method="POST">
                                                        @csrf

                                                        @if($leito->o2 == "Sim")
                                                        
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_cleris_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_cleris_o">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @else
                                                            
                                                            @if($leito->status == "Disponivel")
                                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#info_v_cleris" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="collapse" id="info_v_cleris">
                                                                            <textarea name="infos" id="infos" rows="10" placeholder="Insira informações sobre o paciente" required></textarea><br>
                                                                            <button class="btn btn-outline-danger mt-1 mb-4" type="submit"><strong>Reservar leito</strong></button>
                                                                            <hr>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @endif

                                                        @endif

                                                        </form>

                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>                    
                        </div>
                    </div>               
                </div>                      
            </div>
        </div>
    </div>
</div>
@endsection
