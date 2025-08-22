<?php
// 代码生成时间: 2025-08-22 10:43:11
use Cake\Core\Configure;
use Cake\Network\Exception\BadRequestException;
use Cake\ORM\TableRegistry;
use Cake\Utility\CookieCryptTrait;

class ThemeSwitcher {
    use CookieCryptTrait;

    private $themes = ['light', 'dark', 'colorful']; // List of available themes
    private $cookieName = 'theme'; // Name of the cookie for theme storage
    private $defaultTheme = 'light'; // Default theme if none is selected

    /**
     * Constructor
     *
     * @param array $themes List of available themes
     * @param string $cookieName Name of the cookie for theme storage
     * @param string $defaultTheme Default theme if none is selected
     */
    public function __construct($themes = [], $cookieName = '', $defaultTheme = '') {
        $this->themes = $themes ?: $this->themes;
        $this->cookieName = $cookieName ?: $this->cookieName;
        $this->defaultTheme = $defaultTheme ?: $this->defaultTheme;
    }

    /**
     * Switches to a new theme
     *
     * @param string $themeName The name of the theme to switch to
     * @return bool Returns true if the theme switch was successful, false otherwise
     */
    public function switchTheme($themeName) {
        if (!in_array($themeName, $this->themes)) {
            // Theme not found in the list of available themes
            throw new BadRequestException('Invalid theme selected.');
        }

        // Set the theme in the cookie
        Configure::write('Cookie', ['name' => $this->cookieName, 'expires' => '+2 weeks']);
        setcookie($this->cookieName, $this->encrypt($themeName), Configure::read('Cookie.expires'), Configure::read('Cookie.path'));

        // Save the theme to the database if user is logged in
        // $this->saveThemeToDatabase($themeName); // Uncomment this line if you have a User model and Table

        return true;
    }

    /**
     * Gets the current theme
     *
     * @return string Returns the current theme name
     */
    public function getCurrentTheme() {
        // Get the theme from the cookie
        if (isset($_COOKIE[$this->cookieName])) {
            $theme = $this->decrypt($_COOKIE[$this->cookieName]);
            return in_array($theme, $this->themes) ? $theme : $this->defaultTheme;
        }

        // Get the theme from the database if user is logged in
        // $theme = $this->getThemeFromDatabase(); // Uncomment this line if you have a User model and Table
        // return $theme ?: $this->defaultTheme;

        return $this->defaultTheme;
    }

    /**
     * Saves the theme to the database
     *
     * @param string $themeName The name of the theme to save
     */
    private function saveThemeToDatabase($themeName) {
        // Assuming you have a User model and a Themes table
        $userTable = TableRegistry::get('Users');
        $userId = $userTable->getCurrentUser()->id;
        $themesTable = TableRegistry::get('Themes');
        $themesTable->saveThemeForUser($userId, $themeName);
    }

    /**
     * Gets the theme from the database
     *
     * @return string|null Returns the theme name or null if not found
     */
    private function getThemeFromDatabase() {
        // Assuming you have a User model and a Themes table
        $userTable = TableRegistry::get('Users');
        $userId = $userTable->getCurrentUser()->id;
        $themesTable = TableRegistry::get('Themes');
        return $themesTable->getThemeForUser($userId);
    }
}
