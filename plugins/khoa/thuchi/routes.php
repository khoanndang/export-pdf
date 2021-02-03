<?php
    use Khoa\Thuchi\Models\Thuchi;
    use Carbon\Carbon;
    use Khoa\Certificates\Models\Student;
    use Khoa\Certificates\Models\Nhomnganh;
    use Khoa\Certificates\Models\Nienkhoa;
    use Khoa\Warehouse\Models\Warehouse;

    Route::get('/seeding-thu-chi',function(){
        $a=array(0,1);

        for($i=1; $i<=50; $i++) {
            $random_keys=array_rand($a,1);
            $new = new Thuchi();
            $new->ngay_xuat_phieu = Carbon::now();
            $new->nienkhoa_id = 1;
            $new->thuctapsinh_id = 3;
            $new->full_name = 'Nguyễn Văn C';
            $new->cmnd = '123456789';
            $new->address = 'HCM';
            $new->ly_do = 'ABC';
            $new->type = $random_keys;
            $new->so_tien = 100000;
            $new->kem_theo = 100;
            $new->viet_bang_chu = 'Một trăm ngàn';
            $new->save();
        }

        return 'Seeding thu-chi success';
    });

    Route::get('/seeding-certificate',function(){
        $b=array(1,2);

        for($i=1; $i<=50; $i++) {
            $random_string=array_rand($b);
            //get nhom nganh
            $nganh = Nhomnganh::find($b[$random_string]);
            //get nien khoa
            $nienkhoa = Nienkhoa::find(1);

            $new = new Student();
            $new->dob = Carbon::now();
            $new->nienkhoa_id = 1;
            $new->nhomnganh_id = $nganh->id;
            $new->ho_ten = 'Nguyễn Văn A';
            $new->cmnd = '123456789';
            $new->que_quan = 'An Giang';
            $new->noi_sinh = 'HCM';
            $new->noi_cap = 'HCM';
            $new->nghiep_vu = $nganh->nghiep_vu;
            $new->ngoai_ngu = $nganh->ngoai_ngu;
            $new->kien_thuc = $nganh->kien_thuc;
            $new->slug_nganh = $nganh->slug;
            $new->start = $nienkhoa->start;
            $new->end = $nienkhoa->end;
            $new->save();
        }

        return 'Seeding certificate success';
    });

    Route::get('/seeding-warehouse', function(){
        $b=array(0,1);
        $stt = 1;
        for($i=1; $i<=50; $i++) {
            
            $random_string=array_rand($b);

            $new = new Warehouse();
            $new->ma_kho = 'CODE_'.$i;
            $new->type = $b[$random_string];
            $new->full_name = 'Nguyễn Văn A';
            $new->theo = 'Nguyễn Văn A';
            $new->thoi_gian = Carbon::now();
            $new->cua = 'Nguyễn Văn A';
            $new->dia_chi = 'HCM';
            $new->tai_kho = 'HCM';
            $new->dia_diem = 'HCM';
            $new->json_data = json_decode('[{"name_field":"test 1","ma_so":"001","don_vi_tinh":"m3","theo_chung_tu":"ABC 1","thuc_nhap":"100000","don_gia":"100000","thanh_tien":"100000"},{"name_field":"test 2","ma_so":"002","don_vi_tinh":"m2","theo_chung_tu":"ABC 2","thuc_nhap":"200000","don_gia":"200000","thanh_tien":"200000"},{"name_field":"test 3","ma_so":"003","don_vi_tinh":"m1","theo_chung_tu":"ABC 3","thuc_nhap":"300000","don_gia":"300000","thanh_tien":"300000"}]');
            $new->ngay_xuat_phieu = Carbon::now();
            $new->ly_do = 'ABC';
            $new->tong_so_tien_viet_bang_chu = 'Một trăm tỷ';
            $new->so_chung_tu_goc_kem_theo = 99;
            $new->save();
            $stt++;
        }

        return 'Seeding warehouse success';
    });

?>