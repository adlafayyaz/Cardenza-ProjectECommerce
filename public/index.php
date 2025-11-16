<?php
/**
 * CodeIgniter Front Controller.
 *
 * Memindahkan file index.php ke folder public adalah praktek umum
 * untuk menutup akses langsung ke file system dan application.
 * File ini mengatur path ke sistem dan aplikasi, kemudian menjalankan CodeIgniter.
 */

// Tentukan environment aplikasi (development/production)
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

/*
 *---------------------------------------------------------------
 *  System and Application Paths
 *---------------------------------------------------------------
 */
// Lokasi folder system
$system_path = realpath(__DIR__.'/../system');
// Lokasi folder application
$application_folder = realpath(__DIR__.'/../application');

// Validasi path system
if ($system_path === false) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    exit('Your system folder path does not appear to be set correctly.');
}

// Definisikan konstanta yang dibutuhkan
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', $system_path.DIRECTORY_SEPARATOR);
define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);
define('FCPATH', __DIR__.DIRECTORY_SEPARATOR);
define('SYSDIR', basename(BASEPATH));

// Jalankan CodeIgniter
require_once BASEPATH.'core/CodeIgniter.php';
