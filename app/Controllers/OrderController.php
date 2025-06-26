<?php
namespace App\Controllers;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Order;

class OrderController
{
    public function index(Request $request, Response $response, $args)
    {
        $orders = Order::all();
        
        // Corrected: using getBody()->write()
        ob_start();
        require '../views/orders/order_items_show.php';
        $html = ob_get_clean();
        
        // Write the HTML content to the response body
        $response->getBody()->write($html);

        return $response;
    }

    public function show(Request $request, Response $response, $args)
    {
        $order = Order::find($args['id']);
        
        // Corrected: using getBody()->write()
        ob_start();
        require '../views/orders/order_items_show.php';
        $html = ob_get_clean();
        
        // Write the HTML content to the response body
        $response->getBody()->write($html);

        return $response;
    }

    public function completeOrder(Request $request, Response $response, $args)
    {
        $order = Order::find($args['id']);

        if (!$order) {
            return $response->withStatus(404)->write('Order not found');
        }

        // Schimbă statusul comenzii la 'completed'
        $order->status = 'completed';
        $order->save();

        return $response->withHeader('Location', '/orders/show/' . $order->id)->withStatus(302);
    }
}
