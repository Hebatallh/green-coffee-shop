<?php
require_once __DIR__ . '/config.php';
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="/green-coffee-shop/css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/green-coffee-shop/index.php">
            <i class="fas fa-mug-hot"></i> Green Coffee
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page === 'index' ? 'active' : ''; ?>" href="/green-coffee-shop/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page === 'menu' ? 'active' : ''; ?>" href="/green-coffee-shop/menu.php">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page === 'about' ? 'active' : ''; ?>" href="/green-coffee-shop/about.php">Our Story</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page === 'contact' ? 'active' : ''; ?>" href="/green-coffee-shop/contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page === 'ai-chat' ? 'active' : ''; ?>" href="/green-coffee-shop/ai-chat.php">
                        <i class="fas fa-robot"></i> AI Barista
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <a href="/green-coffee-shop/cart.php" class="btn btn-cart position-relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cartCount">0</span>
                </a>
            </div>
        </div>
    </div>
</nav>
