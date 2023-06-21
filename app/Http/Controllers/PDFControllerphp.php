<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;


class PDFControllerphp extends Controller
{
    public function exportPDF($id)
    {
        // Tìm hóa đơn cần xuất PDF
        $idhd = $id;
        $user = Auth::user();
        $ct_hd = DB::table('ct_hoadon')
            ->join('hoadon','hoadon.id','=','ct_hoadon.ma_hoadon')
            ->join('sanpham','sanpham.id','=','ct_hoadon.ma_sp')
            ->join('vanchuyen','vanchuyen.id','=','hoadon.ma_vanchuyen')
            ->where('hoadon.id','=',$id)
            ->get();

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        // Tạo đối tượng Dompdf
        $dompdf = new Dompdf();

        // Tạo nội dung PDF từ view và dữ liệu hóa đơn
        $html = view('hoadon_sell.invoice_pdf', compact('ct_hd','user','idhd'))->render();




        // Gán nội dung PDF cho Dompdf
        $dompdf->loadHtml($html);

        //import css/javascript
        $dompdf->setOptions($options);
        // Render PDF
        $dompdf->render();

        // Xuất file PDF
        $dompdf->stream("invoice-".$id."pdf", ["Attachment" => false]);
    }
}
