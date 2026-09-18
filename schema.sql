-- ============================================
-- TUGAS RUTIN 8
-- CRUD INVENTARIS
-- ============================================

USE inventaris_db;

-- ============================================
-- TABLE: categories
-- ============================================

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- ============================================
-- TABLE: suppliers
-- ============================================

CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20)
);

-- ============================================
-- TABLE: products
-- ============================================

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    category_id INT NOT NULL,
    supplier_id INT NOT NULL,
    price DECIMAL(12,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,

    CONSTRAINT fk_products_category
        FOREIGN KEY (category_id)
        REFERENCES categories(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_products_supplier
        FOREIGN KEY (supplier_id)
        REFERENCES suppliers(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

-- ============================================
-- SEED DATA: CATEGORIES
-- Minimal 5 data
-- ============================================

INSERT INTO categories (name) VALUES
('Elektronik'),
('Aksesoris'),
('Peralatan Kantor'),
('Komputer'),
('Jaringan');

-- ============================================
-- SEED DATA: SUPPLIERS
-- Minimal 5 data
-- ============================================

INSERT INTO suppliers (name, phone) VALUES
('PT Sinar Teknologi', '081234567801'),
('CV Maju Bersama', '081234567802'),
('PT Digital Nusantara', '081234567803'),
('CV Mitra Komputer', '081234567804'),
('PT Solusi Jaringan', '081234567805');

-- ============================================
-- SEED DATA: PRODUCTS
-- Minimal 5 data
-- ============================================

INSERT INTO products
(name, category_id, supplier_id, price, stock)
VALUES
('Laptop ASUS Vivobook', 4, 1, 8500000, 10),
('Mouse Logitech M331', 2, 2, 325000, 25),
('Keyboard Mechanical', 2, 3, 750000, 15),
('Monitor LG 24 Inch', 1, 4, 2200000, 8),
('Router TP-Link Archer', 5, 5, 650000, 12);