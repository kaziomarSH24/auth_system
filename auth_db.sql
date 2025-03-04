-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 05:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auth_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_one_id` bigint(20) UNSIGNED NOT NULL,
  `user_two_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user_one_id`, `user_two_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2025-01-20 11:20:46', '2025-01-20 11:20:46'),
(2, 1, 3, '2025-01-21 09:47:19', '2025-01-21 09:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'a3158e75-660b-4a7e-a7d0-902ece2852dc', 'redis', 'default', '{\"uuid\":\"a3158e75-660b-4a7e-a7d0-902ece2852dc\",\"displayName\":\"App\\\\Events\\\\UserRegistered\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:25:\\\"App\\\\Events\\\\UserRegistered\\\":2:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:13:\\\"formattedTime\\\";s:8:\\\"12:50 PM\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"},\"id\":\"4RwROKu1zQV77QCDrbtjwAZJh5sijw7H\",\"attempts\":0}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\User]. in C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:621\nStack trace:\n#0 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(109): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(62): App\\Events\\UserRegistered->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(93): App\\Events\\UserRegistered->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Events\\UserRegistered->__unserialize(Array)\n#4 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:38:\"Illuminat...\')\n#5 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\RedisJob), Array)\n#7 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'redis\', Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(333): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\RedisJob), \'redis\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->runNextJob(\'redis\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'redis\', \'default\')\n#12 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#18 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(1096): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(175): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 C:\\xampp\\htdocs\\auth_system\\auth_system\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 {main}', '2025-02-16 11:18:33'),
(2, '34fc70c6-8df4-4f98-8783-afa76cb4ba9d', 'redis', 'default', '{\"uuid\":\"34fc70c6-8df4-4f98-8783-afa76cb4ba9d\",\"displayName\":\"App\\\\Events\\\\UserRegistered\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:25:\\\"App\\\\Events\\\\UserRegistered\\\":2:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:13:\\\"formattedTime\\\";s:8:\\\"12:52 PM\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"},\"id\":\"4PWG7U5bAn5bD0AKFIKmLoV7bAkAX6yV\",\"attempts\":0}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\User]. in C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:621\nStack trace:\n#0 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(109): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(62): App\\Events\\UserRegistered->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(93): App\\Events\\UserRegistered->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Events\\UserRegistered->__unserialize(Array)\n#4 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:38:\"Illuminat...\')\n#5 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\RedisJob), Array)\n#7 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'redis\', Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(333): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\RedisJob), \'redis\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->runNextJob(\'redis\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'redis\', \'default\')\n#12 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#18 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(1096): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(175): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 C:\\xampp\\htdocs\\auth_system\\auth_system\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 {main}', '2025-02-16 11:18:33'),
(3, '954ca6e9-02e3-4c2b-b549-6a823a08b106', 'redis', 'default', '{\"uuid\":\"954ca6e9-02e3-4c2b-b549-6a823a08b106\",\"displayName\":\"App\\\\Events\\\\UserRegistered\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:25:\\\"App\\\\Events\\\\UserRegistered\\\":2:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:13:\\\"formattedTime\\\";s:8:\\\"05:04 PM\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"},\"id\":\"0ReFrjdx1MGMZOKjmfLp8re6RRe4tXTV\",\"attempts\":0}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\User]. in C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:621\nStack trace:\n#0 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(109): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(62): App\\Events\\UserRegistered->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(93): App\\Events\\UserRegistered->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Events\\UserRegistered->__unserialize(Array)\n#4 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:38:\"Illuminat...\')\n#5 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\RedisJob), Array)\n#7 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'redis\', Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(333): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\RedisJob), \'redis\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->runNextJob(\'redis\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'redis\', \'default\')\n#12 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#18 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(1096): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(175): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 C:\\xampp\\htdocs\\auth_system\\auth_system\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 {main}', '2025-02-16 11:18:38'),
(4, '3fe8bf93-c76b-48c5-aa15-9ba9e8fc3e27', 'redis', 'default', '{\"uuid\":\"3fe8bf93-c76b-48c5-aa15-9ba9e8fc3e27\",\"displayName\":\"App\\\\Events\\\\UserRegistered\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:25:\\\"App\\\\Events\\\\UserRegistered\\\":2:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:13:\\\"formattedTime\\\";s:8:\\\"05:05 PM\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"},\"id\":\"PQ9KXrRjoqjpbv1LPGxs03npH3sfFWfw\",\"attempts\":0}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\User]. in C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:621\nStack trace:\n#0 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(109): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(62): App\\Events\\UserRegistered->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(93): App\\Events\\UserRegistered->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Events\\UserRegistered->__unserialize(Array)\n#4 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:38:\"Illuminat...\')\n#5 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\RedisJob), Array)\n#7 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'redis\', Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(333): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\RedisJob), \'redis\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->runNextJob(\'redis\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'redis\', \'default\')\n#12 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#18 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(1096): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(175): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 C:\\xampp\\htdocs\\auth_system\\auth_system\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 {main}', '2025-02-16 11:18:38'),
(5, '0cb79d12-d2b7-41b2-ad9c-96c3bbc2a90f', 'redis', 'default', '{\"uuid\":\"0cb79d12-d2b7-41b2-ad9c-96c3bbc2a90f\",\"displayName\":\"App\\\\Events\\\\UserRegistered\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:25:\\\"App\\\\Events\\\\UserRegistered\\\":2:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:13:\\\"formattedTime\\\";s:8:\\\"05:09 PM\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"},\"id\":\"uvKEPxsuP3u6Dsx9jbD1YX79nxdI1V0C\",\"attempts\":0}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\User]. in C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:621\nStack trace:\n#0 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(109): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(62): App\\Events\\UserRegistered->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(93): App\\Events\\UserRegistered->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Events\\UserRegistered->__unserialize(Array)\n#4 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:38:\"Illuminat...\')\n#5 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\RedisJob), Array)\n#7 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'redis\', Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(333): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\RedisJob), \'redis\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->runNextJob(\'redis\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'redis\', \'default\')\n#12 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#18 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(1096): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\symfony\\console\\Application.php(175): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 C:\\xampp\\htdocs\\auth_system\\auth_system\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 C:\\xampp\\htdocs\\auth_system\\auth_system\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 {main}', '2025-02-16 11:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `media` text DEFAULT NULL,
  `media_type` enum('text','image','video','audio') NOT NULL DEFAULT 'text',
  `status` enum('sent','delivered','read') NOT NULL DEFAULT 'sent',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `receiver_id`, `message`, `media`, `media_type`, `status`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Hey There', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-20 11:21:31', '2025-02-24 05:39:54'),
(2, 1, 2, 1, 'hello', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-20 12:11:36', '2025-02-24 07:34:42'),
(3, 1, 2, 1, 'sdfsdfsdfsd', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-20 12:48:32', '2025-02-24 07:34:42'),
(4, 1, 2, 1, 'sfsfsdfdsfds', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-20 12:58:21', '2025-02-24 07:34:42'),
(5, 1, 2, 1, 'qqqqqqq', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-20 12:58:31', '2025-02-24 07:34:42'),
(6, 1, 2, 1, 'sfdsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-20 12:59:07', '2025-02-24 07:34:42'),
(7, 1, 2, 1, 'rt', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-20 13:01:00', '2025-02-24 07:34:42'),
(8, 1, 2, 1, 'sdfsdf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-20 13:03:28', '2025-02-24 07:34:42'),
(9, 1, 2, 1, 'sdfsdfs', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-20 13:07:15', '2025-02-24 07:34:42'),
(10, 1, 2, 1, 'sfsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-20 13:07:46', '2025-02-24 07:34:42'),
(11, 1, 2, 1, 'fsdf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-20 13:08:31', '2025-02-24 07:34:42'),
(12, 1, 2, 1, 'sfsdfdsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-20 13:09:19', '2025-02-24 07:34:42'),
(13, 1, 2, 1, 'sfsdf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-20 13:09:38', '2025-02-24 07:34:42'),
(14, 1, 1, 2, 'hi', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 03:40:10', '2025-02-24 05:39:54'),
(15, 1, 2, 1, 'fgd', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 03:40:14', '2025-02-24 07:34:42'),
(16, 1, 2, 1, 'dsfdsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 04:01:50', '2025-02-24 07:34:42'),
(17, 1, 2, 1, 'hi how are y ou', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 04:07:24', '2025-02-24 07:34:42'),
(18, 1, 2, 1, 'hey omar', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 04:08:40', '2025-02-24 07:34:42'),
(19, 1, 1, 2, 'hi', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 04:09:47', '2025-02-24 05:39:54'),
(20, 1, 1, 2, 'hey', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 04:13:26', '2025-02-24 05:39:54'),
(21, 1, 1, 2, 'ljkljk', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 04:21:34', '2025-02-24 05:39:54'),
(22, 1, 2, 1, 'lkjl', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 04:21:51', '2025-02-24 07:34:42'),
(23, 1, 1, 2, 'tt', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 04:22:05', '2025-02-24 05:39:54'),
(24, 1, 2, 1, 'tyhty', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 04:22:10', '2025-02-24 07:34:42'),
(25, 1, 2, 1, 'gdfg', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 04:31:42', '2025-02-24 07:34:42'),
(26, 1, 2, 1, 'hi how are y ou', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 04:41:26', '2025-02-24 07:34:42'),
(27, 1, 2, 1, 'fdsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 04:43:40', '2025-02-24 07:34:42'),
(28, 1, 2, 1, 'fdsfds', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 04:45:26', '2025-02-24 07:34:42'),
(29, 1, 2, 1, 'dfgd', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 04:51:30', '2025-02-24 07:34:42'),
(30, 1, 1, 2, 'fdsf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 04:54:10', '2025-02-24 05:39:54'),
(31, 1, 1, 2, 'sfsfs', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 04:54:42', '2025-02-24 05:39:54'),
(32, 1, 2, 1, 'fsfsfvvvv', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 04:54:57', '2025-02-24 07:34:42'),
(33, 1, 2, 1, 'hi how are y ou', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 04:55:29', '2025-02-24 07:34:42'),
(34, 1, 1, 2, 'bvnn', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 04:55:35', '2025-02-24 05:39:54'),
(35, 1, 2, 1, 'dfsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 05:09:57', '2025-02-24 07:34:42'),
(36, 1, 1, 2, 'sdfsf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 05:16:28', '2025-02-24 05:39:54'),
(37, 1, 2, 1, 'sfdsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 05:43:05', '2025-02-24 07:34:42'),
(38, 1, 1, 2, 'sdfsfsf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 05:43:12', '2025-02-24 05:39:54'),
(39, 1, 1, 2, 'cccc', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 05:43:18', '2025-02-24 05:39:54'),
(40, 1, 1, 2, 'vvvvv', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 05:43:26', '2025-02-24 05:39:54'),
(41, 1, 1, 2, 'qqqqqqqqq', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 05:43:46', '2025-02-24 05:39:54'),
(42, 1, 2, 1, 'hfghf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 05:43:57', '2025-02-24 07:34:42'),
(43, 1, 2, 1, 'fdsfds', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 05:44:45', '2025-02-24 07:34:42'),
(44, 1, 2, 1, 'fdsfsdf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 05:44:51', '2025-02-24 07:34:42'),
(45, 1, 1, 2, 'dsfsf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 05:45:03', '2025-02-24 05:39:54'),
(46, 1, 1, 2, 'ljkp;p;', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 05:46:45', '2025-02-24 05:39:54'),
(47, 1, 1, 2, 'fsdfdsf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 06:32:27', '2025-02-24 05:39:54'),
(48, 1, 2, 1, 'fdsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 06:32:45', '2025-02-24 07:34:42'),
(49, 1, 2, 1, 'fdsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 06:33:53', '2025-02-24 07:34:42'),
(50, 1, 1, 2, 'dsfsf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 06:33:59', '2025-02-24 05:39:54'),
(51, 1, 2, 1, 'rrrrrr', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 06:34:11', '2025-02-24 07:34:42'),
(52, 1, 1, 2, 'rrrrr', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 06:34:17', '2025-02-24 05:39:54'),
(53, 1, 1, 2, 'wwwwwwwwwww', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 06:34:39', '2025-02-24 05:39:54'),
(54, 1, 2, 1, 'gggggggggggggg', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 06:34:46', '2025-02-24 07:34:42'),
(55, 1, 1, 2, 'vvvvvvvvvv', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 06:35:01', '2025-02-24 05:39:54'),
(56, 1, 2, 1, 'vvvvvvvvv', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 06:35:07', '2025-02-24 07:34:42'),
(57, 1, 1, 2, 'vvvvvvvvv', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 06:35:12', '2025-02-24 05:39:54'),
(58, 1, 2, 1, 'vvvvvvvvv', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 06:35:15', '2025-02-24 07:34:42'),
(59, 1, 2, 1, 'dfdddf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 06:36:20', '2025-02-24 07:34:42'),
(60, 1, 1, 2, 'dfd', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 06:36:23', '2025-02-24 05:39:54'),
(61, 1, 1, 2, 'sdfsdfs', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 06:42:16', '2025-02-24 05:39:54'),
(62, 1, 2, 1, 'gfdg', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 06:48:04', '2025-02-24 07:34:42'),
(63, 1, 1, 2, 'sda', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:02:25', '2025-02-24 05:39:54'),
(64, 1, 1, 2, 'sadaddadadsadsadasdasdsadsadsadasdasdasdasdasdadasdasdasdsadasdasdasdasdsadsadasdasdasdsa', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:02:36', '2025-02-24 05:39:54'),
(65, 1, 1, 2, 'fdsf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:02:53', '2025-02-24 05:39:54'),
(66, 1, 1, 2, 'fdsfeee', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:07:12', '2025-02-24 05:39:54'),
(67, 1, 2, 1, 'fdsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 09:07:20', '2025-02-24 07:34:42'),
(68, 1, 1, 2, 'sdfsf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:08:56', '2025-02-24 05:39:54'),
(69, 1, 1, 2, 'sfdsf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:11:57', '2025-02-24 05:39:54'),
(70, 1, 1, 2, 'dfdsfsd', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:12:35', '2025-02-24 05:39:54'),
(71, 1, 2, 1, 'fdsfs', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 09:14:40', '2025-02-24 07:34:42'),
(72, 1, 1, 2, 'dsfdsfs', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:14:46', '2025-02-24 05:39:54'),
(73, 1, 1, 2, 'vv', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:18:56', '2025-02-24 05:39:54'),
(74, 1, 1, 2, 'sds', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:19:42', '2025-02-24 05:39:54'),
(75, 1, 1, 2, 'sds', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:19:50', '2025-02-24 05:39:54'),
(76, 1, 1, 2, 'fdsf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:20:26', '2025-02-24 05:39:54'),
(77, 1, 1, 2, 'dgfdg', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:21:18', '2025-02-24 05:39:54'),
(78, 1, 1, 2, 'sfsdfs', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:24:05', '2025-02-24 05:39:54'),
(79, 1, 1, 2, 'mn', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:27:06', '2025-02-24 05:39:54'),
(80, 1, 1, 2, 'dsfsfdfsf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:28:32', '2025-02-24 05:39:54'),
(81, 1, 1, 2, 'sfsdf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:28:40', '2025-02-24 05:39:54'),
(82, 1, 1, 2, 'sfdsf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:28:44', '2025-02-24 05:39:54'),
(83, 1, 1, 2, 'cvcvc', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:28:47', '2025-02-24 05:39:54'),
(84, 1, 1, 2, 'bvbv', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:28:51', '2025-02-24 05:39:54'),
(85, 1, 1, 2, 'ccccc', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:28:55', '2025-02-24 05:39:54'),
(86, 1, 2, 1, 'cvbv', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 09:29:00', '2025-02-24 07:34:42'),
(87, 1, 1, 2, 'jghj', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:39:48', '2025-02-24 05:39:54'),
(88, 1, 1, 2, 'fsdfsdf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:41:55', '2025-02-24 05:39:54'),
(89, 1, 1, 2, 'dfgdgd', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:42:00', '2025-02-24 05:39:54'),
(90, 2, 1, 3, 'gagsdgsd', NULL, 'text', 'read', '2025-01-23 05:28:41', '2025-01-21 09:50:59', '2025-01-23 05:28:41'),
(91, 2, 3, 1, 'sdfdsf', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-21 09:52:39', '2025-02-24 07:34:32'),
(92, 2, 3, 1, 'sdfsfsfsdfsf', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-21 09:52:51', '2025-02-24 07:34:32'),
(93, 2, 3, 1, 'sfdsfsdfsfsfsf', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-21 09:53:05', '2025-02-24 07:34:32'),
(94, 2, 1, 3, 'sfsdfs', NULL, 'text', 'read', '2025-01-23 05:28:41', '2025-01-21 09:56:25', '2025-01-23 05:28:41'),
(95, 2, 1, 3, 'sdfsf', NULL, 'text', 'read', '2025-01-23 05:28:41', '2025-01-21 09:56:32', '2025-01-23 05:28:41'),
(96, 1, 2, 1, 'dsfsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 09:56:36', '2025-02-24 07:34:42'),
(97, 1, 2, 1, 'sfdsfsfddddddddddddddddd', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 09:56:48', '2025-02-24 07:34:42'),
(98, 2, 3, 1, 'vsvgcxv', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-21 09:56:56', '2025-02-24 07:34:32'),
(99, 1, 1, 2, 'gjghhjgj', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:59:09', '2025-02-24 05:39:54'),
(100, 1, 1, 2, 'gjhgjg', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:59:13', '2025-02-24 05:39:54'),
(101, 1, 1, 2, 'ghjg', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:59:16', '2025-02-24 05:39:54'),
(102, 1, 1, 2, 'gjhg', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 09:59:18', '2025-02-24 05:39:54'),
(103, 1, 2, 1, ';lk;k;;', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 10:14:28', '2025-02-24 07:34:42'),
(104, 1, 1, 2, 'sdfsdf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 10:16:07', '2025-02-24 05:39:54'),
(105, 2, 1, 3, 'sdfsf', NULL, 'text', 'read', '2025-01-23 05:28:41', '2025-01-21 10:16:15', '2025-01-23 05:28:41'),
(106, 1, 1, 2, 'qqqqqqqqqqqqqq', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 10:16:28', '2025-02-24 05:39:54'),
(107, 2, 1, 3, 'ffffffffffffffffffff', NULL, 'text', 'read', '2025-01-23 05:28:41', '2025-01-21 10:16:38', '2025-01-23 05:28:41'),
(108, 1, 2, 1, 'sdfdsfdsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 10:16:47', '2025-02-24 07:34:42'),
(109, 1, 2, 1, 'sfddsfsfs', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 10:16:59', '2025-02-24 07:34:42'),
(110, 1, 1, 2, 'dgdgf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 10:27:05', '2025-02-24 05:39:54'),
(111, 1, 2, 1, 'fgdgdg', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 10:27:14', '2025-02-24 07:34:42'),
(112, 1, 2, 1, 'bbbb', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 10:27:28', '2025-02-24 07:34:42'),
(113, 1, 1, 2, 'sfdsfsfccccc', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 10:28:07', '2025-02-24 05:39:54'),
(114, 1, 2, 1, 'rrrrrrrrrrrrr', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 10:28:53', '2025-02-24 07:34:42'),
(115, 1, 1, 2, 'vvvvvvvvvvvvv', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-21 10:29:01', '2025-02-24 05:39:54'),
(116, 2, 1, 3, 'vvvvvvvvvvvv', NULL, 'text', 'read', '2025-01-23 05:28:41', '2025-01-21 10:29:13', '2025-01-23 05:28:41'),
(117, 2, 3, 1, 'ddddddddddd', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-21 10:29:23', '2025-02-24 07:34:32'),
(118, 2, 3, 1, 'eeeeew', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-21 10:29:37', '2025-02-24 07:34:32'),
(119, 2, 1, 3, 'fdsfds', NULL, 'text', 'read', '2025-01-23 05:28:41', '2025-01-21 10:35:35', '2025-01-23 05:28:41'),
(120, 1, 2, 1, 'dsfsdf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 10:55:18', '2025-02-24 07:34:42'),
(121, 1, 2, 1, 'fdsf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 10:56:51', '2025-02-24 07:34:42'),
(122, 1, 2, 1, 'wwww', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 10:57:01', '2025-02-24 07:34:42'),
(123, 1, 2, 1, 'vnvbn', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 11:43:12', '2025-02-24 07:34:42'),
(124, 1, 2, 1, 'vbnvnbvnv', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-01-21 11:43:18', '2025-02-24 07:34:42'),
(125, 2, 3, 1, 'dsfgsdfgsd', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:19:56', '2025-02-24 07:34:32'),
(126, 2, 3, 1, 'sfsf', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:25:19', '2025-02-24 07:34:32'),
(127, 2, 3, 1, 'sfsdf', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:25:21', '2025-02-24 07:34:32'),
(128, 2, 3, 1, 'fsdfdsfsdfsfvvvvvvv', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:26:20', '2025-02-24 07:34:32'),
(129, 2, 3, 1, 'fsdfdsf', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:28:51', '2025-02-24 07:34:32'),
(130, 2, 3, 1, 'cccccvv', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:28:54', '2025-02-24 07:34:32'),
(131, 2, 3, 1, 'zzzx', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:28:57', '2025-02-24 07:34:32'),
(132, 2, 3, 1, 'sfsdfsdf', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:32:01', '2025-02-24 07:34:32'),
(133, 2, 3, 1, 'sdfsfs', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:32:04', '2025-02-24 07:34:32'),
(134, 2, 3, 1, 'dcvcdvx', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:36:22', '2025-02-24 07:34:32'),
(135, 2, 3, 1, 'dgdfg', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:36:30', '2025-02-24 07:34:32'),
(136, 2, 3, 1, 'dgfdgd', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:38:04', '2025-02-24 07:34:32'),
(137, 2, 1, 3, 'jfgjgfj', NULL, 'text', 'read', '2025-01-23 05:28:41', '2025-01-22 05:43:48', '2025-01-23 05:28:41'),
(138, 2, 3, 1, 'hi', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 05:44:06', '2025-02-24 07:34:32'),
(139, 2, 3, 1, 'sfsfsd', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 06:45:50', '2025-02-24 07:34:32'),
(140, 2, 3, 1, 'sdfsdf', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 06:45:59', '2025-02-24 07:34:32'),
(141, 2, 3, 1, 'sdfsfsfs', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 06:46:05', '2025-02-24 07:34:32'),
(142, 2, 3, 1, 'sfsdf', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 06:54:38', '2025-02-24 07:34:32'),
(143, 2, 3, 1, 'dfsfs', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 06:54:42', '2025-02-24 07:34:32'),
(144, 2, 3, 1, 'sfsdfs', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 06:54:46', '2025-02-24 07:34:32'),
(145, 1, 1, 2, '...m', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-22 11:24:23', '2025-02-24 05:39:54'),
(146, 2, 1, 3, 'sfsdf', NULL, 'text', 'read', '2025-01-23 05:28:41', '2025-01-22 11:26:11', '2025-01-23 05:28:41'),
(147, 2, 3, 1, 'fcccccvv', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 11:26:21', '2025-02-24 07:34:32'),
(148, 2, 3, 1, 'sfsfsf', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 11:26:38', '2025-02-24 07:34:32'),
(149, 2, 3, 1, 'cxvcxvcxv', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 11:26:44', '2025-02-24 07:34:32'),
(150, 2, 3, 1, 'fsdfdsf', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 11:30:04', '2025-02-24 07:34:32'),
(151, 2, 1, 3, 'fsdfdsf', NULL, 'text', 'read', '2025-01-23 05:28:41', '2025-01-22 11:30:21', '2025-01-23 05:28:41'),
(152, 2, 3, 1, 'hkhjkj', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 11:31:47', '2025-02-24 07:34:32'),
(153, 2, 3, 1, 'fhfghfghgfh', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-22 11:31:53', '2025-02-24 07:34:32'),
(154, 2, 1, 3, 'hfghfghfg', NULL, 'text', 'read', '2025-01-23 05:28:41', '2025-01-22 11:31:56', '2025-01-23 05:28:41'),
(155, 1, 1, 2, 'sdfsdf', NULL, 'text', 'read', '2025-02-24 05:39:54', '2025-01-23 04:20:32', '2025-02-24 05:39:54'),
(156, 2, 3, 1, 'rtetret', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-23 04:26:31', '2025-02-24 07:34:32'),
(157, 2, 3, 1, 'jkjkjkl', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-23 04:40:32', '2025-02-24 07:34:32'),
(158, 2, 3, 1, 'fsdfds', NULL, 'text', 'read', '2025-02-24 07:34:32', '2025-01-23 04:44:44', '2025-02-24 07:34:32'),
(159, 1, 2, 1, 'hi', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-02-24 05:40:04', '2025-02-24 07:34:42'),
(160, 1, 1, 2, 'hello', NULL, 'text', 'sent', NULL, '2025-02-24 05:41:14', '2025-02-24 05:41:14'),
(161, 1, 2, 1, 'hi', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-02-24 05:41:21', '2025-02-24 07:34:42'),
(162, 1, 2, 1, 'hello', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-02-24 05:42:25', '2025-02-24 07:34:42'),
(163, 1, 2, 1, 'ami tahsan', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-02-24 05:43:07', '2025-02-24 07:34:42'),
(164, 1, 1, 2, 'ami omart', NULL, 'text', 'sent', NULL, '2025-02-24 05:43:15', '2025-02-24 05:43:15'),
(165, 1, 1, 2, 'hi', NULL, 'text', 'sent', NULL, '2025-02-24 05:43:46', '2025-02-24 05:43:46'),
(166, 1, 1, 2, 'hi', NULL, 'text', 'sent', NULL, '2025-02-24 05:44:05', '2025-02-24 05:44:05'),
(167, 1, 2, 1, 'sdfh', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-02-24 05:45:44', '2025-02-24 07:34:42'),
(168, 1, 2, 1, 'sdfasf', NULL, 'text', 'read', '2025-02-24 07:34:42', '2025-02-24 05:45:48', '2025-02-24 07:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_04_142224_add_verification_fields_to_users_table', 1),
(6, '2024_10_05_020436_create_items_table', 1),
(7, '2024_11_14_091042_create_conversations_table', 1),
(8, '2024_11_14_091211_create_messages_table', 1),
(9, '2024_11_16_144122_create_jobs_table', 1),
(10, '2025_01_21_094238_add_is_active_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `verification_expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `is_active`, `email_verified_at`, `created_at`, `updated_at`, `verification_token`, `verification_expires_at`) VALUES
(1, 'Kazi Omar', 'kaziomar.bdcalling@gmail.com', '$2y$12$AOf4XVmVIIhVcKQ4g8LPsud/kSL9uvfAH3SSad4kXawlyuRS/dfhy', 'user', 0, '2025-01-20 11:15:01', '2025-01-20 11:12:40', '2025-02-24 12:00:35', NULL, NULL),
(2, 'Tahsan', 'kaziomar002@yopmail.com', '$2y$12$4f7e/rKuJpBxDmeqY9dASeeDO5YMWLj52T0hioS/4V7YHo7FwzKz.', 'user', 1, '2025-01-20 11:16:36', '2025-01-20 11:16:04', '2025-02-24 05:39:52', NULL, NULL),
(3, 'Rafi', 'kaziomar001@yopmail.com', '$2y$12$9vxZ4IRoRf//PUT0qlqOEu0.A4gtZL2agJREbObhzAmjpodeMBs62', 'user', 0, '2025-01-21 09:46:56', '2025-01-21 09:45:01', '2025-01-25 03:13:54', NULL, NULL),
(7, 'sdfsdf', 'aaa@yopmail.com', '$2y$12$hp8eVvYCl3qeE/J/dAPWIeCR5PmvLr79Nq7RbnrgcKD/QqsEFB4g.', 'user', 0, NULL, '2025-02-16 11:16:13', '2025-02-16 11:16:13', NULL, NULL),
(8, 'sfdsf', 'sfsdf@gmail.com', '$2y$12$g0lNOHKjEcjV4MqB9XBNQO718cRDPgJ.7TplUi1T/.UpFmBQ90LGO', 'user', 0, NULL, '2025-02-16 11:19:46', '2025-02-16 11:19:46', NULL, NULL),
(9, 'Kaziomar', 'kaziomar@gmail.com', '$2y$12$EtEDl8K9LXsnDgoWqwR/euV01ZGt0qwEoUfjSBSmyskP3vTqEGJKe', 'user', 0, NULL, '2025-02-16 11:21:29', '2025-02-16 11:21:29', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversations_user_one_id_foreign` (`user_one_id`),
  ADD KEY `conversations_user_two_id_foreign` (`user_two_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_conversation_id_foreign` (`conversation_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_user_one_id_foreign` FOREIGN KEY (`user_one_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversations_user_two_id_foreign` FOREIGN KEY (`user_two_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
