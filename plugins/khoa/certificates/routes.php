<?php
    use Khoa\Certificates\Models\Nienkhoa;
    use Khoa\Certificates\Models\Nhomnganh;
    use Khoa\Warehouse\Models\Warehouse;

    Route::get('/test',function(){
        $test = Warehouse::find(1);
        foreach ($test->json_data_xuat as $t){
            dd($t['ma_so']);
        }
        dd($test->json_data_xuat);
    });

?>