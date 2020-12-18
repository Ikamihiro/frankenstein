<?php

namespace App\Lib\Utils;

class Config
{
    public static function loadFileEnv()
    {
        try {
            $path = ROOT . '/.env';

            if (!file_exists($path))
            {
                throw new \Exception("O arquivo não foi encontrado", 1);
            } else {
                self::getVariables();
            }
        } catch (\Exception $e) {
            echo "<br>Erro ao carregar as variáveis de ambiente:<br>" . $e->getMessage();
        }
    }

    public static function getVariables()
    {
        $file = fopen(ROOT . '/.env', 'r');
        $rLine=fread($file, filesize(ROOT . '/.env'));
        $lines=explode(PHP_EOL, $rLine);

        foreach($lines as $line)
        {
            $env = explode("=", $line);

            try {
                putenv($env[0] . "=" . $env[1]);
            }
            catch (\Exception $e)
            {
                echo "<br>Erro ao setar as variáveis de ambiente:<br>" . $e->getMessage();
            }
        }
    }
}