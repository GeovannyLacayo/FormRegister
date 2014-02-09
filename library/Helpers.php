<?php
/*
 * @Descripcion: of helpers
 * Es una clase que contienen metodos que sirven para todas las paginas, son metodos
 * colaboradores para obtener diferentes actividades comunes y repetitivas.
 * @author: Jeison varilla 
 * @version: 0.1 Beta
 * @link: www.keyphercom.com - 2012
 * @license: Libre uso - GNU -GPL
 */
class Helpers {
  
  
    /*
     * Metodo pageName, obtiene el titulo de la pagina de la pagina actual
     */

    public function pageName() {
        return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
    }

    /*
     * Metodo shortWords, Cortador de palabras
     */

    public static function shortWords($word, $num) {
        $longer = strlen($word);
        $cadena = substr($word, 0, $num);
        return $cadena;
    }

    /*
     * Metodo seoUrl, url enriquesida para el SEO
     */

    public static function seoUrl($id, $title) {
        $seo = str_replace(" ", "-", $title);
        $url = $seo . "p" . $id . ".html";
        return $url;
    }
   
    /*
     * Metodo absoluteUrl: url absoluta del sitio
     */
    public static function absoluteUrl()
    {
        $local =  "/curso_php5";
        $server = 'http://'.$_SERVER['SERVER_NAME'].'/';
        return $server;
    } 
    
    /*
     * emailValid: Valida el correo del lado del servidor
     */

    public static function emailValid($email) {
        $mail_correcto = 0;
        //compruebo unas cosas primeras
        if ((strlen($email) >= 6) && (substr_count($email, "@") == 1) && (substr($email, 0, 1) != "@") && (substr($email, strlen($email) - 1, 1) != "@")) {
            if ((!strstr($email, "'")) && (!strstr($email, "\"")) && (!strstr($email, "\\")) && (!strstr($email, "\$")) && (!strstr($email, " "))) {
                //miro si tiene caracter .
                if (substr_count($email, ".") >= 1) {
                    //obtengo la terminacion del dominio
                    $term_dom = substr(strrchr($email, '.'), 1);
                    //compruebo que la terminaci�n del dominio sea correcta
                    if (strlen($term_dom) > 1 && strlen($term_dom) < 5 && (!strstr($term_dom, "@"))) {
                        //compruebo que lo de antes del dominio sea correcto
                        $antes_dom = substr($email, 0, strlen($email) - strlen($term_dom) - 1);
                        $caracter_ult = substr($antes_dom, strlen($antes_dom) - 1, 1);
                        if ($caracter_ult != "@" && $caracter_ult != ".") {
                            $mail_correcto = 1;
                        }
                    }
                }
            }
        }
        if ($mail_correcto)
            return true;
        else
            return false;
    }

    /*
     * validDatas: valida si los datos post, get, request, verificando si
     *             estan vacios
     */

    public static function validDatas($datas) {
        $vacio = "";

        foreach ($datas as $d) {

            if ($d == $vacio) {
                return false;
            }
        }
        return true;
    }
    
}
