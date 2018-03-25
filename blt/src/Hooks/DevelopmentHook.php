<?php

namespace Acquia\Blt\Custom\Hooks;

use Acquia\Blt\Robo\BltTasks;
use Symfony\Component\Filesystem\Filesystem;

/**
 * This class defines Development Symlinks.
 */
class DevelopmentHook extends BltTasks {

  /**
   * Symlink your local copy of the development modules.
   *
   * @hook post-command setup:composer:install
   */
  public function postSetupComposerInstall() {
    $fs = new Filesystem();
    $module_path = $this->getConfigValue('docroot') . '/modules/contrib';
    $dev_path = $this->getConfigValue('dev-modules.path');
    $dev_list = $this->getConfigValue('dev-modules.link');

    foreach ($dev_list as $module) {
      $info_file = $module_path . '/' . $dev_path . '/' . $module . '/' . $module . '.info.yml';

      // We can't rely on checking for the directory only, since vagrant will
      // create it if it doesn't exist, so check for the info file.
      if (!$fs->exists($info_file)) {
        $this->say("No local copy of {$module}, skipping symlink");
        return;
      }

      $this->say("Linking to local {$module} module.");
      $result = $this->taskExecStack()
        ->dir($module_path)
        ->exec("rm -rf {$module}")
        ->exec("ln -s {$dev_path}/{$module} ${module}")
        ->detectInteractive()
        ->printOutput(TRUE)
        ->run();

    }
  }

}
