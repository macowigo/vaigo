
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `centers` (
  `centerid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `centername` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `centerlocation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `centers`
--
INSERT INTO `centers` (`centerid`, `centername`, `centerlocation`, `type`, `created_at`, `updated_at`) VALUES
('1233', 'City boys shop', 'Majengo, Nyerere Square, Dodoma, Tanzania', 'center', NULL, NULL),
('1491', 'CDT, Kahama', 'Kahama Mjini, Tanzania', 'center', NULL, NULL),
('2589', 'MWANZA', 'Uhuru street, Mwanza', 'agentlocation', NULL, NULL),
('2726', 'DAR ES SALAAM', 'Sinza', 'agentlocation', NULL, NULL),
('2987', 'Gaming lounge', 'Uhuru Street, Mwanza, Tanzania', 'center', NULL, NULL),
('3328', 'Super clean dry cleaners', 'Kilombero Market, Arusha, Tanzania', 'center', NULL, NULL),
('3453', 'Iringa ABC Terminal', 'Iringa, Tanzania', 'center', NULL, NULL),
('7286', 'DODOMA', 'Nyerere square', 'agentlocation', NULL, NULL),
('7387', 'IRINGA', 'ABC Terminal', 'agentlocation', NULL, NULL),
('7782', 'DAR ES SALAAM', 'Kinondoni', 'agentlocation', NULL, NULL),
('8041', 'Dar Free Market', 'Dar Free Market Mall, Ali Hassan Mwinyi Road, Dar es Salaam, Tanzania', 'center', NULL, NULL),
('8295', 'ARUSHA', 'Kilombero market', 'agentlocation', NULL, NULL),
('8660', 'KAHAMA', 'CDT', 'agentlocation', NULL, NULL),
('8744', 'DAR ES SALAAM', 'Makumbusho', 'agentlocation', NULL, NULL),
('9885', 'Iringa ABC Terminal', 'Iringa', 'center', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_06_210407_create_customers_table', 2),
(6, '2022_08_07_075234_create_oders_table', 3),
(7, '2022_08_07_085836_create_oders_table', 4),
(8, '2022_08_07_152655_create_companies_table', 5),
(9, '2022_08_10_144817_create_centers_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `oders`
--

CREATE TABLE `oders` (
  `oderid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `center` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customerid` int(10) DEFAULT NULL,
  `customernames` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customerphone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_location` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delv_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delv_latitude` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delv_longitude` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_latitude` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_longitude` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delv_names` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delv_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `py_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_value` int(200) DEFAULT NULL,
  `ord_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` date NOT NULL DEFAULT current_timestamp(),
  `delivery_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pick_up` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desination` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parcel_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oder_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `riderid` int(10) DEFAULT NULL,
  `ridernames` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `riderphone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oders`
--

INSERT INTO `oders` (`oderid`, `center`, `customerid`, `customernames`, `customerphone`, `order_type`, `trans`, `from_location`, `delv_location`, `delv_latitude`, `delv_longitude`, `from_latitude`, `from_longitude`, `delv_names`, `delv_phone`, `py_type`, `value`, `item_value`, `ord_details`, `created_time`, `created_date`, `delivery_type`, `pick_up`, `desination`, `parcel_size`, `oder_status`, `riderid`, `ridernames`, `riderphone`, `updated_at`, `created_at`) VALUES
('1084461', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Mwenge Social Hall, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '0620374650', 'Customer Pays Full', '2000', 20000, 'Television', '2022-09-06 11:51:56', '2022-09-06', 'standard', NULL, NULL, NULL, 'created', NULL, NULL, NULL, '2022-09-06 11:51:56', '2022-09-06 11:51:56'),
('1108130', '8041', NULL, NULL, NULL, 'domestic', 'motocycle', 'Dar Free Market Mall, Ali Hassan Mwinyi Road, Dar es Salaam, Tanzania', 'Ubungo Plaza Limited, Morogoro Rd, Dar es Salaam, Tanzania', '-6.7945083', '39.2153298', '-6.7850987', '39.27742189999999', 'yuyu', '0652216509', 'Order Fully Paid', '6500', 76000, 'michupa', '2022-09-14 15:20:13', '2022-09-14', 'express', NULL, NULL, NULL, 'created', NULL, NULL, NULL, '2022-09-14 15:20:13', '2022-09-14 15:20:13'),
('1976907', '8744', NULL, 'Juma Abdul', '0768132939', 'regional', NULL, 'DAR ES SALAAM', 'DODOMA', NULL, NULL, NULL, NULL, 'Hemed shabani', '0768132939', NULL, '10000', 100000, 'Mbegu', '2022-09-29 07:58:08', '2022-09-29', NULL, 'Dodoma', '7491', 'Small', 'at delivery center', NULL, NULL, NULL, '2022-10-05 10:12:37', '2022-09-29 07:58:08'),
('2137157', '8744', NULL, 'Ally', '0744798828', 'regional', NULL, 'DAR ES SALAAM', 'DODOMA', NULL, NULL, NULL, NULL, 'Humphrey', '0764589890', NULL, '10000', 50000, 'pochi', '2022-10-05 06:55:53', '2022-10-05', NULL, 'Dodoma', '7491', 'Small', 'created', NULL, NULL, NULL, '2022-10-05 06:55:53', '2022-10-05 06:55:53'),
('230577', '7491', NULL, 'Humphrey Kadonya', '0768132939', 'regional', NULL, 'DODOMA', 'DAR ES SALAAM', NULL, NULL, NULL, NULL, 'Ally kibela', '0744798828', NULL, '10000', 50000, 'Funguo', '2022-10-05 07:06:05', '2022-10-05', NULL, 'Makumbusho', '8744', 'Small', 'on the way', NULL, NULL, NULL, '2022-10-07 00:30:53', '2022-10-05 07:06:05'),
('2420749', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Jangwani Sea Breeze Resort, White Sands Road, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '0754279728', 'Customer Pays Full', '8000', 20000, 'Television', '2022-09-30 14:50:19', '2022-09-30', 'express', NULL, NULL, NULL, 'pending', NULL, NULL, NULL, '2022-09-30 14:50:19', '2022-09-30 14:50:19'),
('2574591', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Mbagala, Tanzania', NULL, NULL, NULL, NULL, NULL, '0766278330', 'Order Fully paid', '4500', 50000, 'Shoes', '2022-08-30 16:44:51', '2022-08-30', 'standard', NULL, NULL, NULL, 'created', NULL, NULL, NULL, '2022-08-30 16:44:52', '2022-08-30 16:44:52'),
('2637715', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Ubungo mawasiliano, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '0759123081', 'Customer Pays Full', '2500', 10000, 'Television set', '2022-09-13 10:19:38', '2022-09-13', 'standard', NULL, NULL, NULL, 'cancelled', NULL, NULL, NULL, '2022-09-13 10:19:38', '2022-09-13 10:19:38'),
('2651451', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Ununio beach, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '0754279625', 'Customer pays for order only', '5000', 20000, 'IPhone 12', '2022-08-30 16:53:24', '2022-08-30', 'standard', NULL, NULL, NULL, 'created', NULL, NULL, NULL, '2022-08-30 16:53:24', '2022-08-30 16:53:24'),
('281700', '8660', NULL, 'James', '0718550016', 'regional', NULL, 'KAHAMA', 'MWANZA', NULL, NULL, NULL, NULL, 'Adams', '0767615566', NULL, '10000', 10000, 'Simu', '2022-10-19 15:52:32', '2022-10-19', NULL, 'Uhuru street, Mwanza', '2589', 'Small', 'created', NULL, NULL, NULL, '2022-10-19 15:52:32', '2022-10-19 18:52:32'),
('2989984', '7491', NULL, 'Ally', '0744798828', 'regional', NULL, 'DODOMA', 'DAR ES SALAAM', NULL, NULL, NULL, NULL, 'Humphrey', '0763483004', NULL, '10000', 50000, 'maji', '2022-10-05 09:30:05', '2022-10-05', NULL, 'Makumbusho', '8744', 'Small', 'created', NULL, NULL, NULL, '2022-10-05 09:30:05', '2022-10-05 09:30:05'),
('3137137', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Hotel Slipway, Yacht Club Road, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '0754279729', 'Customer Pays Full', '4000', 10000, 'Take order from KFC to slip way hotel', '2022-08-29 16:51:10', '2022-08-29', 'express', NULL, NULL, NULL, 'created', NULL, NULL, NULL, '2022-08-29 16:51:10', '2022-08-29 16:51:10'),
('3265307', '8744', NULL, 'Juma jamal', '0768132939', 'regional', NULL, 'DAR ES SALAAM', 'ARUSHA', NULL, NULL, NULL, NULL, 'Hamed Abdalah', '0768132939', NULL, '10000', 70000, 'Bag', '2022-10-17 07:35:49', '2022-10-17', NULL, 'Kilombero', '8032', 'Small', 'cancelled', NULL, NULL, NULL, '2022-10-25 10:26:53', '2022-10-17 10:35:49'),
('3459467', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Mbagala, Tanzania', NULL, NULL, NULL, NULL, NULL, '0766278330', 'Customer Pays Full', '4500', 50000, 'Shoes', '2022-08-31 17:16:35', '2022-08-31', 'standard', NULL, NULL, NULL, 'cancelled', NULL, NULL, NULL, '2022-08-31 17:16:35', '2022-08-31 17:16:35'),
('3675908', '6938', NULL, 'Sabato Owigo', '0757164278', 'regional', NULL, 'Dar es salaam', 'Arusha', NULL, NULL, NULL, NULL, 'Ally Kishimba', '0744798828', NULL, '70000', 700000, 'Laptop Box', '2022-09-22 12:50:37', '2022-09-22', NULL, NULL, NULL, NULL, 'created', NULL, NULL, NULL, '2022-09-22 12:50:37', '2022-09-22 12:50:37'),
('3737111', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Tabata, Tanzania', NULL, NULL, NULL, NULL, NULL, '0766278330', 'Order Fully paid', '6500', 6000, 'Bag', '2022-08-31 17:17:43', '2022-08-31', 'express', NULL, NULL, NULL, 'incomplete', 2027927, 'sabato owigo', '0785610230', '2022-08-31 17:17:43', '2022-08-31 17:17:43'),
('3932597', '8744', NULL, 'Adams', '0786511683', 'regional', NULL, 'DAR ES SALAAM', 'DODOMA', NULL, NULL, NULL, NULL, 'Kennnedy', '0768132939', NULL, '10000', 100000, 'Nguo', '2022-10-07 08:16:56', '2022-10-07', NULL, 'Dodoma', '7491', 'Small', 'created', NULL, NULL, NULL, '2022-10-07 08:16:56', '2022-10-07 08:16:56'),
('3936215', '2589', NULL, 'Adams', '0767615566', 'regional', NULL, 'MWANZA', 'KAHAMA', NULL, NULL, NULL, NULL, 'James James', '0769888331', NULL, '10000', 10000, 'Clothes', '2022-10-19 14:32:53', '2022-10-19', NULL, 'CDT', '8660', 'Small', 'created', NULL, NULL, NULL, '2022-10-19 14:32:53', '2022-10-19 17:32:53'),
('4001533', '7782', NULL, 'Yusra', '0652216509', 'regional', NULL, 'DAR ES SALAAM', 'ARUSHA', NULL, NULL, NULL, NULL, 'Ally', '0744798828', NULL, '50000', 500000, 'Simu', '2022-10-26 09:08:41', '2022-10-26', NULL, 'Kilombero market', '8295', 'Medium', 'created', NULL, NULL, NULL, '2022-10-26 09:08:41', '2022-10-26 12:08:41'),
('4074756', '8744', NULL, 'Sabato Owigo', '0757164278', 'regional', NULL, 'DAR ES SALAAM', 'DODOMA', NULL, NULL, NULL, NULL, 'Senjaro', '0658123265', NULL, '10000', 100000, 'Test System', '2022-09-28 14:36:52', '2022-09-28', NULL, 'Dodoma', '7491', 'Small', 'delivered', NULL, NULL, NULL, '2022-10-05 10:11:57', '2022-09-28 14:36:52'),
('4083686', '8744', NULL, 'Hilton', '0768132939', 'regional', NULL, 'DAR ES SALAAM', 'DODOMA', NULL, NULL, NULL, NULL, 'James', '0768132939', NULL, '10000', 100000, 'Mbegu', '2022-09-29 08:07:28', '2022-09-29', NULL, 'Dodoma', '7491', 'Medium', 'collected', NULL, NULL, NULL, '2022-09-29 16:38:55', '2022-09-29 08:07:28'),
('4130674', '7782', NULL, 'yuyu', '0652216509', 'regional', NULL, 'DAR ES SALAAM', 'MWANZA', NULL, NULL, NULL, NULL, 'shah', '0684161661', NULL, '25000', 250000, 'nguo', '2022-10-26 09:22:19', '2022-10-26', NULL, 'Uhuru street, Mwanza', '2589', 'Medium', 'created', NULL, NULL, NULL, '2022-10-26 09:22:19', '2022-10-26 12:22:19'),
('4311291', '8041', NULL, NULL, NULL, 'domestic', 'motocycle', 'Dar Free Market Mall, Ali Hassan Mwinyi Road, Dar es Salaam, Tanzania', 'Magomeni Mikumi, Muhuto Street, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, 'razia', '0788206366', 'Order Fully Paid', '4000', 50000, 'dereva aende salita shop kuna ya kupeleka magomeni', '2022-08-26 14:44:25', '2022-08-26', 'express', NULL, NULL, NULL, 'complete', 2027927, 'sabato owigo', '0785610230', '2022-08-26 14:44:25', '2022-08-26 14:44:25'),
('4344917', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Kibaha, Tanzania', NULL, NULL, NULL, NULL, NULL, NULL, 'Order Fully paid', '6500', 10000, NULL, '2022-08-29 16:48:12', '2022-08-29', 'standard', NULL, NULL, NULL, 'cancelled', NULL, NULL, NULL, '2022-08-29 16:48:12', '2022-08-29 16:48:12'),
('4364247', '8744', NULL, 'Yekin', '0779528442', 'regional', NULL, 'DAR ES SALAAM', 'DODOMA', NULL, NULL, NULL, NULL, 'Ally', '0744798828', NULL, '10000', 50000, 'maji', '2022-10-10 10:14:07', '2022-10-10', NULL, 'Dodoma', '7491', 'Small', 'created', NULL, NULL, NULL, '2022-10-10 10:14:07', '2022-10-10 10:14:07'),
('4648837', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Kimara Temboni, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '0714138888', 'Customer Pays Full', '4500', 100000, 'example of detail', '2022-08-25 16:04:43', '2022-08-25', 'standard', NULL, NULL, NULL, 'complete', 2027927, 'sabato owigo', '0785610230', '2022-08-25 16:04:43', '2022-08-25 16:04:43'),
('4656099', '8744', NULL, 'Ally', '0744798828', 'regional', NULL, 'DAR ES SALAAM', 'DODOMA', NULL, NULL, NULL, NULL, 'Mbugi', '0689230212', NULL, '10000', 50000, 'Maji', '2022-09-29 15:33:15', '2022-09-29', NULL, 'Dodoma', '7491', 'Small', 'created', NULL, NULL, NULL, '2022-09-29 15:33:15', '2022-09-29 15:33:15'),
('4972057', '7491', NULL, 'ally', '0768132939', 'regional', NULL, 'DODOMA', 'DAR ES SALAAM', NULL, NULL, NULL, NULL, 'Kado', '0744798828', NULL, '10000', 10000, 'maji', '2022-10-06 21:40:07', '2022-10-06', NULL, 'Makumbusho', '8744', 'Small', 'at delivery center', NULL, NULL, NULL, '2022-10-07 00:44:01', '2022-10-06 21:40:07'),
('5361778', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Ubungo Plaza Limited, Morogoro Rd, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '759123081', 'Customer pays Delivery only', '7000', 100000, 'example of detail', '2022-08-26 16:07:16', '2022-08-26', 'express', NULL, NULL, NULL, 'incomplete', 2027927, 'sabato owigo', '0785610230', '2022-08-26 16:07:16', '2022-08-26 16:07:16'),
('5430871', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Africana Bus stop, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '0754279729', 'Customer pays for order only', '7500', 12000, 'Smart tv', '2022-08-30 10:29:45', '2022-08-30', 'express', NULL, NULL, NULL, 'created', NULL, NULL, NULL, '2022-08-30 10:29:45', '2022-08-30 10:29:45'),
('5593743', '8041', NULL, NULL, NULL, 'domestic', 'motocycle', 'Testimony Engllish Medium Primary School, Kileo, Tanzania', 'Test Food Restaurant, Zanzibar, Tanzania', '-6.182217999999999', '39.2209431', '-3.611994500000001', '37.6704495', NULL, '0757164278', 'Order Fully Paid', '230000', 76900, 'test redirect', '2022-09-15 12:45:05', '2022-09-15', 'express', NULL, NULL, NULL, 'created', NULL, NULL, NULL, '2022-09-15 12:45:05', '2022-09-15 12:45:05'),
('5716764', '8744', NULL, 'John chi', '0768132939', 'regional', NULL, 'DAR ES SALAAM', 'DODOMA', NULL, NULL, NULL, NULL, 'Ally jumanne', '0744798828', NULL, '10000', 50000, 'Simu', '2022-10-06 21:15:32', '2022-10-06', NULL, 'Dodoma', '7491', 'Small', 'delivered', NULL, NULL, NULL, '2022-10-07 00:33:07', '2022-10-06 21:15:32'),
('5717032', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Yombo Vituka, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '0714138888', 'Customer pays Delivery only', '3000', 20000, 'Laptop parts', '2022-09-01 10:40:39', '2022-09-01', 'standard', NULL, NULL, NULL, 'created', NULL, NULL, NULL, '2022-09-01 10:40:39', '2022-09-01 10:40:39'),
('586656', '8744', NULL, 'Samir', '0768371766', 'regional', NULL, 'DAR ES SALAAM', 'DODOMA', NULL, NULL, NULL, NULL, 'Humphrey', '0768132939', NULL, '80000', 800000, 'Simu', '2022-09-29 13:48:48', '2022-09-29', NULL, 'Dodoma', '7491', 'Medium', 'on the way', NULL, NULL, NULL, '2022-10-07 00:41:22', '2022-09-29 13:48:48'),
('6341681', '8295', NULL, 'Eliazer Mboye', '0752757635', 'regional', NULL, 'ARUSHA', 'DODOMA', NULL, NULL, NULL, NULL, 'Justine Ulomi', '0757588619', NULL, '10000', 5000, 'envelope', '2022-10-19 08:44:04', '2022-10-19', NULL, 'Nyerere square', '7286', 'Small', 'created', NULL, NULL, NULL, '2022-10-19 08:44:04', '2022-10-19 11:44:04'),
('6396787', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Africana Bus stop, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '759123081', 'Order Fully paid', '8000', 100000, 'example of detail', '2022-08-26 16:05:37', '2022-08-26', 'express', NULL, NULL, NULL, 'complete', 2027927, 'sabato owigo', '0785610230', '2022-08-26 16:05:37', '2022-08-26 16:05:37'),
('673918', '7286', NULL, 'Justine', '0757588619', 'regional', NULL, 'DODOMA', 'ARUSHA', NULL, NULL, NULL, NULL, 'Eliezer', '0752757635', NULL, '10000', 10000, 'Caps', '2022-10-20 07:41:48', '2022-10-20', NULL, 'Kilombero market', '8295', 'Small', 'created', NULL, NULL, NULL, '2022-10-20 07:41:48', '2022-10-20 10:41:48'),
('6988113', '8744', NULL, 'Ally', '0744798828', 'regional', NULL, 'DAR ES SALAAM', 'DODOMA', NULL, NULL, NULL, NULL, 'Ally', '0744798828', NULL, '10000', 50000, 'Maji', '2022-09-29 12:32:37', '2022-09-29', NULL, 'Dodoma', '7491', 'Small', 'at delivery center', NULL, NULL, NULL, '2022-09-29 16:46:46', '2022-09-29 12:32:37'),
('7306358', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, NULL, '759123081', 'Customer Pays Full', '1000', 100000, 'example of detail', '2022-08-29 15:58:15', '2022-08-29', 'standard', NULL, NULL, NULL, 'delivering', 2027927, 'sabato owigo', '0785610230', '2022-08-29 15:58:15', '2022-08-29 15:58:15'),
('7690103', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Buguruni Bridge, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '759123081', 'Customer pays for order only', '6500', 100000, 'example of detail', '2022-08-25 16:00:36', '2022-08-25', 'express', NULL, NULL, NULL, 'incomplete', 2027927, 'sabato owigo', '0785610230', '2022-08-25 16:00:36', '2022-08-25 16:00:36'),
('8544282', '8041', 9277960, 'Rodney', NULL, 'domestic', 'carry', 'French Embassy, Dar es Salaam, Tanzania', 'Basihaya Bus Stop, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '759123081', 'Customer Pays Full', '60000', 10000, 'example of detail', '2022-08-25 15:40:20', '2022-08-25', 'express', NULL, NULL, NULL, 'delivering', 2268719, 'LEVIS', '0684799420', '2022-08-25 15:40:20', '2022-08-25 15:40:20'),
('8912545', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Kigamboni, Tanzania', NULL, NULL, NULL, NULL, NULL, '0766278330', 'Order Fully paid', '9500', 50000, 'Tv', '2022-08-29 17:20:13', '2022-08-29', 'express', NULL, NULL, NULL, 'delivering', 2268719, 'LEVIS', '0684799420', '2022-08-29 17:20:13', '2022-08-29 17:20:13'),
('8944265', '8041', NULL, NULL, NULL, 'domestic', 'motocycle', 'Sinza makaburini, Dar es Salaam, Tanzania', 'Upanga Jamatkhana, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, 'razia', '0620586535', 'Customer Pay Full', '6500', 30000, 'dereva aende sinza atachukua oda ya nguo ataipeleka crdb ya upanga', '2022-08-26 15:08:39', '2022-08-26', 'express', NULL, NULL, NULL, 'complete', 2268719, 'LEVIS', '0684799420', '2022-08-26 15:08:39', '2022-08-26 15:08:39'),
('9467968', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Mwenge, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '759123081', 'Customer Pays Full', '5000', 100000, 'example of detail', '2022-08-29 14:17:53', '2022-08-29', 'express', NULL, NULL, NULL, 'incomplete', 2268719, 'LEVIS', '0684799420', '2022-08-29 14:17:53', '2022-08-29 14:17:53'),
('977304', '8041', 9277960, 'Rodney', NULL, 'domestic', 'motocycle', 'French Embassy, Dar es Salaam, Tanzania', 'Morocco Bus Stand, Morroco Road, Dar es Salaam, Tanzania', NULL, NULL, NULL, NULL, NULL, '759123081', 'Customer pays Delivery only', '1500', 100000, 'New order', '2022-08-29 12:29:23', '2022-08-29', 'standard', NULL, NULL, NULL, 'cancelled', NULL, NULL, NULL, '2022-08-29 12:29:23', '2022-08-29 12:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(30) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'jakowigo1@gmail.com', '$2y$10$1ED6frcO/CeYN0KD2mtGF.nXOTh4db.b3sAYr7f7lIdzSrikQvdqe', '2022-09-02 11:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(62, 'App\\Models\\User', 2027927, 'MyToken', 'a08c56e51f3a6ea7f1817a500c918e4a0e8d9681559928a18729f14c200371a5', '[\"*\"]', NULL, NULL, '2022-08-29 16:33:05', '2022-08-29 16:33:05'),
(93, 'App\\Models\\User', 9277960, 'MyToken', '54fddbb4ece522b42e413020593147ca369f6c65da7376c8f5a9160dcf76c31b', '[\"*\"]', NULL, NULL, '2022-09-13 11:23:49', '2022-09-13 11:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `centerid` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_location` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_lat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_long` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `centerid`, `vendor_location`, `vendor_lat`, `vendor_long`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1890, 'SENJARO CENTER', 'vaigo@gmail.com', NULL, 'center', '8041', NULL, NULL, NULL, NULL, '$2y$10$O.2YHLNh7rl8C9EgCo9v4.KZVTDTwxPkfKzGhr76ECJ9ZSinwNQc2', NULL, '2022-08-06 18:39:22', '2022-08-06 18:39:22'),
(1673116, 'Irene Alphonse', 'irenealphonce999@gmail.com', '0658383907', 'agent', '7387', NULL, NULL, NULL, NULL, '$2y$10$FW1.LSDCGNqqGREeeyknOu1BksyfJ.SZ8VtIS7mtqJUvmQ/PPv3Xe', NULL, NULL, NULL),
(1893703, 'Eliezer Mboye', 'eli.frembo@gmail.com', '0684709744', 'agent', '8295', NULL, NULL, NULL, NULL, '$2y$10$c4vivex2Vga6R/0W0OzYA.bEA3Tg9c.RTm2Ynd9rFkrofgqDo9Cxe', NULL, NULL, NULL),
(2027927, 'sabato owigo', NULL, '0785610230', 'driver', NULL, NULL, NULL, NULL, NULL, '$2y$10$0C89S97Xik1Jrq89QjIMb.lEJSrIbb6880BqWu/d09lYwMcQqVZqS', NULL, NULL, NULL),
(2124639, 'sabato owigo', 'agent2@gmail.com', '0757164278', 'agent', '7491', NULL, NULL, NULL, NULL, '$2y$10$m5HgdkZ2eW.nOaRPue4haun3h90.L8FMTZeOAHOmdYG3vGE4/VbGC', NULL, NULL, '2022-10-05 14:02:43'),
(2268719, 'LEVIS', NULL, '0684799420', 'driver', NULL, NULL, NULL, NULL, NULL, '$2y$10$nixqGz0S5aV9392BA4L1O.tXNH8kxy8FnEVRcpZYeGV2ET8bbwmW2', NULL, NULL, NULL),
(5265127, 'yusra jagna shah', 'yuyushah00@gmail.com', '0652216509', 'agent', '7782', NULL, NULL, NULL, NULL, '$2y$10$fcXto1rKCkyODFq5PekPGOwxDjyObVmEX9nYaYq.72lyzoVcSV0i6', NULL, NULL, NULL),
(5633083, 'James James', 'Js263020@gmail.com', '0718550016', 'agent', '8660', NULL, NULL, NULL, NULL, '$2y$10$gTUrzS33OCW6vJNdcu54g.MDXNaVWyganmoycBtpQ8nRElRXRNc1a', NULL, NULL, NULL),
(5694749, 'Adams Kennedy', 'akenny334@gmail.com', '0767615566', 'agent', '2589', NULL, NULL, NULL, NULL, '$2y$10$ySFDn7u0Qju5NX7ctehtK.aVDnV4Bg0ILZtkCbyMD4BLunNTayHui', NULL, NULL, NULL),
(6133056, 'SENJARO GROUP', 'senjaro@gmail.com', '0756435667', 'admin', NULL, NULL, NULL, NULL, NULL, '$2y$10$Q/wmwCr5uNrOBWy4xkSkxeecIDCpcHoO03lU8iLWAdxHlySXPzBYq', NULL, '2022-08-06 19:58:19', '2022-09-09 12:15:52'),
(7086485, 'Vaigo Agent', 'agent@gmail.com', '0658123265', 'agent', '8744', NULL, NULL, NULL, NULL, '$2y$10$Bf24DC/CmXFidwU/69uO/.Dt3WN0ThU24uie5Vc/ZOODX9OsHuqzS', NULL, NULL, '2022-09-20 22:27:07'),
(7350139, 'Ally Senjaro', 'jakowigo@gmail.com', '0757164277', 'agent', '5016', NULL, NULL, NULL, NULL, '$2y$10$UbImJBJLshZxelMGCJhI3O4a7Ipjljh5hR9p1.eEHBsWKXiiwymCm', NULL, NULL, NULL),
(7593869, 'Reuben', 'reuben06mbukani@gmail.com', '0788206366', 'depaturer', NULL, NULL, NULL, NULL, NULL, '$2y$10$30K6yh0FSbvY1YWUF5Fr1utl7EduqSYku1SIb3f/tnkO5gv2jnxCy', NULL, NULL, NULL),
(8440056, 'Ally Test', 'allycenter@gmail.com', '0744798828', 'center', '8041', NULL, NULL, NULL, NULL, '$2y$10$tRHhWTwiXftRh2C5vDbg8.enic17wpHg4oAOA65qpNxH3Be4epbc6', NULL, NULL, NULL),
(9277960, 'Rodney', NULL, '0759123081', 'vendor', '8041', 'French Embassy, Dar es Salaam, Tanzania', '-6.789229999999999', '39.27857379999999', NULL, '$2y$10$8VOdGkri8i47XKMmcYIevutfiCst5R0qbzbmIBj7sA0nRA7wZ67Cy', NULL, NULL, NULL),
(9421153, 'Justin Ulomi', 'ollomy17@gmail.com', '0757588619', 'agent', '7286', NULL, NULL, NULL, NULL, '$2y$10$wCTn7N40O4rT6l9wH9m97u2uu6GZbL8WfGyb.hsAe2.8ifNmImMvG', NULL, NULL, NULL),
(9788356, 'ally dispatch', 'allydispatch@gmail.com', '0768132939', 'depaturer', NULL, NULL, NULL, NULL, NULL, '$2y$10$kLk6Rn97X80ISU55HHoDLOZH4AEaldMBF7WveHmkg13XDZXqiJylC', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD UNIQUE KEY `centers_centerid_unique` (`centerid`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oders`
--
ALTER TABLE `oders`
  ADD PRIMARY KEY (`oderid`),
  ADD UNIQUE KEY `oders_oderid_unique` (`oderid`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9788357;
COMMIT;

