<?php 
if (!isset($_SESSION['user_id'])) {
    return $response->withStatus(401)->write('You must be logged in to add an item to the order.');
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articole Comandă</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h3 class="mb-4">Produse din comandă</h3>
        
        <?php if (!empty($orderItems)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Produs</th>
                            <th>Cantitate</th>
                            <th>Preț</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderItems as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item->product->name) ?></td>
                                <td><?= $item->cantitate ?></td>
                                <td><?= number_format($item->product->pret, 2) ?> Lei</td>
                                <td><?= number_format($item->totalPrice(), 2) ?> Lei</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="alert alert-warning">Nu există produse în comandă.</p>
        <?php endif; ?>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
