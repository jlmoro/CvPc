<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Image,File,Storage,DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function captura_error($e,$mensaje=null)
    {
        $tmp=[
            'url_origen'=>url()->previous(),
            'url_destino'=>url()->current(),
            'mensaje'=>$e->getMessage(),
            'mensaje_personalizado'=>$mensaje,
            'error'=>substr($e,0,1999),
            'archivo'=>$e->getFile(),
            'linea'=>$e->getLine(),
            'parametros'=>json_encode(request()->all()),
            // 'traza'=>json_encode($e->getTrace()),
            // 'created_by'=>auth()->user()->id,
        ];

        if (auth()->check()) {
            $tmp['created_by']=auth()->user()->id;
        }

        // $errores = Errores::create($tmp);

        return [
            'error'=>$mensaje??config('domains.error.general'),
            'error2'=>"{$e->getMessage()} - en la línea: {$e->getLine()}",
            'error3'=>"{$e->getFile()} - en la línea: {$e->getLine()}",
            // 'error4'=>$e->getTrace(),
            // 'error5'=>"Reportado en {$errores->id}",
        ];

    }

    public function guardar_imagen($imagen, $ruta= '')
    {
        try {
            $img = Image::make($imagen);

            $ex = explode('/',$img->mime);
            $ext = end($ex);

            $nombre_aleatorio = uniqid(rand(), true) . str_replace(" ", "", microtime()) . ".$ext";
            $subruta = ($ruta!=''?"$ruta/":'') . $nombre_aleatorio;

            Storage::put("public/$subruta", (string) $img->encode($ext));

            return [
                'estado'=>true,
                'ruta'=> $subruta,
            ];

        } catch (\Exception $e) {
            return [
                'estado'=>false,
                'ruta'=>'',
            ];
        }
    }

    public function guarda_imagen2($file,$ruta)
    {
        $ImageUpload = Image::make($file);
        $originalPath = "public/images/$ruta";
        dd($originalPath);
        $ImageUpload->save($originalPath.time().$file->getClientOriginalName());

        // guardar la miniatura

        // $thumbnailPath = "public/images/$ruta/imagen_mini";
        // $ImageUpload->resize(250,125);
        // $ImageUpload = $ImageUpload->save($thumbnailPath.time().$file->getClientOriginalName());

        return [
            'ruta'=>$originalPath,

        ];
    }
}
