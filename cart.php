<?php
$page_title = 'Cart';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <h1>Your Cart</h1>
    <p>Review your order before checkout</p>
</div>

<section class="section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="cart-wrapper">
                    <h4 class="mb-4">Order Items</h4>
                    <div id="cartItems"></div>
                    <div id="emptyCart" class="empty-cart" style="display:none;">
                        <i class="fas fa-shopping-cart"></i>
                        <h5>Your cart is empty</h5>
                        <p>Browse our menu and add some items!</p>
                        <a href="<?php echo BASE_URL; ?>/menu.php" class="btn-primary-custom mt-3">View Menu</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="order-summary">
                    <h5 class="mb-4">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-2"><span>Subtotal</span><span id="subtotal">$0.00</span></div>
                    <div class="d-flex justify-content-between mb-2"><span>Tax (15%)</span><span id="tax">$0.00</span></div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4"><span class="total">Total</span><span class="total" id="total">$0.00</span></div>
                    <div id="checkoutForm">
                        <h6 class="mb-3">Your Details</h6>
                        <div class="mb-3"><input type="text" class="form-control" id="custName" placeholder="Full Name *"></div>
                        <div class="mb-3"><input type="email" class="form-control" id="custEmail" placeholder="Email Address"></div>
                        <div class="mb-3"><input type="tel" class="form-control" id="custPhone" placeholder="Phone Number"></div>
                        <div class="mb-3"><textarea class="form-control" id="custNotes" rows="2" placeholder="Special requests..."></textarea></div>
                        <button class="btn-submit" onclick="placeOrder()"><i class="fas fa-check me-2"></i>Place Order</button>
                    </div>
                    <div id="orderSuccess" style="display:none;" class="text-center py-3">
                        <i class="fas fa-check-circle fa-3x mb-3" style="color:var(--primary);"></i>
                        <h5>Order Placed!</h5>
                        <p class="text-muted" id="orderMsg"></p>
                        <a href="<?php echo BASE_URL; ?>/menu.php" class="btn-primary-custom mt-2">Order More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo BASE_URL; ?>/js/cart.js"></script>
<script>document.addEventListener('DOMContentLoaded', renderCart);</script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
