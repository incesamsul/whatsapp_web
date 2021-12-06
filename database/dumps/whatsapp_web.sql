
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_07_041230_create_roles_table', 1),
(5, '2021_07_27_113355_create_qrcode_table', 1),
(6, '2021_12_02_082038_create_chat_table', 1);


INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 'admin', 'admin', 'admin@mail.com', NULL, '$2y$10$gjlJr6jVR62X3GxrG2CV9.tDDDIO.qjZhNtkUFsm7Tilip0ousVKC', NULL, '2021-12-02 00:25:38', '2021-12-02 00:25:38'),
(3, 2, 'fitrah', 'fitrah', 'fitrah@mail.com', NULL, '$2y$10$6v7TvikOjm3HS7DJ2by1EOrPbX/M/wKkEfKg8HjWXVYhugpAZHmce', NULL, '2021-12-02 21:53:06', '2021-12-02 21:53:06'),
(5, 2, 'rodney', 'rodney', 'rodney@mail.com', NULL, '$2y$10$LX4U/.qUWpXZo9g.i/.71uioyjSbigHnQ/pcku8cGtps/vWucNKFO', NULL, '2021-12-02 21:56:49', '2021-12-02 21:56:49');

