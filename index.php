<?php
$page_title = 'Home';
require_once 'includes/header.php';
require_once 'includes/db.php';

$db = getDB();
$featured = $db->query("SELECT * FROM menu_items WHERE is_featured = 1 AND is_available = 1 LIMIT 4");
?>

<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <h1>Crafted with <em>Intention.</em><br>Poured with Care.</h1>
                <p class="mt-4 mb-5">Experience the perfect balance of ethically sourced, organic beans roasted to highlight their unique origins.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="<?php echo BASE_URL; ?>/menu.php" class="btn-primary-custom">Explore Menu</a>
                    <a href="<?php echo BASE_URL; ?>/about.php" class="btn-outline-custom">Our Story</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Featured Drinks</h2>
            <p class="section-subtitle mt-2">Our most loved creations, crafted for every mood</p>
        </div>
        <div class="row g-4">
            <?php while ($item = $featured->fetch_assoc()): ?>
            <div class="col-sm-6 col-lg-3">
                <div class="coffee-card">
                    <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="price">$<?php echo number_format($item['price'], 2); ?></span>
                            <button class="btn-add-cart" onclick="addToCart(<?php echo $item['id']; ?>, '<?php echo addslashes($item['name']); ?>', <?php echo $item['price']; ?>, '<?php echo addslashes($item['image_url']); ?>')">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?php echo BASE_URL; ?>/menu.php" class="btn-primary-custom">View Full Menu</a>
        </div>
    </div>
</section>

<section class="section" style="background:#fff;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Why Green Coffee?</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-leaf"></i></div>
                    <h5>Sustainably Sourced</h5>
                    <p class="text-muted">Every bean is ethically sourced from certified sustainable farms worldwide.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-fire"></i></div>
                    <h5>Small-Batch Roasted</h5>
                    <p class="text-muted">We roast in small batches to preserve each bean's unique flavor profile.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-heart"></i></div>
                    <h5>Made with Love</h5>
                    <p class="text-muted">Every cup is crafted with care by our passionate team of baristas.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section" style="background: var(--primary);">
    <div class="container text-center text-white">
        <i class="fas fa-robot mb-3" style="font-size:3rem; color: var(--secondary);"></i>
        <h2 style="color:white;">Meet Your AI Barista</h2>
        <p style="opacity:0.8; max-width:500px; margin:1rem auto 2rem;">Not sure what to order? Ask our AI barista for personalized recommendations based on your taste.</p>
        <a href="<?php echo BASE_URL; ?>/ai-chat.php" class="btn-primary-custom">Chat Now</a>
    </div>
</section>

<?php
$db->close();
require_once 'includes/footer.php';
?>
