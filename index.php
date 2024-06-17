<?php 
require "config.php";

require_once MODEL . "Sql.php";
require_once ROUTES . "Route.php";

$response = file_get_contents("php://input");
$dados = json_decode($response, $true);

//Get
$dbGet = Sql::findAll();
$get = Route::GET("/users", $dbGet);
echo $get;

//Post
$dbPost = Sql::create($dados);
echo $dbPost;
$post = Route::POST("/users", $dados);
echo $post;
