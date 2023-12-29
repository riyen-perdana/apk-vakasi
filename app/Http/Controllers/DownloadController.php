<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download_amprah()
    {
        $filename  = 'Amprah.docx';
        $filePath = public_path(). DIRECTORY_SEPARATOR . 'storage'. DIRECTORY_SEPARATOR . $filename;
        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $fileName = 'Amprah-Vakasi '.date(now()).'.docx';
        return response()->download($filePath,$fileName,$headers);
    }

    public function download_amprah_soal()
    {
        $filename  = 'Amprah-Soal.docx';
        $filePath = public_path(). DIRECTORY_SEPARATOR . 'storage'. DIRECTORY_SEPARATOR . $filename;
        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $fileName = 'Amprah-Soal '.date(now()).'.docx';
        return response()->download($filePath,$fileName,$headers);
    }

    public function download_amprah_mengawas()
    {
        $filename  = 'Amprah-Mengawas.docx';
        $filePath = public_path(). DIRECTORY_SEPARATOR . 'storage'. DIRECTORY_SEPARATOR . $filename;
        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $fileName = 'Amprah-Mengawas '.date(now()).'.docx';
        return response()->download($filePath,$fileName,$headers);
    }

    public function download_amprah_koreksi()
    {
        $filename  = 'Amprah-Koreksi.docx';
        $filePath = public_path(). DIRECTORY_SEPARATOR . 'storage'. DIRECTORY_SEPARATOR . $filename;
        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $fileName = 'Amprah-Koreksi '.date(now()).'.docx';
        return response()->download($filePath,$fileName,$headers);
    }


}
