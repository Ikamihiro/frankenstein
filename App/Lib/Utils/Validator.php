<?php


namespace App\Lib\Utils;


class Validator
{
    public static $erros = array();
    public static $resultado = true;

    /**
     * @param string $nomeAtributo
     * @param mixed $atributo
     * @param string $validacoes
     * @return void
     */
    public static function validateField(string $nomeAtributo, $atributo, string $validacoes = 'required'): void
    {
        if(!is_null($atributo) && !is_null($nomeAtributo))
        {
            self::$resultado = true;
            $regras = explode("|", $validacoes);

            foreach ($regras as $regra)
            {
                // REQUIRED -> O campo não pode ser vazio!
                if(self::contains('required', $regra))
                {
                    if(empty($atributo)) {
                        self::$resultado = false;
                        if(!isset(self::$erros[$nomeAtributo]))
                        {
                            self::$erros[$nomeAtributo] = 'O campo "' . $nomeAtributo . '" não pode ser vazio!';
                        }
                    }
                }

                // MAX -> Define o tamanho máximo do campo
                if(self::contains('max', $regra))
                {
                    $max = explode(":", $regra);
                    $tamanho = $max[1];

                    if(strlen($atributo) > $tamanho)
                    {
                        self::$resultado = false;
                        if(!isset(self::$erros[$nomeAtributo]))
                        {
                            self::$erros[$nomeAtributo] = 'O campo "' . $nomeAtributo . '" não pode ter mais que ' . $tamanho . ' caracteres';
                        }
                    }
                }

                // MIN -> Define o tamanho mínimo do campo
                if(self::contains('min', $regra))
                {
                    $min = explode(":", $regra);
                    $tamanho = $min[1];

                    if(strlen($atributo) < $tamanho)
                    {
                        self::$resultado = false;
                        if(!isset(self::$erros[$nomeAtributo]))
                        {
                            self::$erros[$nomeAtributo] = 'O campo "' . $nomeAtributo . '" não pode ter menos que ' . $tamanho . ' caracteres';
                        }
                    }
                }

                // INT -> Define que o atributo tem que ser do tipo INT
                if (self::contains('int', $regra))
                {
                    if (!is_int($atributo))
                    {
                        self::$resultado = false;
                        if(!isset(self::$erros[$nomeAtributo]))
                        {
                            self::$erros[$nomeAtributo] = 'O campo "' . $nomeAtributo . '" tem que ser do tipo "int"';
                        }
                    }
                }

                // FLOAT -> Define que o atributo tem que ser do tipo FLOAT
                if (self::contains('float', $regra))
                {
                    if (!is_float($atributo))
                    {
                        self::$resultado = false;
                        if(!isset(self::$erros[$nomeAtributo]))
                        {
                            self::$erros[$nomeAtributo] = 'O campo "' . $nomeAtributo . '" tem que ser do tipo "float"';
                        }
                    }
                }
            }
        }
    }

    /**
     * @param array $parametros
     * @param array $atributos
     * @return bool
     */
    public static function validateAll(array $parametros, array $atributos): bool
    {
        if(is_array($atributos) && is_array($parametros))
        {
            foreach ($atributos as $atributo => $validacoes)
            {
                $nomeAtributo = $atributo;
                $valorAtributo = $parametros[$atributo];
                self::validateField($nomeAtributo, $valorAtributo, $validacoes);
            }

            return self::$resultado;
        }

        return false;
    }

    /**
     * @param string $needle
     * @param string $haystack
     * @return bool
     */
    private static function contains(string $needle, string $haystack): bool
    {
        return strpos($haystack, $needle) !== false;
    }
}