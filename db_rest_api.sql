-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Feb 2024 pada 04.39
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rest_api`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comments_content` text DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comments_content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 6, 'Ok, akan segera dilaksanakan!!', '2024-02-15 19:24:11', '2024-02-15 19:24:11', NULL),
(2, 5, 6, 'Kak punya saya kok error ya unity nya', '2024-02-15 19:41:32', '2024-02-15 20:24:30', NULL),
(3, 5, 6, 'Kak, request tutorial javascript dong', '2024-02-15 19:48:00', '2024-02-15 19:48:00', NULL),
(4, 5, 6, 'Kak, request tutorial javascript dong', '2024-02-15 19:49:42', '2024-02-15 20:34:28', '2024-02-15 20:34:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_07_040504_create_posts_table', 2),
(6, '2024_02_07_041259_create_comments_table', 3),
(7, '2024_02_16_074547_add_image_column_to_posts_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(7, 'App\\Models\\User', 1, 'user login', '9f1e93928ce9719cc9f302145bde985605b7545dabf8b67b236dadeeed1db372', '[\"*\"]', '2024-02-18 18:38:34', NULL, '2024-02-15 23:29:00', '2024-02-18 18:38:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `novel_content` text NOT NULL,
  `author` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `title`, `novel_content`, `author`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Welcome to Portal Novel', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem cumque, cupiditate ab rem tempore repellendus iure obcaecati maiores quaerat aliquam possimus qui aspernatur officia quasi quas consequuntur sint eum vitae nobis architecto unde atque. Magnam id atque sapiente? Id veniam, sint hic quibusdam tempore neque vero vel fugiat ut reiciendis obcaecati amet fuga quos fugit tenetur odio! Corporis cum voluptate ea fugiat rem molestiae, atque ratione, magnam officia suscipit dolor. Quibusdam, vero repellendus. Amet, quia. Quasi modi, praesentium, voluptatem eaque explicabo corporis maxime, tempora reiciendis placeat eius iusto corrupti fugit quis ipsa? Modi mollitia obcaecati, vel aperiam inventore nostrum provident cum aut reiciendis dicta quasi commodi harum, necessitatibus iusto porro, at facere quibusdam! Aliquid accusantium soluta minima necessitatibus sapiente hic vitae doloribus et. Ipsum voluptates minima nobis atque sapiente, at minus blanditiis laboriosam et porro, mollitia ab. Minus amet, consequatur ducimus quaerat debitis incidunt quos eligendi quia! Quos fugiat tempore, est ducimus architecto, velit libero commodi repellendus accusamus praesentium suscipit quaerat vel molestiae maxime labore hic explicabo fuga unde laudantium consequatur facilis quod deleniti reiciendis nostrum. Perspiciatis voluptates aspernatur debitis beatae itaque doloremque inventore obcaecati alias veniam reprehenderit numquam veritatis cum minima vitae sit eius consequatur, est harum amet officiis a voluptatem saepe eum culpa. Quia vel voluptas ratione nemo deserunt suscipit natus est explicabo porro obcaecati. Earum repudiandae neque sit quis maiores nesciunt excepturi reiciendis quaerat hic laudantium aliquam qui eaque, velit porro sapiente laborum est a illum nostrum. Repudiandae dolorum incidunt aspernatur laboriosam id pariatur eveniet nostrum dignissimos quaerat quibusdam nesciunt, tempore deserunt repellat quisquam accusamus quasi veritatis exercitationem perspiciatis iusto ab soluta est. Officiis repudiandae, omnis quas inventore dolore ut vero a fuga delectus soluta, quaerat eaque placeat obcaecati expedita unde modi! Animi, placeat? Minima architecto, nisi maiores perspiciatis obcaecati hic tenetur, eum eaque impedit ipsam laudantium!\r\n', 1, '2024-02-07 04:29:29', NULL, NULL),
(2, 'Announcement', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem cumque, cupiditate ab rem tempore repellendus iure obcaecati maiores quaerat aliquam possimus qui aspernatur officia quasi quas consequuntur sint eum vitae nobis architecto unde atque. Magnam id atque sapiente? Id veniam, sint hic quibusdam tempore neque vero vel fugiat ut reiciendis obcaecati amet fuga quos fugit tenetur odio! Corporis cum voluptate ea fugiat rem molestiae, atque ratione, magnam officia suscipit dolor. Quibusdam, vero repellendus. Amet, quia. Quasi modi, praesentium, voluptatem eaque explicabo corporis maxime, tempora reiciendis placeat eius iusto corrupti fugit quis ipsa? Modi mollitia obcaecati, vel aperiam inventore nostrum provident cum aut reiciendis dicta quasi commodi harum, necessitatibus iusto porro, at facere quibusdam! Aliquid accusantium soluta minima necessitatibus sapiente hic vitae doloribus et. Ipsum voluptates minima nobis atque sapiente, at minus blanditiis laboriosam et porro, mollitia ab. Minus amet, consequatur ducimus quaerat debitis incidunt quos eligendi quia! Quos fugiat tempore, est ducimus architecto, velit libero commodi repellendus accusamus praesentium suscipit quaerat vel molestiae maxime labore hic explicabo fuga unde laudantium consequatur facilis quod deleniti reiciendis nostrum. Perspiciatis voluptates aspernatur debitis beatae itaque doloremque inventore obcaecati alias veniam reprehenderit numquam veritatis cum minima vitae sit eius consequatur, est harum amet officiis a voluptatem saepe eum culpa. Quia vel voluptas ratione nemo deserunt suscipit natus est explicabo porro obcaecati. Earum repudiandae neque sit quis maiores nesciunt excepturi reiciendis quaerat hic laudantium aliquam qui eaque, velit porro sapiente laborum est a illum nostrum. Repudiandae dolorum incidunt aspernatur laboriosam id pariatur eveniet nostrum dignissimos quaerat quibusdam nesciunt, tempore deserunt repellat quisquam accusamus quasi veritatis exercitationem perspiciatis iusto ab soluta est. Officiis repudiandae, omnis quas inventore dolore ut vero a fuga delectus soluta, quaerat eaque placeat obcaecati expedita unde modi! Animi, placeat? Minima architecto, nisi maiores perspiciatis obcaecati hic tenetur, eum eaque impedit ipsam laudantium!\r\n', 1, '2024-02-07 04:29:37', NULL, NULL),
(3, 'Tutorial HTML Untuk Pemula', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente excepturi repellendus fuga minima alias animi distinctio, reiciendis saepe at voluptatum magnam nihil neque magni ratione eos dolores, voluptatem ullam explicabo.', 1, '2024-02-15 01:10:05', '2024-02-15 23:29:58', '2024-02-15 23:29:58'),
(4, 'Tutorial HTML Untuk Pemula', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente excepturi repellendus fuga minima alias animi distinctio, reiciendis saepe at voluptatum magnam nihil neque magni ratione eos dolores, voluptatem ullam explicabo.', 5, '2024-02-15 01:23:38', '2024-02-15 01:23:38', NULL),
(5, 'Laravel Resful API', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus vitae repellat eveniet voluptates illo dolore sint voluptas ex aliquid. Iste mollitia voluptates magni sequi suscipit eos earum fuga fugit, reprehenderit architecto culpa veniam cumque nemo quasi exercitationem labore neque optio! Officiis aliquid voluptate saepe porro delectus veritatis consequatur provident dolorem repellendus cupiditate nemo pariatur, velit vero nisi ex aperiam blanditiis magnam libero, eveniet dolor quaerat voluptatum vel! Saepe amet optio numquam magnam temporibus id, fuga consequuntur voluptatum dolorum vel asperiores incidunt fugit earum porro culpa veritatis, maxime sapiente voluptas. Error, suscipit. Vel amet placeat impedit laboriosam, similique officiis nam incidunt. Natus eum aliquam accusantium ratione sunt accusamus iste asperiores culpa dicta reiciendis magnam provident non officia, id quibusdam error molestiae, corporis est recusandae facilis fugiat. Quidem minus molestiae unde dignissimos reiciendis facere sit eveniet sequi et autem error, nesciunt neque, nihil dolore soluta omnis quae saepe nostrum placeat. Maiores quod sequi incidunt itaque reprehenderit. Animi necessitatibus repudiandae harum similique earum, commodi consectetur temporibus recusandae nihil dolore nostrum odit a neque fugit perspiciatis praesentium odio ratione suscipit excepturi nesciunt hic, fuga esse consequatur nam? Necessitatibus quam harum inventore similique odit temporibus. Tempora, sunt veniam odit sapiente consequatur debitis nulla maiores praesentium repellat commodi nemo laboriosam animi ducimus pariatur sint ullam. Fugiat doloremque illum iure soluta et similique dicta est quos nam error, commodi in corrupti ea eos, inventore repellendus laboriosam, deleniti quasi officiis placeat! Ipsa veniam ratione similique assumenda unde, dolores quia, repellendus, quaerat architecto deserunt fuga. Impedit vel eaque odit quae, ullam veritatis laudantium, pariatur in illum recusandae facilis incidunt repellendus necessitatibus voluptatum rem ratione consectetur debitis corrupti quam nisi deserunt iste! Dignissimos voluptate ut ex aut minus sequi, architecto fugiat deserunt voluptatum eligendi nostrum fuga cumque aspernatur! Eligendi autem vitae, repudiandae excepturi doloribus eaque consectetur aperiam reiciendis quasi, explicabo, accusamus hic quos perspiciatis recusandae voluptates quaerat possimus earum! Asperiores, deserunt! Quod sunt fugit illo enim? Asperiores corrupti eligendi debitis similique nisi, veritatis odit quod, explicabo, dolorum voluptatum possimus praesentium suscipit autem minus ipsa hic eum quasi error. Possimus quis mollitia totam repellendus. Neque fugiat est et recusandae ipsa dolorum ipsum dolor culpa dignissimos voluptas minus beatae sed vitae tenetur, ab quas totam, itaque debitis. Architecto nisi dolore eligendi voluptatem! Repellendus ipsa deleniti dolor eum facilis explicabo quo dicta iure hic? Aliquid quod error delectus, perspiciatis animi, consequatur dolores unde explicabo quae debitis, soluta modi numquam perferendis quam fugit esse.', 6, '2024-02-15 01:45:43', '2024-02-15 02:39:45', NULL),
(11, 'Demonic Abyss', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus vitae repellat eveniet voluptates illo dolore sint voluptas ex aliquid. Iste mollitia voluptates magni sequi suscipit eos earum fuga fugit, reprehenderit architecto culpa veniam cumque nemo quasi exercitationem labore neque optio! Officiis aliquid voluptate saepe porro delectus veritatis consequatur provident dolorem repellendus cupiditate nemo pariatur, velit vero nisi ex aperiam blanditiis magnam libero, eveniet dolor quaerat voluptatum vel! Saepe amet optio numquam magnam temporibus id, fuga consequuntur voluptatum dolorum vel asperiores incidunt fugit earum porro culpa veritatis, maxime sapiente voluptas. Error, suscipit. Vel amet placeat impedit laboriosam, similique officiis nam incidunt. Natus eum aliquam accusantium ratione sunt accusamus iste asperiores culpa dicta reiciendis magnam provident non officia, id quibusdam error molestiae, corporis est recusandae facilis fugiat. Quidem minus molestiae unde dignissimos reiciendis facere sit eveniet sequi et autem error, nesciunt neque, nihil dolore soluta omnis quae saepe nostrum placeat. Maiores quod sequi incidunt itaque reprehenderit. Animi necessitatibus repudiandae harum similique earum, commodi consectetur temporibus recusandae nihil dolore nostrum odit a neque fugit perspiciatis praesentium odio ratione suscipit excepturi nesciunt hic, fuga esse consequatur nam? Necessitatibus quam harum inventore similique odit temporibus. Tempora, sunt veniam odit sapiente consequatur debitis nulla maiores praesentium repellat commodi nemo laboriosam animi ducimus pariatur sint ullam. Fugiat doloremque illum iure soluta et similique dicta est quos nam error, commodi in corrupti ea eos, inventore repellendus laboriosam, deleniti quasi officiis placeat! Ipsa veniam ratione similique assumenda unde, dolores quia, repellendus, quaerat architecto deserunt fuga. Impedit vel eaque odit quae, ullam veritatis laudantium, pariatur in illum recusandae facilis incidunt repellendus necessitatibus voluptatum rem ratione consectetur debitis corrupti quam nisi deserunt iste! Dignissimos voluptate ut ex aut minus sequi, architecto fugiat deserunt voluptatum eligendi nostrum fuga cumque aspernatur! Eligendi autem vitae, repudiandae excepturi doloribus eaque consectetur aperiam reiciendis quasi, explicabo, accusamus hic quos perspiciatis recusandae voluptates quaerat possimus earum! Asperiores, deserunt! Quod sunt fugit illo enim? Asperiores corrupti eligendi debitis similique nisi, veritatis odit quod, explicabo, dolorum voluptatum possimus praesentium suscipit autem minus ipsa hic eum quasi error. Possimus quis mollitia totam repellendus. Neque fugiat est et recusandae ipsa dolorum ipsum dolor culpa dignissimos voluptas minus beatae sed vitae tenetur, ab quas totam, itaque debitis. Architecto nisi dolore eligendi voluptatem! Repellendus ipsa deleniti dolor eum facilis explicabo quo dicta iure hic? Aliquid quod error delectus, perspiciatis animi, consequatur dolores unde explicabo quae debitis, soluta modi numquam perferendis quam fugit esse.', 1, '2024-02-16 01:41:46', '2024-02-16 03:00:05', NULL),
(14, 'The Heavenly Angle', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente excepturi repellendus fuga minima alias animi distinctio, reiciendis saepe at voluptatum magnam nihil neque magni ratione eos dolores, voluptatem ullam explicabo.', 1, '2024-02-16 01:48:18', '2024-02-16 01:48:18', NULL),
(15, 'Blacky', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus vitae repellat eveniet voluptates illo dolore sint voluptas ex aliquid. Iste mollitia voluptates magni sequi suscipit eos earum fuga fugit, reprehenderit architecto culpa veniam cumque nemo quasi exercitationem labore neque optio! Officiis aliquid voluptate saepe porro delectus veritatis consequatur provident dolorem repellendus cupiditate nemo pariatur, velit vero nisi ex aperiam blanditiis magnam libero, eveniet dolor quaerat voluptatum vel! Saepe amet optio numquam magnam temporibus id, fuga consequuntur voluptatum dolorum vel asperiores incidunt fugit earum porro culpa veritatis, maxime sapiente voluptas. Error, suscipit. Vel amet placeat impedit laboriosam, similique officiis nam incidunt. Natus eum aliquam accusantium ratione sunt accusamus iste asperiores culpa dicta reiciendis magnam provident non officia, id quibusdam error molestiae, corporis est recusandae facilis fugiat. Quidem minus molestiae unde dignissimos reiciendis facere sit eveniet sequi et autem error, nesciunt neque, nihil dolore soluta omnis quae saepe nostrum placeat. Maiores quod sequi incidunt itaque reprehenderit. Animi necessitatibus repudiandae harum similique earum, commodi consectetur temporibus recusandae nihil dolore nostrum odit a neque fugit perspiciatis praesentium odio ratione suscipit excepturi nesciunt hic, fuga esse consequatur nam? Necessitatibus quam harum inventore similique odit temporibus. Tempora, sunt veniam odit sapiente consequatur debitis nulla maiores praesentium repellat commodi nemo laboriosam animi ducimus pariatur sint ullam. Fugiat doloremque illum iure soluta et similique dicta est quos nam error, commodi in corrupti ea eos, inventore repellendus laboriosam, deleniti quasi officiis placeat! Ipsa veniam ratione similique assumenda unde, dolores quia, repellendus, quaerat architecto deserunt fuga. Impedit vel eaque odit quae, ullam veritatis laudantium, pariatur in illum recusandae facilis incidunt repellendus necessitatibus voluptatum rem ratione consectetur debitis corrupti quam nisi deserunt iste! Dignissimos voluptate ut ex aut minus sequi, architecto fugiat deserunt voluptatum eligendi nostrum fuga cumque aspernatur! Eligendi autem vitae, repudiandae excepturi doloribus eaque consectetur aperiam reiciendis quasi, explicabo, accusamus hic quos perspiciatis recusandae voluptates quaerat possimus earum! Asperiores, deserunt! Quod sunt fugit illo enim? Asperiores corrupti eligendi debitis similique nisi, veritatis odit quod, explicabo, dolorum voluptatum possimus praesentium suscipit autem minus ipsa hic eum quasi error. Possimus quis mollitia totam repellendus. Neque fugiat est et recusandae ipsa dolorum ipsum dolor culpa dignissimos voluptas minus beatae sed vitae tenetur, ab quas totam, itaque debitis. Architecto nisi dolore eligendi voluptatem! Repellendus ipsa deleniti dolor eum facilis explicabo quo dicta iure hic? Aliquid quod error delectus, perspiciatis animi, consequatur dolores unde explicabo quae debitis, soluta modi numquam perferendis quam fugit esse.', 1, '2024-02-16 03:01:26', '2024-02-16 03:01:47', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `firstname`, `lastname`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@gmail.com', 'admin', '$2y$10$KYA8cTmoBsathDEZ.K.iPOZ/rPXxHjz6BZ4hXHSpJRHrg9vizVlYS', 'admin', 'project', '2024-02-07 01:04:43', NULL, NULL),
(5, 'crew@gmail.com', 'crew', '$2y$10$hdU8mNJZbmcQXveuSK.HY.b6Ey0kmfGY.0HVgfLT.NMOcg0cuj5TK', 'crew', 'project', '2024-02-01 01:04:52', NULL, NULL),
(6, 'man@gmail.com', 'man', '$2y$10$4FvCEfxfahQSrMbINaHQpuc/PQRbGuXpdN/qXo0HdaEuK8VZQJyxu', 'man', 'project', '2024-02-04 01:04:58', NULL, NULL),
(7, 'tua@gmail.com', 'akuma', 'hijikatamana', 'jawaban', 'sundabar', '2024-02-18 18:29:54', '2024-02-18 18:38:34', '2024-02-18 18:38:34');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_author_foreign` (`author`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_password_unique` (`password`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
