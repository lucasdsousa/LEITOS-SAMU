@extends('layouts.app')

@section('content')
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

                            <h3>Bem vindo, Administrador {{ Auth::user()->name }}!</h3> <br> <h5><strong>O que deseja fazer?</strong></h5>
                        </div>

                        <div class="card-body">
                            <button class="btn btn-outline-primary mr-3 mt-3" type="button" data-toggle="modal" data-target="#modalO2">Cadastrar Leito</button>
                            <button class="btn btn-outline-danger mr-3 mt-3" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                            </button>

                            <div class="modal fade" id="modalO2" tabindex="-1" role="dialog" aria-labelledby="modalTomba" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Informações</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="white-space: pre-wrap;">
                                            <form action="{{ route('createLeitos') }}" method="POST">
                                            @csrf
                                            <h4><strong>POSSUI PONTO DE OXIGÊNIO?</strong></h4>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="condicao" id="RadioS" value="Sim">
                                                <label class="form-check-label" for="RadioS">
                                                    Sim
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="condicao" id="RadioN" value="Nao">
                                                <label class="form-check-label" for="RadioN">
                                                    Não
                                                </label>
                                            </div>

                                            <h4 class="mt-4"><strong>TIPO DO LEITO</strong></h4>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tipo" id="Radio0" value="Normal">
                                                <label class="form-check-label" for="Radio0">
                                                    Leito Normal
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tipo" id="Radio1" value="Isolamento">
                                                <label class="form-check-label" for="Radio1">
                                                    Isolamento
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tipo" id="Radio2" value="Covid-19">
                                                <label class="form-check-label" for="Radio2">
                                                    Covid-19
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tipo" id="Radio3" value="Sala Vermelha">
                                                <label class="form-check-label" for="Radio3">
                                                    Sala Vermelha
                                                </label>
                                            </div>

                                            <button type="submit" class='btn btn-outline-primary mt-5'>CADASTRAR</button>
                                        </div>
                                    </div>                                
                                </div>                    
                            </div>
                        </div>
                    </form> 
                </div>                      
            </div>

            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">Leitos</div>

                            @if($id == 1)               
                            
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
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_t_n_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_t_n_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_t_n" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_t_n" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_t_i_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_t_i_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_t_i" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_t_i" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_t_c_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_t_c_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_t_c" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_t_c" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_t_v_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_t_v_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_t_v" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_t_v" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                            
                            <!-- @foreach ($leitos_tomba as $leito)

                                <form action="/{{ $leito->id }}" method="POST">
                                @csrf
                                    <section>
                                        <div class="card">
                                            <div class="card-body">
                                            <h5 class="text-success">Disponivel: quantidade total verde</h5>
                                            <h5 style="color:orange">Ocupados: quantidade total laranja</h5>
                                            <h5 class="text-secondary">Isolamento: quantidade total cinza</h5>
                                            <h5 class="text-dark">Covid-19: quantidade total preto</h5>
                                            <h5 class="text-danger">Salas vermelhas: quantidade total vermelho</h5>
                                            <h5 class="text-info">Pontos de O2: Azul</h5>


                                                @if($leito->o2 == "Sim")                                            

                                                    @if($leito->status == "Disponivel")
                                                        <button class="btn btn-success" type="submit"><strong class="text-light">{{ $leito->status }}<span class="badge badge-info text-light ml-3">O2</span></strong></button>
                                                    @else
                                                        <button class="btn btn-danger" type="submit"><strong class="text-light">{{ $leito->status }}<span class="badge badge-info text-light ml-3">O2</span></strong></button>
                                                    @endif

                                                @else

                                                    @if($leito->status == "Disponivel")
                                                        <button class="btn btn-success" type="submit"><strong class="text-light">{{ $leito->status }}<span class="badge badge-info text-light ml-3">O2</span></strong></button>
                                                    @else
                                                        <button class="btn btn-danger" type="submit"><strong class="text-light">{{ $leito->status }}<span class="badge badge-info text-light ml-3">O2</span></strong></button>
                                                    @endif

                                                @endif

                                                <button type="submit" class="btn btn-warning text-white"><strong>Alterar Status</strong></button>
                                            </div>
                                        </div>
                                    </section>
                                </form>

                            @endforeach -->

                            @endif

                            @if($id == 2)                           
                            
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
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_p_n_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_p_n_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_p_n" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_p_n" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_p_i_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_p_i_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_p_i" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_p_i" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @endif

                                            </form>

                                            </form>


                                            @endforeach
                                        </td>

                                        <td>
                                            @foreach($leitos_pqipe_covid as $leito)                                           

                                            <form action="/{{ $leito->id }}" method="POST">
                                            @csrf

                                            @if($leito->o2 == "Sim")
                                            
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_p_c_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_p_c_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_p_c" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_p_c" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_p_v_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_p_v_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_p_v" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_p_v" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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

                            @endif

                            @if($id == 3)                           

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
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_rn_n_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_rn_n_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_rn_n" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_rn_n" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_rn_i_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_rn_i_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_rn_i" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_rn_i" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_rn_c_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_rn_c_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_rn_c" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_rn_c" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_rn_v_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_rn_v_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_rn_v" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_rn_v" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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

                            @endif

                            @if($id == 4)                           

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
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_fx_n_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_fx_n_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_fx_n" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_fx_n" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_fx_i_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_fx_i_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_fx_i" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_fx_i" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_fx_c_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_fx_c_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                            @if($leito->status == "Disponivel")
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_fx_c" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_fx_c" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_fx_v_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_fx_v_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_fx_v" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_fx_v" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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

                            @endif

                            @if($id == 5)                           

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
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_g_n_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_g_n_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_g_n" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_g_n" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_g_i_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_g_i_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_g_i" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_g_i" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_g_c_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_g_c_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_g_c" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_g_c" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_g_v_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_g_v_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_g_v" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_g_v" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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

                            @endif

                            @if($id == 6)                           

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
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_h_n_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_h_n_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_h_n" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_h_n" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_h_i_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_h_i_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_h_i" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_h_i" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_h_c_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_h_c_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_h_c" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_h_c" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_h_v_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_h_v_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_h_v" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_h_v" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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

                            @endif

                            @if($id == 7)                           

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
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_sj_n_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_sj_n_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_sj_n" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_sj_n" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_sj_i_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_sj_i_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_sj_i" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_sj_i" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_sj_c_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_sj_c_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_sj_c" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_sj_c" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_sj_v_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_sj_v_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_sj_v" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_sj_v" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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

                            @endif

                            @if($id == 8)                           

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
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_m_n_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_m_n_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_m_n" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_m_n" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_m_i_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_m_i_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_m_i" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_m_i" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_m_c_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_m_c_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_m_c" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_m_c" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_m_v_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_m_v_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_m_v" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_m_v" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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

                            @endif

                            @if($id == 9)                           

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
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_q_n_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_q_n_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_q_n" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_q_n" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_q_i_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_q_i_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_q_i" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_q_i" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_q_c_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_q_c_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_q_c" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_q_c" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_q_v_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_q_v_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_q_v" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_q_v" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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

                            @endif

                            @if($id == 10)                           

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
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_c_n_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_c_n_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-success" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_c_n" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_c_n" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_c_i_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_c_i_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-info text-light" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_c_i" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_c_i" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-info text-light" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_c_c_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_c_c_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_c_c" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_c_c" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn text-light" type="submit" style="background-color:#5F9EA0"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_c_v_o" type="button"><strong>{{ $leito->status }}</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>

                                                    <div class="modal fade" id="modal_samu_c_v_o" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <span class="badge badge-info text-light">O2</span> <br><br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @else
                                                
                                                @if($leito->status == "Disponivel")
                                                    <button class="btn btn-warning" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @elseif($leito->status == "Ocupado")
                                                    <button class="btn btn-danger" type="submit"><strong>{{ $leito->status }}</strong></button> <br><br>
                                                @else
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_samu_c_v" type="button"><strong>{{ $leito->status }}</strong></button> <br><br>

                                                    <div class="modal fade" id="modal_samu_c_v" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informações sobre o paciente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="white-space: pre-wrap;">
                                                                    <p>{{ $leito->infos }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" type="submit"><strong>Desocupar Leito</strong></button> <br><br>
                                                                </div>
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

                            @endif

                    </div>                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
