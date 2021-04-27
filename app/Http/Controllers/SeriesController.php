<?php


namespace App\Http\Controllers;


use App\Models\Episodio;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use App\Models\User;
use App\Services\CriadorDeSeries;
use App\Services\RemovedorDeSerie;
use App\Models\Temporada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $series = DB::table('series')->orderBy('nome')->paginate(4);
        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSeries $criadorDeSeries)
    {
        $serie = $criadorDeSeries->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        );

        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->nome} inserida com sucesso!"
            );

        return redirect()->route('listar_series');
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);

        $request->session()
            ->flash(
                'mensagem',
                "Série $nomeSerie excluida com sucesso!"
            );
        return redirect()->route('listar_series');
    }

    public function editaNome(int $id, Request $request)
    {
        $serie = Serie::find($id);
        $novoNome = $request->nome;
        $serie->nome = $novoNome;
        $serie->save();
    }
}
