<?php
// 代码生成时间: 2025-09-02 21:15:53
use Cake\Http\Response;
use Cake\Http\Exception\NotFoundException;

class ThemeSwitcherController extends AppController
{
    /**
     * Switches the application theme.
     *
     * @param string $theme The name of the theme to switch to.
     * @return void
     * @throws NotFoundException If the theme does not exist.
     */
    public function switchTheme($theme)
    {
        // Check if the theme is valid
        $validThemes = ['default', 'dark', 'light'];
        if (!in_array($theme, $validThemes)) {
            throw new NotFoundException(__('Invalid theme.'));
        }

        // Set the theme in the session
        $this->request->getSession()->write('Config.theme', $theme);

        // Redirect to the previous page or a default page
        return $this->redirect($this->request->referer() ?: '/' );
    }
}
