<?php
namespace App\Services;
use App\{Serie, Temporada, Episodio};
use App\Events\SerieApagada;
use App\Jobs\ExcluirCapaSerie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class RemovedorDeSerie
{
    public function removerSerie(int $serieId): string
    {
        $nomeSerie = '';
        DB::transaction(function () use ($serieId, &$nomeSerie) {
            $serie = Serie::find($serieId);
            $serieobj = (object)$serie->toArray();
            //dd($serie, $serieobj);
            $nomeSerie = $serie->nome;
            $this->removerTemporadas($serie);
            $serie->delete();
            $evento = new SerieApagada($serieobj);//cria evento
            event($evento);//emite evento pra ser ouvido pelo listener mas está inativo pois o job ta ativo
            ExcluirCapaSerie::dispatch($serieobj);//Aqui acontece a exclusao de fato pelo job excluir capa
        });
        return $nomeSerie;
    }
/*transformou em objeto para excluir a capa depois pois depois de deletar a serie não tem mais a serie, 
criando o objeto é possivel excluir a capa*/
    /**
     * @param $serie
     */
    private function removerTemporadas(Serie $serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }
    /**
     * @param Temporada $temporada
     */
    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}