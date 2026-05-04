// ===== Green Coffee Shop - Cart JS =====

function renderCart() {
    const cart = JSON.parse(localStorage.getItem('gcCart') || '[]');
    const container = document.getElementById('cartItems');
    const empty = document.getElementById('emptyCart');
    const summary = document.getElementById('orderSummary');

    if (!container) return;

    if (cart.length === 0) {
        container.innerHTML = '';
        if (empty) empty.style.display = 'block';
        return;
    }
    if (empty) empty.style.display = 'none';

    container.innerHTML = cart.map(item => `
        <div class="cart-item" id="item-${item.id}">
            <img src="${item.image}" alt="${item.name}" onerror="this.src='https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?w=200'">
            <div class="flex-grow-1">
                <div class="cart-item-name">${item.name}</div>
                <div class="cart-item-price">$${item.price.toFixed(2)}</div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button class="qty-btn" onclick="changeQty(${item.id}, -1)">−</button>
                <span class="fw-bold px-1">${item.qty}</span>
                <button class="qty-btn" onclick="changeQty(${item.id}, 1)">+</button>
            </div>
            <div class="fw-bold ms-3">$${(item.price * item.qty).toFixed(2)}</div>
            <button onclick="removeItem(${item.id})" class="btn btn-sm btn-link text-danger ms-2">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `).join('');

    updateSummary(cart);
    updateCartBadge();
}

function changeQty(id, delta) {
    let cart = JSON.parse(localStorage.getItem('gcCart') || '[]');
    const item = cart.find(i => i.id === id);
    if (!item) return;
    item.qty += delta;
    if (item.qty <= 0) cart = cart.filter(i => i.id !== id);
    localStorage.setItem('gcCart', JSON.stringify(cart));
    renderCart();
}

function removeItem(id) {
    let cart = JSON.parse(localStorage.getItem('gcCart') || '[]');
    cart = cart.filter(i => i.id !== id);
    localStorage.setItem('gcCart', JSON.stringify(cart));
    renderCart();
}

function updateSummary(cart) {
    const subtotal = cart.reduce((s, i) => s + i.price * i.qty, 0);
    const tax = subtotal * 0.15;
    const total = subtotal + tax;
    document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
    document.getElementById('tax').textContent = '$' + tax.toFixed(2);
    document.getElementById('total').textContent = '$' + total.toFixed(2);
}

async function placeOrder() {
    const cart = JSON.parse(localStorage.getItem('gcCart') || '[]');
    const name = document.getElementById('custName').value.trim();
    if (!name) { alert('Please enter your name.'); return; }
    if (cart.length === 0) { alert('Your cart is empty!'); return; }

    const subtotal = cart.reduce((s, i) => s + i.price * i.qty, 0);
    const total = subtotal * 1.15;

    const payload = {
        customer_name: name,
        customer_email: document.getElementById('custEmail').value,
        customer_phone: document.getElementById('custPhone').value,
        notes: document.getElementById('custNotes').value,
        total_amount: total.toFixed(2),
        items: cart.map(i => ({ menu_item_id: i.id, quantity: i.qty, unit_price: i.price }))
    };

    try {
        const res = await fetch('/green-coffee-shop/api/orders.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (data.success) {
            localStorage.removeItem('gcCart');
            document.getElementById('checkoutForm').style.display = 'none';
            document.getElementById('orderSuccess').style.display = 'block';
            document.getElementById('orderMsg').textContent = 'Order #' + data.order_id + ' confirmed. Thank you, ' + name + '!';
            document.getElementById('cartItems').innerHTML = '';
            document.getElementById('emptyCart').style.display = 'block';
            updateCartBadge();
        } else {
            alert('Error placing order. Please try again.');
        }
    } catch (e) {
        alert('Connection error. Make sure XAMPP is running.');
    }
}
