<?php
//front
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../app/EntityTable.php";
require_once __DIR__ . "/../app/PersonTable.php";
require_once __DIR__ . "/../app/DatabaseManager.php";

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

//Produkte
$app->get("/API/V1/Shop/Public/product/{SKU}", function (Request $request, Response $response, $args) {
    $personTable = new PersonTable();
    $product = $personTable->getActives($args["SKU"], $args["active"]);
    $response->getBody()->write(json_encode($product));
    return $response->withHeader("Content-Type", "application/json");
});

$app->get("/API/V1/Shop/Public/products", function (Request $request, Response $response, $args) {
    $personTable = new PersonTable();
    $products =$personTable->list();
    $response->$response->getBody()->write(json_encode($products));
    return $response->withHeader("Content-Type", "application/json");
});

$app->get("/API/V1/Shop/Staff/products", function (Request $request, Response $response, $args) {
    $personTable = new PersonTable();
    $product = $personTable->get($args["SKU"]);
    $response->getBody()->write(json_encode($product));
    return $response->withHeader("Content-Type", "application/json");
});


$app->put("/API/V1/Shop/Staff/product/{SKU}", function (Request $request, Response $response, $args) {
    $personTable = new PersonTable();
    $data = $request->getParsedBody();
    $data["SKU"]["Category"]["Name"]["Productpicture"]["Description"]["Price"]["Stockstatus"]["available since"];
    $productupdate = $personTable->update($data);
    $response->getBody()->write(json_encode($productupdate));
    return $response->withHeader("Content-Type", "application/json");
});

$app->delete("/API/V1/Shop/Staff/product/{SKU}", function (Request $request, Response $response, $args) {
    $personTable = new PersonTable();
    $deleteProduct = $personTable->delete($args["SKU"]);
    if ($deleteProduct == null){
        return $response->withStatus(404);
    }
    return $response->getBody()->write(null);
});




$app->get("/API/V1/Shop/Staff/Categorys", function (Request $request, Response $response, $args) {
    $personTable = new PersonTable();
    $Category = $personTable->getCategory($args["ID"]);
    $response->getBody()->write(json_encode($Category));
    return $response->withHeader("Content-Type", "application/json");
});

$app->get("/API/V1/Shop/Staff/Category/{id}", function (Request $request, Response $response, $args) {
    $personTable = new PersonTable();
    $Categorys = $personTable->getCategorys($args["ID"]);
    $response->getBody()->write(json_encode($Categorys));
    return $response->withHeader("Content-Type", "application/json");
});

$app->post("/API/V1/Shop/Staff/Category", function (Request $request, Response $response, $args) {
    $personTable = new PersonTable();
    $data = $request->getParsedBody();
    $data["Name"];
    $createCategory = $personTable->createCategory($data);
    $response->getBody()->write(json_encode($createCategory));
    return $response->withHeader("Content-Type", "application/json");
});

$app->put("/API/V1/Shop/Staff/Category/{id}", function (Request $request, Response $response, $args) {
    $personTable = new PersonTable();
    $data = $request->getParsedBody();
    $data["Name"];
    $updateCategory = $personTable->updateCategory($data, $args["ID"]);
    $response->getBody()->write(json_encode($updateCategory));
    return $response->withHeader("Content-Type", "application/json");
});

$app->delete("/API/V1/Shop/Staff/Category/{id}", function (Request $request, Response $response, $args) {
    $personTable = new PersonTable();
    $deleteCategory = $personTable->deleteCategory($args["ID"]);
    if($deleteCategory == null){
        return $response->withStatus(404);
    }
    return $response->getBody()->write(null);
});

$app->run();
?>

