<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use nguyenary\QRCodeMonkey\QRCode as Monkey;
use chillerlan\QRCode\QRCode;

class QRController extends Controller
{
    public function index(Request $request)
    {
        return view('lector_qr');
    }

    public function lectura(Request $request)
    {
        if (!$request->hasFile('imatge')) {
            return back()->with('message', [
                'text' => config('message.error_g1'),
                'type' => 'error'
            ]);
        }

        $file = $request->file('imatge');
        try {
            $result = (new QRCode)->readFromFile($file);
        } catch (\Throwable $th) {
            $result = $th->getMessage();
        }

        unlink($file);
        $content = (string) $result;
        return redirect($content);
    }

    public function articleQr(Request $request)
    {
        $fields = [
            'titol' => $request->input('titol', false),
            'descripcio' => $request->input('descripcio', false),
            'ingredients' => $request->input('ingredients', false),
            'imatge' => $request->input('imatge', false),
        ];

        $id = $request->input('id');
        $data = env('ARTICLE_URL') . $id . '?';	

        foreach ($fields as $key => $value) {
            if (!$value) {
                $data .= "&{$key}=false";
            }
        }

        try {
            $qrHtml = $this->sendToQrMonkey($data);
            return response()->json(['html' => $qrHtml]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error generating QR: ' . $e->getMessage()], 500);
        }
    }

    private function sendToQrMonkey($data)
    {
        $qrcode = new Monkey($data);

        $qrcode->setConfig([
            "body" => "star",
            "eye" => "frame14",
            "eyeBall" => "ball19",
            "bodyColor" => "#5C8B29",
            "bgColor" => "#FFFFFF",
            "eye1Color" => "#6A1195",
            "eye2Color" => "#6A1195",
            "eye3Color" => "#6A1195",
            "eyeBall1Color" => "#6A1195",
            "eyeBall2Color" => "#6A1195",
            "eyeBall3Color" => "#6A1195",
            "gradientColor1" => "#6A1195",
            "gradientColor2" => "#896B9B",
            "gradientType" => "radial",
            "gradientOnEyes" => false,
            "erf2" => ["fh"],
            "erf3" => ["fv"],
            "logo" => ""
        ]);

        $qrcode->setFileType('png');
        $qrcode->setSize(300);

        return "<img data-url='$data' height='300' alt='QR Code' src='" . $qrcode->create() . "' />";
    }

}
