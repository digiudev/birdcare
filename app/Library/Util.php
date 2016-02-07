<?php

namespace App\Library;

class Util
{
    public static function toTimestamp($dataNormale)
    {
        $dataNormale = trim($dataNormale);
        if ($dataNormale == '')
            return 0;

        $dataNormale = str_replace("/", "-", $dataNormale);
        $dataNormale = str_replace(" ", "-", $dataNormale);
        $dataNormale = str_replace("\\", "-", $dataNormale);

        $data = explode("-", $dataNormale);
        if (sizeof($data) != 3)
            return 0;
        $data[1] = (int)($data[1]);
        $data[0] = (int)($data[0]);
        $data[2] = (int)($data[2]);

        // Verifico se per caso � notazione americanta
        if (strlen($data[0]) > 2) {
            // Probabilmente � notazione americana.. dannati!
            $oldD = $data;
            $data[2] = $oldD[0];
            $data[0] = $oldD[2];
        }
        if (strlen($data[2]) == 2) {
            // Se ha scrfitto "12-12-98" devo convertirlo in "12-12-1998"
            $anno = '20' . $data[2];
            if ($anno > date('Y'))
                $data[2] = '19' . $data[2];
            else
                $data[2] = '20' . $data[2];
        }
        return mktime(0, 0, 0, $data[1], $data[0], $data[2]);
    }
}