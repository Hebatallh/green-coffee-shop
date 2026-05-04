// ===== Green Coffee Shop - Main JS =====

// Update cart badge count from localStorage
function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('gcCart') || '[]');
    const count = cart.reduce((sum, i) => sum + i.qty, 0);
    const badge = document.getElementById('cartCount');
    if (badge) badge.textContent = count;
}

// Add item to cart
function addToCart(id, name, price, image) {
    let cart = JSON.parse(localStorage.getItem('gcCart') || '[]');
    const existing = cart.find(i => i.id === id);
    if (existing) {
        existing.qty++;
    } else {
        cart.push({ id, name, price: parseFloat(price), image, qty: 1 });
    }
    localStorage.setItem('gcCart', JSON.stringify(cart));
    updateCartBadge();
    showToast(name + ' added to cart!');
}

// Simple toast notification
function showToast(msg) {
    let toast = document.getElementById('gcToast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'gcToast';
        toast.style.cssText = `
            position:fixed; bottom:24px; right:24px; z-index:9999;
            background:#2D5016; color:white; padding:12px 24px;
            border-radius:50px; font-size:0.9rem; font-weight:500;
            box-shadow:0 4px 20px rgba(0,0,0,0.2);
            transition: opacity 0.3s; opacity:0;
        `;
        document.body.appendChild(toast);
    }
    toast.textContent = '✓ ' + msg;
    toast.style.opacity = '1';
    setTimeout(() => { toast.style.opacity = '0'; }, 2500);
}

// Run on every page load
document.addEventListener('DOMContentLoaded', updateCartBadge);
