<?php
    use Khoa\Thuchi\Models\Thuchi;
    use Carbon\Carbon;
    use Khoa\Certificates\Models\Student;
    use Khoa\Certificates\Models\Nhomnganh;
    use Khoa\Certificates\Models\Nienkhoa;
    use Khoa\Warehouse\Models\Warehouse;

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

    

    Route::get('/seeding-warehouse', function(){
        $b=array(0,1);
        $stt = 1;
        for($i=1; $i<=50; $i++) {
            
            $random_string=array_rand($b);

            $new = new Warehouse();
            $new->ma_kho = 'CODE_'.$i;
            $new->type = $b[$random_string];
            if ($b[$random_string] == 0) {
                $new->json_data_xuat = json_decode('[{"ma_so":"Code001","ten_nhan_hieu":"ABC 1","nha_cung_cap":"ABC 1","don_vi_tinh":"m1","so_luong_nhap":"100","don_gia":"100","thanh_tien":"1000","ly_do_xuat_khau":"ABC 1","ho_ten_nguoi_nhan":"ABC 1"},{"ma_so":"Code 002","ten_nhan_hieu":"ABC 2","quy_cach_vat_tu":"ABC 2","dung_cu_hang_hoa":"ABC 2","nha_cung_cap":"ABC 2","don_vi_tinh":"m2","so_luong_nhap":"200","don_gia":"200","thanh_tien":"2000","ly_do_xuat_khau":"ABC 2","ho_ten_nguoi_nhan":"ABC 2"},{"ma_so":"Code 003","ten_nhan_hieu":"ABC 3","quy_cach_vat_tu":"ABC 3","dung_cu_hang_hoa":"ABC 3","nha_cung_cap":"ABC 3","don_vi_tinh":"m3","so_luong_nhap":"300","don_gia":"300","thanh_tien":"3000","ly_do_xuat_khau":"ABC 3","ho_ten_nguoi_nhan":"ABC 3"}]');
            } else {
                $new->json_data_nhap = json_decode('[{"ma_so":"Nhap001","ten_nhan_hieu":"CDE001","nha_cung_cap":"m1","don_vi_tinh":"100","so_luong_nhap":"100","don_gia":"100","thanh_tien":"1000"},{"ma_so":"Nhap002","ten_nhan_hieu":"CDE002","quy_cach_vat_tu":"CDE002","dung_cu_hang_hoa":"CDE002","nha_cung_cap":"CDE002","don_vi_tinh":"m2","so_luong_nhap":"200","don_gia":"200","thanh_tien":"2000"},{"ma_so":"Nhap003","ten_nhan_hieu":"CDE003","quy_cach_vat_tu":"CDE003","dung_cu_hang_hoa":"CDE003","nha_cung_cap":"CDE003","don_vi_tinh":"m3","so_luong_nhap":"300","don_gia":"300","thanh_tien":"3000"}]');
                
            }
            
            $new->ngay_xuat_phieu = Carbon::now();
            $new->tong_so_tien_viet_bang_chu = 'Một trăm tỷ';
            $new->so_chung_tu_goc_kem_theo = 99;
            $new->save();
            $stt++;
        }

        return 'Seeding warehouse success';
    });

?>