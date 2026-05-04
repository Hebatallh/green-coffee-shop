-- Green Coffee Shop Database
-- Import this file in phpMyAdmin or run: mysql -u root -p < green_coffee_shop.sql

CREATE DATABASE IF NOT EXISTS green_coffee_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE green_coffee_shop;

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(500),
    is_featured TINYINT(1) DEFAULT 0,
    is_available TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(200) NOT NULL,
    customer_email VARCHAR(200),
    customer_phone VARCHAR(50),
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending','preparing','ready','completed','cancelled') DEFAULT 'pending',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    menu_item_id INT,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id)
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
    subject VARCHAR(300),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categories (name, slug) VALUES
('Hot Coffee', 'hot-coffee'),
('Cold Drinks', 'cold-drinks'),
('Tea & Herbal', 'tea-herbal'),
('Specialty', 'specialty'),
('Food', 'food');

INSERT INTO menu_items (category_id, name, description, price, image_url, is_featured) VALUES
(1, 'Signature Espresso', 'Rich, bold espresso with notes of dark chocolate and caramel.', 3.50, 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?w=600&auto=format&fit=crop', 1),
(1, 'Cappuccino', 'Classic Italian cappuccino with silky microfoam and perfect balance.', 4.50, 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=600&auto=format&fit=crop', 1),
(1, 'Oat Milk Latte', 'Smooth espresso with creamy oat milk, a plant-based favorite.', 5.50, 'https://images.unsplash.com/photo-1541167760496-1628856ab772?w=600&auto=format&fit=crop', 1),
(1, 'Pour-Over Single Origin', 'Precision-brewed single origin coffee highlighting unique terroir.', 6.00, 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600&auto=format&fit=crop', 0),
(1, 'Flat White', 'Double ristretto with silky steamed milk, strong and smooth.', 4.75, 'https://images.unsplash.com/photo-1577968897966-3d4325b36b61?w=600&auto=format&fit=crop', 0),
(2, 'Cold Brew', 'Slow-steeped for 24 hours, ultra-smooth and naturally sweet.', 5.00, 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=600&auto=format&fit=crop', 1),
(2, 'Iced Matcha Latte', 'Ceremonial grade matcha whisked with oat milk over ice.', 5.75, 'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?w=600&auto=format&fit=crop', 0),
(2, 'Vanilla Sweet Cream Iced Coffee', 'Cold brew topped with house-made sweet vanilla cream.', 5.50, 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&auto=format&fit=crop', 0),
(2, 'Lavender Lemonade', 'Fresh lemonade with house-made lavender syrup, refreshing.', 4.50, 'https://images.unsplash.com/photo-1553361371-9b22f78e8b1d?w=600&auto=format&fit=crop', 0),
(3, 'Chamomile Honey Tea', 'Organic chamomile blossoms steeped with raw local honey.', 4.00, 'https://images.unsplash.com/photo-1597318181409-cf64d0b5d8a2?w=600&auto=format&fit=crop', 0),
(3, 'Moroccan Mint Tea', 'Traditional Moroccan mint tea brewed with fresh spearmint leaves.', 4.00, 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=600&auto=format&fit=crop', 0),
(4, 'Turmeric Golden Latte', 'Warming anti-inflammatory blend with turmeric, ginger, and oat milk.', 5.50, 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=600&auto=format&fit=crop', 0),
(4, 'Lavender Honey Latte', 'Espresso with house lavender syrup, local honey, and steamed milk.', 6.00, 'https://images.unsplash.com/photo-1534778101976-62847782c213?w=600&auto=format&fit=crop', 1),
(5, 'Butter Croissant', 'Flaky, golden croissant baked fresh every morning.', 3.50, 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=600&auto=format&fit=crop', 0),
(5, 'Avocado Toast', 'Toasted sourdough with smashed avocado, sea salt, and chili flakes.', 8.50, 'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=600&auto=format&fit=crop', 0),
(5, 'Blueberry Muffin', 'Freshly baked muffin bursting with organic blueberries.', 3.00, 'https://images.unsplash.com/photo-1607958996333-41aef7caefaa?w=600&auto=format&fit=crop', 0);
