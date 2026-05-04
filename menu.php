<?php
$page_title = 'Menu';
require_once 'includes/header.php';
require_once 'includes/db.php';

$db = getDB();
$categories = $db->query("SELECT * FROM categories");
$cat_filter = isset($_GET['cat']) ? $_GET['cat'] : '';

if ($cat_filter) {
    $stmt = $db->prepare("SELECT m.*, c.name as cat_name FROM menu_items m JOIN categories c ON m.category_id = c.id WHERE c.slug = ? AND m.is_available = 1");
    $stmt->bind_param("s", $cat_filter);
} else {
    $stmt = $db->prepare("SELECT m.*, c.name as cat_name FROM menu_items m JOIN categories c ON m.category_id = c.id WHERE m.is_available = 1 ORDER BY m.category_id");
    $stmt->bind_param("");
}
$stmt->execute();
$items = $stmt->get_result();
?>

<div class="page-header">
    <h1>Our Menu</h1>
    <p>Carefully crafted drinks and locally sourced treats, prepared with intention.</p>
</div>

<section class="section">
    <div class="container">
        <!-- Category Filter -->
        <div class="d-flex justify-content-center category-filter mb-5">
            <a href="/green-coffee-shop/menu.php" class="btn-filter <?php echo !$cat_filter ? 'active' : ''; ?>">All Items</a>
            <?php
            $categories->data_seek(0);
            while ($cat = $categories->fetch_assoc()):
            ?>
            <a href="/green-coffee-shop/menu.php?cat=<?php echo $cat['slug']; ?>" class="btn-filter <?php echo $cat_filter === $cat['slug'] ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($cat['name']); ?>
            </a>
            <?php endwhile; ?>
        </div>

        <!-- Items Grid -->
        <div class="row g-4">
            <?php while ($item = $items->fetch_assoc()): ?>
            <div class="col-sm-6 col-lg-3">
                <div class="coffee-card">
                    <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    <div class="card-body">
                        <span style="font-size:0.75rem; color:var(--text-muted); font-weight:500; text-transform:uppercase; letter-spacing:0.5px;"><?php echo htmlspecialchars($item['cat_name']); ?></span>
                        <h5 class="card-title mt-1"><?php echo htmlspecialchars($item['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="price">$<?php echo number_format($item['price'], 2); ?></span>
                            <button class="btn-add-cart" onclick="addToCart(<?php echo $item['id']; ?>, '<?php echo addslashes($item['name']); ?>', <?php echo $item['price']; ?>, '<?php echo addslashes($item['image_url']); ?>')">
                                <i class="fas fa-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php
$db->close();
require_once 'includes/footer.php';
?>
