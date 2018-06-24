<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

//BIODATA
//GET
$app->get('/biodata/', function (Request $request, Response $response){
	$sql = 'select * from biodata';
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
	$result=$stmt->fetchAll();
	return $response ->withJson(["status" => "oke" , "data" => $result], 200 );
});
//GET ID
$app->get("/biodata/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "SELECT * FROM biodata WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

//GET SEARCH
$app->get("/biodata/search/", function (Request $request, Response $response, $args){
    $keyword = $request->getQueryParam("keyword");
    $sql = "SELECT * FROM biodata WHERE email LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR no_hp LIKE '%$keyword%'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

//POST
$app->post("/biodata/", function (Request $request, Response $response){

    $new_book = $request->getParsedBody();

    $sql = "INSERT INTO biodata (email, nama, alamat, no_hp) VALUE (:email, :nama, :alamat, :no_hp)";
    $stmt = $this->db->prepare($sql);

    $data = [
        ":email" => $new_book["email"],
        ":nama" => $new_book["nama"],
        ":alamat" => $new_book["alamat"],
        ":no_hp" => $new_book["no_hp"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

//PUT (UPDATE)
$app->put("/biodata/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $new_book = $request->getParsedBody();
    $sql = "UPDATE biodata SET nama=:nama, alamat=:alamat, no_hp=:no_hp WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id,
        ":nama" => $new_book["nama"],
        ":alamat" => $new_book["alamat"],
        ":no_hp" => $new_book["no_hp"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

//DELETE
$app->delete("/biodata/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "DELETE FROM biodata WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

//---------------------------------------------------------
//AKUN
//GET
$app->get('/akun/', function (Request $request, Response $response){
    $sql = 'select * from akun';
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetchAll();
    return $response ->withJson(["status" => "oke" , "data" => $result], 200 );
});
//GET ID
$app->get("/akun/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "SELECT * FROM akun WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

//GET SEARCH
$app->get("/akun/search/", function (Request $request, Response $response, $args){
    $keyword = $request->getQueryParam("keyword");
    $sql = "SELECT * FROM akun WHERE email LIKE '%$keyword%'  OR password LIKE '%$keyword%' ";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

//POST
$app->post("/akun/", function (Request $request, Response $response){

    $new_book = $request->getParsedBody();

    $sql = "INSERT INTO akun (email, password) VALUE (:email,  :password, )";
    $stmt = $this->db->prepare($sql);

    $data = [
        ":email" => $new_book["email"],
        ":password" => $new_book["password"],
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

//PUT (UPDATE)
$app->put("/akun/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $new_book = $request->getParsedBody();
    $sql = "UPDATE akun SET password=:password WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id,
        ":password" => $new_book["password"],
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

//DELETE
$app->delete("/akun/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "DELETE FROM akun WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});
