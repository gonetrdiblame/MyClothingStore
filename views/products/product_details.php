<?php
session_start();
use App\Models\Product;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
        }

        .product-details {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .product-details h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }

        .product-info {
            margin-top: 20px;
            font-size: 1.1rem;
        }

        .product-info p {
            line-height: 1.8;
        }

        .product-actions {
            margin-top: 30px;
        }

        .btn {
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 8px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .col-md-6,
        .col-md-12 {
            padding: 0;
        }

        .product-info strong {
            color: #007bff;
        }

        .btn.btn-warning.mt-2 {
            margin-left: 0;
        }
    </style>
</head>

<body>

    <?php include '../views/navbar.php'; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="product-details">
                    <h1><?= $product->nume ?></h1>

                    <div class="row">
                        <!-- Product Info -->
                        <div class="col-md-12">
                            <div class="product-info">
                                <p><strong>Description:</strong> <?= htmlspecialchars($product->descriere) ?></p>
                                <p><strong>Price:</strong> <?= number_format($product->pret, 2) ?> Lei</p>
                                <p><strong>Stock:</strong> <?= $product->stoc ?> units</p>
                                <p><strong>Type:</strong> <?= htmlspecialchars($product->tip) ?></p>
                                <p><strong>Benefits:</strong> <?= htmlspecialchars($product->beneficii) ?></p>
                                <p><strong>Category:</strong> <?= htmlspecialchars($product->categorie->nume ?? 'N/A') ?></p>
                            </div>

                            <!-- Add to Cart Button -->
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <form action="/order-items/add" method="POST">
                                    <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                                    <input type="hidden" name="cantitate" value="1"> <!-- Default quantity is 1 -->
                                    <button type="submit" class="btn btn-warning mt-2">
                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                    </button>
                                </form>
                            <?php else: ?>
                                <p>Please <a href="/users/login">log in</a> to add products to your cart.</p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>

        <div class="container mt-4">
            <h3>Leave a Review</h3>
            <form action="/reviews/store" method="POST">
                <input type="hidden" name="product_id" value="<?= $product->id ?>">
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">

                <div class="mb-3">
                    <label for="rating" class="form-label">Rating (1-5):</label>
                    <select class="form-select" name="rating" required>
                        <option value="" selected disabled>Select a rating</option>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="comentariu" class="form-label">Comment:</label>
                    <textarea class="form-control" name="comentariu" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </div>
    <?php else: ?>
        <p class="text-center mt-4">Please <a href="/users/login">log in</a> to leave a review.</p>
    <?php endif; ?>

    <div class="container mt-5">
        <h3>Reviews</h3>
        <?php if ($product->reviews->count() > 0): ?>
            <?php foreach ($product->reviews as $review): ?>
                <div class="review mb-4 p-3 border rounded shadow-sm">
                    <strong><?= htmlspecialchars($review->user->name ?? 'Anonymous') ?></strong>
                    <p>Rating: <?= $review->rating ?> / 5</p>
                    <p><?= htmlspecialchars($review->comentariu) ?></p>
                    <small class="text-muted">Posted on: <?= date('d M Y', strtotime($review->data)) ?></small>

                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $review->user_id): ?>
                        <!-- Delete button -->
                        <form action="/reviews/delete/<?= $review->id ?>" method="POST" style="display: inline-block;"
                            onsubmit="return confirmDelete()">
                            <input type="hidden" name="_METHOD" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">No reviews yet. Be the first to leave one!</p>
        <?php endif; ?>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this review?");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
