<?php

namespace App\Service;

class AuthService
{
    private const USERS_STORAGE_KEY = 'users';
    private const SESSION_KEY = 'ticketapp_session';
    private const CURRENT_USER_KEY = 'currentUser';
    private const USERS_FILE = __DIR__ . '/../../var/data/users.json';

    /**
     * Ensure the users file and directory exist
     */
    private static function ensureStorage(): void
    {
        $dataDir = dirname(self::USERS_FILE);
        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0777, true);
        }

        if (!file_exists(self::USERS_FILE)) {
            file_put_contents(self::USERS_FILE, '[]');
        }
    }

    /**
     * Find a user by email
     */
    public static function findUser(string $email): ?array
    {
        $users = self::getAllUsers();
        foreach ($users as $user) {
            if (isset($user['email']) && $user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }

    /**
     * Get all registered users
     */
    public static function getAllUsers(): array
    {
        self::ensureStorage();

        $usersJson = file_get_contents(self::USERS_FILE);
        return json_decode($usersJson, true) ?: [];
    }

    /**
     * Save users to storage
     */
    public static function saveUsers(array $users): void
    {
        self::ensureStorage();

        file_put_contents(self::USERS_FILE, json_encode($users, JSON_PRETTY_PRINT));
    }

    /**
     * Register a new user
     */
    public static function registerUser(array $user): void
{
    $filePath = __DIR__ . '/../../var/data/users.json';
    if (!file_exists(dirname($filePath))) {
        mkdir(dirname($filePath), 0777, true);
    }

    $users = self::getAllUsers();
    $users[] = $user;
    file_put_contents($filePath, json_encode($users, JSON_PRETTY_PRINT));
}

    /**
     * Authenticate user credentials
     */
    public static function authenticate(string $email, string $password): ?array
    {
        $user = self::findUser($email);
        if ($user && isset($user['password']) && $user['password'] === $password) {
            return $user;
        }
        return null;
    }

    /**
     * Create a new session for the user
     */
    public static function createSession(array $user): void
    {
        unset($user['password']); // remove sensitive data
        $_SESSION[self::SESSION_KEY] = session_id();
        $_SESSION[self::CURRENT_USER_KEY] = $user;
    }

    /**
     * Check if user is authenticated
     */
    public static function isAuthenticated(): bool
    {
        return isset($_SESSION[self::SESSION_KEY]) && isset($_SESSION[self::CURRENT_USER_KEY]);
    }

    /**
     * Get current authenticated user
     */
    public static function getCurrentUser(): ?array
    {
        return $_SESSION[self::CURRENT_USER_KEY] ?? null;
    }

    /**
     * Clear current session
     */
    public static function clearSession(): void
    {
        unset($_SESSION[self::SESSION_KEY]);
        unset($_SESSION[self::CURRENT_USER_KEY]);
        session_destroy();
    }

    /**
     * Create a test user if no users exist
     */
    public static function initializeTestUser(): void
    {
        $users = self::getAllUsers();
        if (empty($users)) {
            $testUser = [
                'id' => 1,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'test123',
                'createdAt' => date('c'),
            ];
            self::registerUser($testUser);
        }
    }
}