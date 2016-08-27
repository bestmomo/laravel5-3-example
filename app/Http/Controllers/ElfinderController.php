<?php 

namespace App\Http\Controllers;

use Barryvdh\Elfinder\Session\LaravelSession;
use Barryvdh\Elfinder\Connector;
use Barryvdh\Elfinder\ElfinderController as ElfinderControllerBase;

class ElfinderController extends ElfinderControllerBase
{
    /**
     * Override parent method
     */
    public function showConnector()
    {
        $roots = $this->app->config->get('elfinder.roots', []);

        if ($directory = auth()->user()->getFilesDirectory()) {
            $roots[0]['path'] = public_path() . '/files/' . $directory;
            $roots[0]['URL'] = '/files/' . $directory;
        }

        if (app()->bound('session.store')) {
            $sessionStore = app('session.store');
            $session = new LaravelSession($sessionStore);
        } else {
            $session = null;
        }

        $rootOptions = $this->app->config->get('elfinder.root_options', array());
        foreach ($roots as $key => $root) {
            $roots[$key] = array_merge($rootOptions, $root);
        }

        $opts = $this->app->config->get('elfinder.options', array());
        $opts = array_merge($opts, ['roots' => $roots, 'session' => $session]);

        // run elFinder
        $connector = new Connector(new \elFinder($opts));
        $connector->run();
        return $connector->getResponse();
    }
}
