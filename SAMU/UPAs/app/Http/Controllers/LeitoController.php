<?php

namespace App\Http\Controllers;

use App\Leito;
use App\Leito_upa1;
use App\Leito_upa2;
use App\Leito_upa3;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Hash;
use Hashids\Hashids;

class LeitoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id(); //Dar get no ID do usuario que fizer login

        $leitos = Leito::with('User')->get();

        $leitos_all = DB::table('leitos')->where('id_upa', '=', $id)->count();

        $qtd_tomba   = DB::table('leitos')->where('id_upa', 1)->where('status', 'Disponivel')->count();
        $qtd_pqipe   = DB::table('leitos')->where('id_upa', 2)->where('status', 'Disponivel')->count();
        $qtd_ruanova = DB::table('leitos')->where('id_upa', 3)->where('status', 'Disponivel')->count();
        $qtd_feirax  = DB::table('leitos')->where('id_upa', 4)->where('status', 'Disponivel')->count();
        $qtd_george  = DB::table('leitos')->where('id_upa', 5)->where('status', 'Disponivel')->count();
        $qtd_humild  = DB::table('leitos')->where('id_upa', 6)->where('status', 'Disponivel')->count();
        $qtd_saojose = DB::table('leitos')->where('id_upa', 7)->where('status', 'Disponivel')->count();
        $qtd_mangab  = DB::table('leitos')->where('id_upa', 8)->where('status', 'Disponivel')->count();
        $qtd_queim   = DB::table('leitos')->where('id_upa', 9)->where('status', 'Disponivel')->count();
        $qtd_cleris  = DB::table('leitos')->where('id_upa', 10)->where('status', 'Disponivel')->count();
        
        $leitos_tomba   = DB::table('leitos')->where('id_upa', 1)->get();
        $leitos_pqipe   = DB::table('leitos')->where('id_upa', 2)->get();
        $leitos_ruanova = DB::table('leitos')->where('id_upa', 3)->get();
        $leitos_feirax  = DB::table('leitos')->where('id_upa', 4)->get();
        $leitos_george  = DB::table('leitos')->where('id_upa', 5)->get();
        $leitos_humild  = DB::table('leitos')->where('id_upa', 6)->get();
        $leitos_saojose = DB::table('leitos')->where('id_upa', 7)->get();
        $leitos_mangab  = DB::table('leitos')->where('id_upa', 8)->get();
        $leitos_queim   = DB::table('leitos')->where('id_upa', 9)->get();
        $leitos_cleris  = DB::table('leitos')->where('id_upa', 10)->get();

        $leitos_tomba_disp   = DB::table('leitos')->where('id_upa', 1)->where('status', 'Disponivel')->get();
        $leitos_pqipe_disp   = DB::table('leitos')->where('id_upa', 2)->where('status', 'Disponivel')->get();
        $leitos_ruanova_disp = DB::table('leitos')->where('id_upa', 3)->where('status', 'Disponivel')->get();
        $leitos_feirax_disp  = DB::table('leitos')->where('id_upa', 4)->where('status', 'Disponivel')->get();
        $leitos_george_disp  = DB::table('leitos')->where('id_upa', 5)->where('status', 'Disponivel')->get();
        $leitos_humild_disp  = DB::table('leitos')->where('id_upa', 6)->where('status', 'Disponivel')->get();
        $leitos_saojose_disp = DB::table('leitos')->where('id_upa', 7)->where('status', 'Disponivel')->get();
        $leitos_mangab_disp  = DB::table('leitos')->where('id_upa', 8)->where('status', 'Disponivel')->get();
        $leitos_queim_disp   = DB::table('leitos')->where('id_upa', 9)->where('status', 'Disponivel')->get();
        $leitos_cleris_disp  = DB::table('leitos')->where('id_upa', 10)->where('status', 'Disponivel')->get();

        $leitos_tomba_ocup   = DB::table('leitos')->where('id_upa', 1)->where('status', '!=', 'Disponivel')->get();
        $leitos_pqipe_ocup   = DB::table('leitos')->where('id_upa', 2)->where('status', '!=', 'Disponivel')->get();
        $leitos_ruanova_ocup = DB::table('leitos')->where('id_upa', 3)->where('status', '!=', 'Disponivel')->get();
        $leitos_feirax_ocup  = DB::table('leitos')->where('id_upa', 4)->where('status', '!=', 'Disponivel')->get();
        $leitos_george_ocup  = DB::table('leitos')->where('id_upa', 5)->where('status', '!=', 'Disponivel')->get();
        $leitos_humild_ocup  = DB::table('leitos')->where('id_upa', 6)->where('status', '!=', 'Disponivel')->get();
        $leitos_saojose_ocup = DB::table('leitos')->where('id_upa', 7)->where('status', '!=', 'Disponivel')->get();
        $leitos_mangab_ocup  = DB::table('leitos')->where('id_upa', 8)->where('status', '!=', 'Disponivel')->get();
        $leitos_queim_ocup   = DB::table('leitos')->where('id_upa', 9)->where('status', '!=', 'Disponivel')->get();
        $leitos_cleris_ocup  = DB::table('leitos')->where('id_upa', 10)->where('status', '!=', 'Disponivel')->get();

        $leitos_tomba_normal   = DB::table('leitos')->where('id_upa', 1)->where('tipo_leito', 'Normal')->get();
        $leitos_pqipe_normal   = DB::table('leitos')->where('id_upa', 2)->where('tipo_leito', 'Normal')->get();
        $leitos_ruanova_normal = DB::table('leitos')->where('id_upa', 3)->where('tipo_leito', 'Normal')->get();
        $leitos_feirax_normal  = DB::table('leitos')->where('id_upa', 4)->where('tipo_leito', 'Normal')->get();
        $leitos_george_normal  = DB::table('leitos')->where('id_upa', 5)->where('tipo_leito', 'Normal')->get();
        $leitos_humild_normal  = DB::table('leitos')->where('id_upa', 6)->where('tipo_leito', 'Normal')->get();
        $leitos_saojose_normal = DB::table('leitos')->where('id_upa', 7)->where('tipo_leito', 'Normal')->get();
        $leitos_mangab_normal  = DB::table('leitos')->where('id_upa', 8)->where('tipo_leito', 'Normal')->get();
        $leitos_queim_normal   = DB::table('leitos')->where('id_upa', 9)->where('tipo_leito', 'Normal')->get();
        $leitos_cleris_normal  = DB::table('leitos')->where('id_upa', 10)->where('tipo_leito', 'Normal')->get();

        $leitos_tomba_isolamento   = DB::table('leitos')->where('id_upa', 1)->where('tipo_leito', 'Isolamento')->get();
        $leitos_pqipe_isolamento   = DB::table('leitos')->where('id_upa', 2)->where('tipo_leito', 'Isolamento')->get();
        $leitos_ruanova_isolamento = DB::table('leitos')->where('id_upa', 3)->where('tipo_leito', 'Isolamento')->get();
        $leitos_feirax_isolamento  = DB::table('leitos')->where('id_upa', 4)->where('tipo_leito', 'Isolamento')->get();
        $leitos_george_isolamento  = DB::table('leitos')->where('id_upa', 5)->where('tipo_leito', 'Isolamento')->get();
        $leitos_humild_isolamento  = DB::table('leitos')->where('id_upa', 6)->where('tipo_leito', 'Isolamento')->get();
        $leitos_saojose_isolamento = DB::table('leitos')->where('id_upa', 7)->where('tipo_leito', 'Isolamento')->get();
        $leitos_mangab_isolamento  = DB::table('leitos')->where('id_upa', 8)->where('tipo_leito', 'Isolamento')->get();
        $leitos_queim_isolamento   = DB::table('leitos')->where('id_upa', 9)->where('tipo_leito', 'Isolamento')->get();
        $leitos_cleris_isolamento  = DB::table('leitos')->where('id_upa', 10)->where('tipo_leito', 'Isolamento')->get();

        $leitos_tomba_covid   = DB::table('leitos')->where('id_upa', 1)->where('tipo_leito', 'Covid-19')->get();
        $leitos_pqipe_covid   = DB::table('leitos')->where('id_upa', 2)->where('tipo_leito', 'Covid-19')->get();
        $leitos_ruanova_covid = DB::table('leitos')->where('id_upa', 3)->where('tipo_leito', 'Covid-19')->get();
        $leitos_feirax_covid  = DB::table('leitos')->where('id_upa', 4)->where('tipo_leito', 'Covid-19')->get();
        $leitos_george_covid  = DB::table('leitos')->where('id_upa', 5)->where('tipo_leito', 'Covid-19')->get();
        $leitos_humild_covid  = DB::table('leitos')->where('id_upa', 6)->where('tipo_leito', 'Covid-19')->get();
        $leitos_saojose_covid = DB::table('leitos')->where('id_upa', 7)->where('tipo_leito', 'Covid-19')->get();
        $leitos_mangab_covid  = DB::table('leitos')->where('id_upa', 8)->where('tipo_leito', 'Covid-19')->get();
        $leitos_queim_covid   = DB::table('leitos')->where('id_upa', 9)->where('tipo_leito', 'Covid-19')->get();
        $leitos_cleris_covid  = DB::table('leitos')->where('id_upa', 10)->where('tipo_leito', 'Covid-19')->get();

        $leitos_tomba_verm   = DB::table('leitos')->where('id_upa', 1)->where('tipo_leito', 'Sala Vermelha')->get();
        $leitos_pqipe_verm   = DB::table('leitos')->where('id_upa', 2)->where('tipo_leito', 'Sala Vermelha')->get();
        $leitos_ruanova_verm = DB::table('leitos')->where('id_upa', 3)->where('tipo_leito', 'Sala Vermelha')->get();
        $leitos_feirax_verm  = DB::table('leitos')->where('id_upa', 4)->where('tipo_leito', 'Sala Vermelha')->get();
        $leitos_george_verm  = DB::table('leitos')->where('id_upa', 5)->where('tipo_leito', 'Sala Vermelha')->get();
        $leitos_humild_verm  = DB::table('leitos')->where('id_upa', 6)->where('tipo_leito', 'Sala Vermelha')->get();
        $leitos_saojose_verm = DB::table('leitos')->where('id_upa', 7)->where('tipo_leito', 'Sala Vermelha')->get();
        $leitos_mangab_verm  = DB::table('leitos')->where('id_upa', 8)->where('tipo_leito', 'Sala Vermelha')->get();
        $leitos_queim_verm   = DB::table('leitos')->where('id_upa', 9)->where('tipo_leito', 'Sala Vermelha')->get();
        $leitos_cleris_verm  = DB::table('leitos')->where('id_upa', 10)->where('tipo_leito', 'Sala Vermelha')->get();

        $tomba   = DB::table('users')->select('name')->where('id', 1)->first()->name;
        $pqipe   = DB::table('users')->select('name')->where('id', 2)->first()->name;
        $ruanova = DB::table('users')->select('name')->where('id', 3)->first()->name;
        $feirax  = DB::table('users')->select('name')->where('id', 4)->first()->name;
        $george  = DB::table('users')->select('name')->where('id', 5)->first()->name;
        $humild  = DB::table('users')->select('name')->where('id', 6)->first()->name;
        $saojose = DB::table('users')->select('name')->where('id', 7)->first()->name;
        $mangab  = DB::table('users')->select('name')->where('id', 8)->first()->name;
        $queim   = DB::table('users')->select('name')->where('id', 9)->first()->name;
        $cleris  = DB::table('users')->select('name')->where('id', 10)->first()->name;

        //Condição para login de usuarios diferentes e mostrar informações e controles diferentes
        if($id == 999) {
            return view('home_samu', compact('leitos',
            'qtd_tomba', 'qtd_pqipe', 'qtd_ruanova', 'qtd_feirax', 'qtd_george', 
            'qtd_humild', 'qtd_saojose', 'qtd_mangab', 'qtd_cleris', 'qtd_queim',

            'tomba', 'pqipe', 'ruanova', 'feirax', 'george', 'humild', 'saojose', 
            'mangab', 'queim', 'cleris',

            'leitos_tomba', 'leitos_pqipe', 'leitos_ruanova', 'leitos_feirax', 'leitos_george', 
            'leitos_humild', 'leitos_saojose', 'leitos_mangab', 'leitos_queim', 'leitos_cleris',
            
            'leitos_tomba_disp', 'leitos_pqipe_disp', 'leitos_ruanova_disp', 'leitos_feirax_disp', 
            'leitos_george_disp', 'leitos_humild_disp', 'leitos_saojose_disp', 'leitos_mangab_disp', 
            'leitos_queim_disp', 'leitos_cleris_disp',
            
            'leitos_tomba_ocup', 'leitos_pqipe_ocup', 'leitos_ruanova_ocup', 'leitos_feirax_ocup', 
            'leitos_george_ocup', 'leitos_humild_ocup', 'leitos_saojose_ocup', 'leitos_mangab_ocup', 
            'leitos_queim_ocup', 'leitos_cleris_ocup',
            
            'leitos_tomba_normal', 'leitos_pqipe_normal', 'leitos_ruanova_normal', 'leitos_feirax_normal', 
            'leitos_george_normal', 'leitos_humild_normal', 'leitos_saojose_normal', 'leitos_mangab_normal', 
            'leitos_queim_normal', 'leitos_cleris_normal',
            
            'leitos_tomba_isolamento', 'leitos_pqipe_isolamento', 'leitos_ruanova_isolamento', 
            'leitos_feirax_isolamento', 'leitos_george_isolamento', 'leitos_humild_isolamento', 
            'leitos_saojose_isolamento', 'leitos_mangab_isolamento', 'leitos_queim_isolamento', 
            'leitos_cleris_isolamento',
            
            'leitos_tomba_covid', 'leitos_pqipe_covid', 'leitos_ruanova_covid', 'leitos_feirax_covid', 
            'leitos_george_covid', 'leitos_humild_covid', 'leitos_saojose_covid', 'leitos_mangab_covid', 
            'leitos_queim_covid', 'leitos_cleris_covid',
            
            'leitos_tomba_verm', 'leitos_pqipe_verm', 'leitos_ruanova_verm', 'leitos_feirax_verm', 
            'leitos_george_verm', 'leitos_humild_verm', 'leitos_saojose_verm', 'leitos_mangab_verm', 
            'leitos_queim_verm', 'leitos_cleris_verm'));
        }
        else {
            return view('home', compact('leitos', 'id',
            'leitos_tomba', 'leitos_pqipe', 'leitos_ruanova', 'leitos_feirax', 'leitos_george', 
            'leitos_humild', 'leitos_saojose', 'leitos_mangab', 'leitos_queim', 'leitos_cleris',
            
            'leitos_tomba_disp', 'leitos_pqipe_disp', 'leitos_ruanova_disp', 'leitos_feirax_disp', 
            'leitos_george_disp', 'leitos_humild_disp', 'leitos_saojose_disp', 'leitos_mangab_disp', 
            'leitos_queim_disp', 'leitos_cleris_disp',
            
            'leitos_tomba_ocup', 'leitos_pqipe_ocup', 'leitos_ruanova_ocup', 'leitos_feirax_ocup', 
            'leitos_george_ocup', 'leitos_humild_ocup', 'leitos_saojose_ocup', 'leitos_mangab_ocup', 
            'leitos_queim_ocup', 'leitos_cleris_ocup',
            
            'leitos_tomba_normal', 'leitos_pqipe_normal', 'leitos_ruanova_normal', 'leitos_feirax_normal', 
            'leitos_george_normal', 'leitos_humild_normal', 'leitos_saojose_normal', 'leitos_mangab_normal', 
            'leitos_queim_normal', 'leitos_cleris_normal',
            
            'leitos_tomba_isolamento', 'leitos_pqipe_isolamento', 'leitos_ruanova_isolamento', 
            'leitos_feirax_isolamento', 'leitos_george_isolamento', 'leitos_humild_isolamento', 
            'leitos_saojose_isolamento', 'leitos_mangab_isolamento', 'leitos_queim_isolamento', 
            'leitos_cleris_isolamento',
            
            'leitos_tomba_covid', 'leitos_pqipe_covid', 'leitos_ruanova_covid', 'leitos_feirax_covid', 
            'leitos_george_covid', 'leitos_humild_covid', 'leitos_saojose_covid', 'leitos_mangab_covid', 
            'leitos_queim_covid', 'leitos_cleris_covid',
            
            'leitos_tomba_verm', 'leitos_pqipe_verm', 'leitos_ruanova_verm', 'leitos_feirax_verm', 
            'leitos_george_verm', 'leitos_humild_verm', 'leitos_saojose_verm', 'leitos_mangab_verm', 
            'leitos_queim_verm', 'leitos_cleris_verm',
            
            'leitos_all'));
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id_upa = Auth::id();

        DB::table('leitos')->insertGetId(
                ['status' => 'Disponivel',
                'o2' => $request->input('condicao'),
                'tipo_leito' => $request->input('tipo'),
                'id_upa' => $id_upa]
            );        

        return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leito  $leito
     * @return \Illuminate\Http\Response
     */
    public function show(Leito $leito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leito  $leito
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $find_id = Leito::where('id', $id)->first()->id;
        $find_status = Leito::where('id', $id)->first()->status;

        $id_user = Auth::id();

        /*if($id_user == 1){
            if($status_upa1->status == "Livre") {
                DB::table('leito_upa1s')
                ->where('id', $id)
                ->update(['status' => 'Ocupado']);
            }
            else {
                DB::table('leito_upa1s')
                ->where('id', $id)
                ->update(['status' => 'Livre']);
            }
        }

        else if($id_user == 2) {
            if($status_upa2->status == "Livre") {
                DB::table('leito_upa2s')
                ->where('id', $id)
                ->update(['status' => 'Ocupado']);
            }
            else {
                DB::table('leito_upa2s')
                ->where('id', $id)
                ->update(['status' => 'Livre']);
            }
        }

        else if($id_user == 3) {
            if($status_upa3->status == "Livre") {
                DB::table('leito_upa3s')
                ->where('id', $id)
                ->update(['status' => 'Ocupado']);
            }
            else {
                DB::table('leito_upa3s')
                ->where('id', $id)
                ->update(['status' => 'Livre']);
            }
        }

        else if($id_user == 999) {
            if($status_upa1->status == "Livre") {
                DB::table('leito_upa1s')
                ->where('id', $id)
                ->update(['status' => 'Ocupado']);
            }
        }*/

        if($id_user != 999) {
            if($find_status == "Disponivel") {
                DB::table('leitos')
                ->where('id', $find_id)
                ->update(['status' => 'Ocupado']);
            }
            else {
                DB::table('leitos')
                ->where('id', $find_id)
                ->update(['status' => 'Disponivel', 'infos' => NULL]);
            }
        }
        else {
            if($find_status == "Disponivel") {
                DB::table('leitos')
                ->where('id', $find_id)
                ->update(['status' => 'Reservado pela SAMU', 'infos' => $request->input('infos')]);
            }
        }

        return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leito  $leito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leito $leito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leito  $leito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leito $leito)
    {
        //
    }
}
