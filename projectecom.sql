-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Nov 2025 pada 03.41
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectecom`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Men', 'men', 'Clothing for men', '2025-11-15 10:23:10', '2025-11-15 10:23:10'),
(2, 'Women', 'women', 'Clothing for women', '2025-11-15 10:23:10', '2025-11-15 10:23:10'),
(3, 'Kids', 'kids', 'Clothing for kids', '2025-11-15 10:23:10', '2025-11-16 21:17:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `favourites`
--

CREATE TABLE `favourites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(12,2) NOT NULL,
  `status` enum('pending','paid','shipped','completed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `price`, `stock`, `description`, `image`, `created_at`, `updated_at`) VALUES
(10, 1, 'Shadow Blend Denim Hoodie Jacket', 'shadow-blend-denim-hoodie-jacket', 450000.00, 10, 'Jaket denim dengan desain layered hoodie yang memberi tampilan modern, edgy, dan maskulin. Dibuat dari bahan denim premium yang kuat namun tetap nyaman dipakai. Hoodie abu-abu berbahan fleece lembut menambahkan kesan kasual sekaligus hangat saat digunakan.\r\n\r\nDetail ritsleting halus, kantong depan yang fungsional, serta rib pada lengan dan pinggang membuat jaket ini cocok dipakai untuk aktivitas harian—kuliah, nongkrong, hingga streetwear look.\r\n\r\nCocok untuk kamu yang ingin tampil simpel tapi tetap stylish.', 'products/jaket1.jpg', '2025-11-21 02:05:32', '2025-11-21 02:05:32'),
(11, 1, 'Midnight Essential Oversized Tee', 'midnight-essential-oversized-tee', 150000.00, 45, 'Kaos oversized warna hitam dengan desain clean dan minimalis, dibuat dari bahan katun premium yang lembut, adem, dan nyaman dipakai sepanjang hari. Potongan relaxed fit memberikan tampilan modern dan effortless, cocok untuk outfit harian, ngampus, nongkrong, maupun layering dengan jaket favorit.\r\n\r\nDijahit rapi, tidak mudah melar, dan tahan cuci, menjadikan kaos ini sebagai essential piece yang wajib dimiliki siapa pun yang suka gaya simple tapi tetap stylish.\r\n\r\nCocok untuk kamu yang ingin tampil santai dengan kualitas maksimal.', 'products/kaos1.jpg', '2025-11-21 02:06:54', '2025-11-21 02:06:54'),
(12, 2, 'CreamSoft Cozy Knit Sweater', 'creamsoft-cozy-knit-sweater', 220000.00, 13, 'Sweater rajut warna cream dengan tekstur lembut dan halus yang memberikan kenyamanan maksimal saat dipakai. Dibuat dari bahan knit premium yang hangat namun tetap ringan, sehingga cocok digunakan untuk cuaca dingin, ngampus, jalan malam, atau sekadar tampil stylish dengan gaya minimalis.\r\n\r\nDesain crewneck klasik dan rib pada lengan serta pinggang membuat tampilannya rapi dan elegan. Warna cream yang netral memudahkan kamu memadukannya dengan jeans, chinos, ataupun outer favorit.\r\n\r\nSweater ini adalah pilihan tepat untuk kamu yang ingin tampil cozy, clean, dan classy.', 'products/sweater1.jpg', '2025-11-21 08:05:05', '2025-11-21 08:05:05'),
(13, 2, 'BlueMist Classic Knit Cardigan', 'bluemist-classic-knit-cardigan', 180000.00, 32, 'Cardigan rajut warna biru lembut dengan desain klasik yang memberikan tampilan rapi, hangat, dan elegan. Dibuat dari bahan knit premium yang halus dan nyaman, cardigan ini cocok digunakan sebagai outer harian — baik untuk ngampus, hangout, maupun acara semi-formal.\r\n\r\nDilengkapi kancing depan berkualitas, dua kantong fungsional, serta rib-knit pada bagian lengan dan pinggang untuk memberikan kesan fit yang rapi. Warna BlueMist yang kalem mudah dipadukan dengan kaos polos, turtleneck, atau kemeja favoritmu.\r\n\r\nPilihan ideal untuk gaya simple, cozy, dan berkelas.', 'products/kardigan1.jpg', '2025-11-21 08:06:15', '2025-11-21 08:06:15'),
(14, 3, 'Pink Blossom Kids Dress', 'pink-blossom-kids-dress', 220000.00, 15, 'Gaun anak berwarna pink pastel dengan desain klasik yang manis dan elegan. Terbuat dari bahan lembut dan ringan sehingga nyaman dipakai sepanjang hari. Detail kerah bulat, lengan puff, dan kancing depan menambah kesan vintage yang adorable.\r\n\r\nRok bawahnya memiliki potongan mengembang dengan sentuhan lace di bagian hem yang membuat tampilan semakin cantik. Cocok dipakai untuk acara keluarga, ulang tahun, foto OOTD, atau sekadar tampil rapi di hari spesial.\r\n\r\nGaun ini memberikan tampilan anggun, lembut, dan ceria untuk si kecil.', 'products/gaun1.jpg', '2025-11-21 08:09:46', '2025-11-21 08:09:46'),
(15, 3, 'Navy Striped Kids Shirt', 'navy-striped-kids-shirt', 150000.00, 40, 'Kemeja anak berlengan pendek dengan motif garis vertikal navy–white yang memberikan tampilan rapi, trendy, dan modern. Dibuat dari bahan katun lembut yang adem dan nyaman dipakai sepanjang hari, sehingga cocok untuk aktivitas sekolah, acara keluarga, atau jalan-jalan.\r\n\r\nDetail kerah klasik, kancing depan berkualitas, serta kantong kecil di bagian dada menambah kesan stylish dan clean. Motif striped-nya membuat si kecil terlihat lebih fresh dan fashionable tanpa berlebihan.\r\n\r\nIdeal untuk anak yang aktif, rapi, dan suka tampil keren di setiap kesempatan.', 'products/kemejaanak1.jpg', '2025-11-21 08:10:24', '2025-11-21 08:10:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') NOT NULL DEFAULT 'customer',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$zFeks1Ao2KrykkbqUhFVLeshV6FrEDcbPk5ivxwrOLIbabTibEOmG', 'admin', '2025-11-17 22:01:59', '2025-11-17 22:02:20'),
(3, 'Adla', 'adlafayyaz@gmail.com', '$2y$10$/IodVyraJ1WVeTQHGMEF9ONJgZhnkb66AnlKm9YR.WjPTv/Gy9dOa', 'customer', '2025-11-15 11:08:29', '2025-11-15 11:08:29');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_unique` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeks untuk tabel `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_product_unique` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
