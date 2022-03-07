<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

use Cake\Http\Client;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Object used to make http request
     */
    protected $httpClient; 

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void {
        parent::initialize();
        
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->viewBuilder()->setOption('serialize', true);

        //load Api model;
        //$this->loadModel('Apis');
        
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event) {
        parent::beforeFilter($event);
        // for all controllers in our application, make index and view
        // actions public, skipping the authentication check
        $this->Authentication->addUnauthenticatedActions(['view']);

        /**
         * Create a scoped http client that is reusable across all controllers
         * to interact with the backend webservice
         * These values can be loaded from a configuration file
         * Added by Uche Uba 24/01/2022
         */
        $host = "ec2-3-145-118-240.us-east-2.compute.amazonaws.com";
        //$host = "localhost";
        $port = "3000";
        $scheme = "http";
        $this->httpClient = new Client([
            'host' => $host, 
            'scheme' => $scheme,
            'port' => $port,
            //'auth' => ['username' => 'mark', 'password' => 'testing'],            
          ]);
    }

    public function beforeRender(EventInterface $event) {
        $this->viewBuilder()->setTheme('AdminLTE');
    }    

    protected function handleHttpErrors($response, $resource = ""){
        pr($response->getJson());
        if($response->getStatusCode() == '404'){
            $this->Flash->error(__('A problem has occurred. No matching {0} resource found with given ID.', $resource));
        } else {
            $this->Flash->error(__($response->getJson()['error_description']));
        }
        
        //exit;
        //if($response->getStatusCode() == '400')
            //throw new BadRequestException();
    }

}
