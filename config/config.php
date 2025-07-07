<?php
/**
 * Application Configuration
 * Centralized configuration management for better separation of concerns
 */

class Config {
    // Database Configuration
    const DB_HOST = 'localhost';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'cinema';
    
    // Application Configuration
    const APP_NAME = 'Cinema Booking Platform';
    const APP_VERSION = '1.0.0';
    const DEBUG_MODE = true;
    
    // API Configuration
    const API_BASE_URL = '/Backend/controller/';
    const CORS_ALLOWED_ORIGINS = ['http://localhost', 'http://127.0.0.1'];
    
    // Session Configuration
    const SESSION_LIFETIME = 3600; // 1 hour
    
    // File Upload Configuration
    const MAX_FILE_SIZE = 5242880; // 5MB
    const ALLOWED_IMAGE_TYPES = ['image/jpeg', 'image/png', 'image/gif'];
    const UPLOAD_PATH = '../uploads/';
    
    /**
     * Get database configuration as array
     */
    public static function getDatabaseConfig() {
        return [
            'host' => self::DB_HOST,
            'username' => self::DB_USERNAME,
            'password' => self::DB_PASSWORD,
            'database' => self::DB_NAME
        ];
    }
    
    /**
     * Check if debug mode is enabled
     */
    public static function isDebugMode() {
        return self::DEBUG_MODE;
    }
} 