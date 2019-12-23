@extends('base.master')


@section('title', 'Accueil')

@section('content')

    <h1> TENDANCES </h1>
    @if(!empty($triSeriesNote))
        <div class="gridmn">
            @foreach($triSeriesNote as $serieNote)
                <div class="series_accueil">
                    <a href="{{route('series.show',$serieNote->id)}}"><img src="{{  url('banniere/'.$serieNote->id.'.jpg') }}"></a>
                </div>
            @endforeach
        </div>
    @endif
<br> <br>
<h2> QUELQUES UNES DE NOS SÉRIES  </h2>

@if(!empty($series))
    <div class="gridmn">
        <?php $indices=array(); ?>
                @for($i = 0;$i<5;$i++)
                <div class="series_accueil">
                    <?php $nbSeries = count($series)-1;
                    $nouveauInt = false;
                    while(!$nouveauInt){
                        $nouveauInt = false;
                        $indice=random_int(1,$nbSeries);
                        if(!in_array($indice,$indices)){
                            $indices[$indice]=$indice;
                            $nouveauInt=true;
                        }
                    }
                    ?>
                <a href="{{route('series.show',$series[array_key_last($indices)]->id)}}"><img src="{{  url('banniere/'.$series[array_key_last($indices)]->id.'.jpg') }}"></a>
                </div>
                @endfor
    </div>
@endif
@endsection
