<?php
    use Khoa\Certificates\Models\Nienkhoa;
    use Khoa\Certificates\Models\Nhomnganh;

    Route::get('/test',function(){
        $nienkhoa_id = 3;
                $result = Nhomnganh::whereHas('nienkhoa', function($q) use ($nienkhoa_id){
                    $q->where('nienkhoa_id','=',$nienkhoa_id);
                });
                dd($result->lists('name', 'id'));
    });

?>