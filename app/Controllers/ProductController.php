<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class ProductController
{
    public function index(Request $request, Response $response, $args)
    {
        // Preia termenul de căutare din query string, dacă există
        $query = $request->getQueryParams()['query'] ?? '';
        // Preia categoria selectată din query string, dacă există
        $categoryId = $request->getQueryParams()['categorie_id'] ?? '';

        // Începe construirea interogării pentru produse
        $productsQuery = Product::query();

        // Dacă există un termen de căutare, filtrează după nume
        if ($query) {
            $productsQuery->where('nume', 'like', '%' . $query . '%');
        }

        // Dacă există o categorie selectată, filtrează după categorie
        if ($categoryId) {
            $productsQuery->where('categorie_id', $categoryId);
        }

        // Obține produsele care îndeplinesc criteriile de filtrare
        $products = $productsQuery->get();

        // Preia toate categoriile pentru dropdown-ul de filtrare
        $categories = Category::all();

        // Începe bufferul de ieșire
        ob_start();

        // Include view-ul de index, trimițând produsele, categoriile și termenul de căutare
        require '../views/products/index.php';

        // Captează conținutul generat în buffer
        $html = ob_get_clean();

        // Scrie conținutul în răspuns
        $response->getBody()->write($html);

        return $response;
    }




    public function create(Request $request, Response $response, $args)
{
    session_start();
    $userId = $_SESSION['user_id'] ?? null;

    // Получаем текущего пользователя
    $user = User::find($userId);

    // Проверяем роль пользователя
    if (!$user || $user->role !== 'admin') {
        return $response->withHeader('Location', '/products')->withStatus(403); // Acces interzis
    }

    // Получаем все категории
    $categories = Category::all();

    // Передаем информацию о пользователе в шаблон
    ob_start();
    require '../views/products/create.php';
    $html = ob_get_clean();
    $response->getBody()->write($html);
    return $response;
}


public function store(Request $request, Response $response, $args)
{
    // Получаем данные из формы
    $productData = $request->getParsedBody();

    // Просто создаем новый продукт без обработки изображения
    Product::create($productData);

    // Перенаправляем на страницу продуктов
    return $response
        ->withHeader('Location', '/products')
        ->withStatus(302);
}

    public function edit(Request $request, Response $response, $args)
    {
        $categories = Category::all();
        $product = Product::find($args['id']);
        ob_start();
        require '../views/products/edit.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    public function update(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $product = Product::find($args['id']);

        // Verifică dacă a fost încărcată o nouă imagine
        $uploadedFiles = $request->getUploadedFiles();
        if (isset($uploadedFiles['imagine']) && $uploadedFiles['imagine']->getError() === UPLOAD_ERR_OK) {
            $image = $uploadedFiles['imagine'];

            // Nume unic pentru noua imagine
            $filename = uniqid() . '_' . $image->getClientFilename();
            $targetPath = '../public/uploads/' . $filename;
            $image->moveTo($targetPath);

            // Șterge imaginea veche dacă există și nu este imaginea implicită
            if ($product->imagine && $product->imagine !== 'default.png') {
                unlink('../public/uploads/' . $product->imagine);
            }

            // Actualizează calea imaginii în datele produsului
            $data['imagine'] = $filename;
        }

        // Actualizează produsul cu noile date
        $product->fill($data);
        $product->save();

        // Redirecționează utilizatorul
        return $response
            ->withHeader('Location', '/products')
            ->withStatus(302);
    }


    public function delete(Request $request, Response $response, $args)
    {
        $product = Product::find($args['id']);
        $product->delete();
        return $response
            ->withHeader('Location', '/products')
            ->withStatus(302);
    }

    public function show(Request $request, Response $response, $args)
    {
        $product = Product::find($args['id']);
        ob_start();
        require '../views/products/product_details.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

}
