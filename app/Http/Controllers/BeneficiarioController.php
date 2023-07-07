<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beneficiario;
use App\Models\Endereco;
use App\Models\Telefone;
use App\Models\User;
use App\http\Requests\BeneficiarioRequest;

class BeneficiarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isSecretario', User::class);
        $beneficiario = Beneficiario::all();


        return view('beneficiarios.index', compact('beneficiario'));
    }

    public function create()
    {
        $this->authorize('isSecretario', User::class);
        return view('beneficiarios.create');
    }

    public function edit($id)
    {
        $this->authorize('isSecretario', User::class);
        $beneficiario = Beneficiario::find($id);
        $endereco = Endereco::find($beneficiario->endereco_id);
        $telefone = Telefone::find($beneficiario->telefone_id);
        return view('beneficiario.edit', compact('beneficiario', 'endereco', 'telefone'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeneficiarioRequest $request)
    {
        $this->authorize('isSecretario', User::class);
        $input = $request->all();

        $beneficiario = new Beneficiario();
        $endereco = new Endereco();
        $telefone = new Telefone();
        $endereco->setAtributes($input);
        $endereco->save();
        $telefone->setNumero($input['celular']);
        $telefone->save();
        $beneficiario->setAtributes($input);
        $beneficiario->endereco_id = $endereco->id;
        $beneficiario->telefone_id = $telefone->id;
        $beneficiario->save();

        return redirect(route('beneficiario.index'))->with(['success' => 'Beneficiário cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('isSecretario', User::class);
        $beneficiario = Beneficiario::find($id);
        $endereco = Endereco::find($beneficiario->endereco_id);
        $telefone = Telefone::find($beneficiario->telefone_id);
        return view('beneficiarios.show', compact('beneficiario', 'endereco', 'telefone'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
    
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BeneficiarioRequest $request, $id)
    {
        $this->authorize('isSecretario', User::class);
        $beneficiario = Beneficiario::find($id);
        $input = $request->all();
        $endereco = Endereco::find($beneficiario->endereco_id);
        $telefone = Telefone::find($beneficiario->telefone_id);
        $endereco->setAtributes($input);
        $endereco->update();
        $telefone->setNumero($input['celular']);
        $telefone->update();
        $beneficiario->setAtributes($input);
        $beneficiario->endereco_id = $endereco->id;
        $beneficiario->telefone_id = $telefone->id;
        $beneficiario->update();
        return redirect(route('beneficiario.index'))->with(['success' => 'Beneficiário editado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        this->authorize('isSecretario', User::class);
        $beneficiario = Beneficiario::find($id);
        $endereco = Endereco::find($beneficiario->endereco_id);
        $telefone = Telefone::find($beneficiario->telefone_id);
        $beneficiario->delete();
        $endereco->delete();
        $telefone->delete();
        return redirect(route('beneficiario.index'))->with(['success' => 'Beneficiário excluído com sucesso!']);
    }
}
