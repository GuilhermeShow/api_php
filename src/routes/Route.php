<?php 

require_once ROUTES . "Method.php";
class Route extends Method {

    private static $authorization;

    public static function GET($req, $res, $auth = null) {
        if(self::method() === "GET"){
            if(self::path($req)) {
                if($auth != null){
                    $authorization = self::setAuthorization($auth);
                    return $authorization;
                }else{
                    self::setCode(200);
                    self::setMethod("GET");
                    self::setRequest($req);
                    self::setResponse($res);
                    self::setMesagem("Listagem de usuarios");
                    return self::send();
                }
            }else {
                http_response_code(401);
                return json_encode(["erro"=>true,"msg"=>"Não foi possivel realizar a requisição"]);
            }
        }
    }

    public static function POST($req, $res, $auth = null) {
        if(self::method() === "POST") {
            if(self::path($req)) {
                if($auth != null){
                    $authorization = self::setAuthorization($auth);
                    return $authorization;
                }else{
                    self::setCode(200);
                    self::setMethod("POST");
                    self::setRequest($req);
                    self::setResponse($res);
                    self::setMesagem("Usuario criado com sucesso");
                    return self::send();
                }
            }else {
                http_response_code(401);
                return json_encode(["erro"=>true,"msg"=>"Não foi possivel realizar a requisição"]);
            }
        }
    } 

    public static function DELETE($req, $res, $auth = null) {
        if(self::method() === "DELETE") {
            if(self::path($req)) {
                if($auth != null){
                    $authorization = self::setAuthorization($auth);
                    return $authorization;
                }else{
                    self::setCode(200);
                    self::setMethod("DELETE");
                    self::setRequest($req);
                    self::setResponse($res);
                    self::setMesagem("Usuario deletado com sucesso");
                    return self::send();
                }
            }else {
                http_response_code(401);
                return json_encode(["erro"=>true,"msg"=>"Não foi possivel realizar a requisição"]);
            }
        }
    }

    public static function PUT($req, $res, $auth = null) {
        if(self::method() === "PUT") {
            if(self::path($req)) {
                if($auth != null){
                    $authorization = self::setAuthorization($auth);
                    return $authorization;
                }else{
                    self::setCode(200);
                    self::setMethod("PUT");
                    self::setRequest($req);
                    self::setResponse($res);
                    self::setMesagem("Usuario atualizado com sucesso");
                    return self::send();
                }
            }else {
                http_response_code(401);
                return json_encode(["erro"=>true,"msg"=>"Não foi possivel realizar a requisição"]);
            }
        }else {
            http_response_code(401);
            return json_encode(["erro"=>true,"msg"=>"Não foi possivel realizar a requisição"]);
        }
    }
    private static function setAuthorization($bearer) {

        self::$authorization = $_SERVER["HTTP_AUTHORIZATION"];
        if(isset(self::$authorization)) {
            if(strpos(self::$authorization, "Bearer") !== false){
                $auth = explode(" ", self::$authorization);
                if($auth === $bearer) {
                    return json_encode(["erro"=>false,"msg"=>"logado","token"=>$bearer]);
                }else{
                    return json_encode(["erro"=>true,"msg"=>"Token invalido"]);
                }
            }else {
                return "Token invalido tente novamente";
            }
        }else {
            return "Você não possui permisão para acessar essa area :(";
        }

    }

  

   
   

}

?>