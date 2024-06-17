<?php 

class Method {

    private static $code;
    private static $method;
    private static $res;
    private static $req;
    private static $mensagem;

    protected static function method() {
        return $_SERVER["REQUEST_METHOD"];
    }
    protected static function path($req) {
       $url = $_SERVER["REQUEST_URI"];
       $path = parse_url($url);
       if($path["path"] === $req) {
            return true;
       }else {
            return false;
       }
    }

    protected static function send() {
        http_response_code(self::getCode());
        $content = self::getResponse() ? self::getResponse() : "";
        $msg = self::getMesagem() !== null ? self::getMesagem() : "";
        $response = [
            "method"=>self::getMethod(),
            "requisicao"=>self::getRequest(),
            "response"=>$msg,
            "data"=>$content
        ];
        return json_encode($response, JSON_UNESCAPED_SLASHES);
    }

    protected static function setCode($code) {
        self::$code = $code;
    }
    protected static function getCode() {
        return self::$code;
    }
    protected static function setMethod($method) {
        self::$method = $method;
    }
    protected static function getMethod() {
        return self::$method;
    }
    protected static function setResponse($res) {
        self::$res = $res;
    }
    protected static function getResponse() {
        return self::$res;
    }
    protected static function setRequest($req) {
        self::$req = $req;
    }
    protected static function getRequest() {
        return self::$req;
    }
    protected static function setMesagem($mensagem) {
        self::$mensagem = $mensagem;
    }
    protected static function getMesagem() {
        return self::$mensagem;
    }

}

?>