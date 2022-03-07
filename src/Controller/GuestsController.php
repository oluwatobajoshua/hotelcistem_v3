<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * Guests Controller
 *
 * @property \App\Model\Table\GuestsTable $Guests
 * @method \App\Model\Entity\Guest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GuestsController extends AppController {
    private $basePath = '/customers/guests';
    
    public function initialize(): void {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Authorization->skipAuthorization();
    }
    

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        try{
            $path = $this->basePath;
            $response = $this->httpClient->get($path);
            if ($response->getStatusCode() == "200") {
                $guests = $response->getJson();
                $this->set(compact('guests'));
            } else {
                $this->handleHttpErrors($response);
            }
        } catch (\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Guest id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        //you might want to add validation for the request here
        try{
            $path = $this->basePath."/".$id;
            $response = $this->httpClient->get($path);
    
            if ($response->getStatusCode() == "200") {
                $customer = (object)$response->getJson();            
                $this->set(compact('customer'));
            } else {
                $this->handleHttpErrors($response);
            }
        } catch (\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $guest = $this->getSchemaDef();
        if ( $this->request->is('post') && $this->validateFields() ) {
            try {
                $path = $this->basePath;
                $response = $this->httpClient->post($path, 
                    json_encode($this->request->getData()),
                    ['type' => 'json']);
    
                if($response->getStatusCode() == '200'){
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Guest'));
            } catch (\Exception $e) {
                $this->Flash->error(__($e->getMessage()));
            }            
        }
        $genders = ['' => '-Select One-', 'm' => 'Male', 'f' => 'Female'];
        //$states = $this->Guests->States->find('list', ['limit' => 200]);
        //$countries = $this->Guests->Countries->find('list', ['limit' => 200]);
        //$this->set(compact('customer', 'genders', 'states', 'countries'));
        $this->set(compact('guest', 'genders'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Guest id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        
        try {
            $path = $this->basePath."/".$id;
        
            if ($this->request->is(['patch', 'post', 'put'])) {
                $response = $this->httpClient->patch($path, 
                    json_encode($this->request->getData()),
                    ['type' => 'json']);
                if ($response->getStatusCode() == "200") {
                    $this->Flash->success(__('The {0} has been updated.', 'guest')); 
                    return $this->redirect(['action' => 'view', $id]);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Guest'));
            }
    
            $response = $this->httpClient->get($path);
            if ($response->getStatusCode() == "200") {
                $guest = $this->getSchemaDef();
                $guest['data'] = $response->getJson();
                $genders = ['' => '-Select One-', 'm' => 'Male', 'f' => 'Female'];
                // $states = $this->Guests->States->find('list', ['limit' => 200]);
                // $countries = $this->Guests->Countries->find('list', ['limit' => 200]);
                //$this->set(compact('customer', 'genders', 'states', 'countries'));
                $this->set(compact('guest', 'genders'));
            }
        } catch(\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }
    }


    public function changeType($id = null) {
        
        try {
            $path = $this->basePath."/".$id;
        
            if ($this->request->is(['patch', 'post', 'put'])) {
                $response = $this->httpClient->patch($path.'/type', 
                    json_encode($this->request->getData()),
                    ['type' => 'json']);
                if ($response->getStatusCode() == "200") {
                    $this->Flash->success(__('The {0} has been updated.', 'group flag')); 
                    return $this->redirect(['action' => 'view', $id]);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} type could not be changed. Please, try again.', 'Guest'));
            }
    
            $response = $this->httpClient->get($path);
            if ($response->getStatusCode() == "200") {
                $guest = $this->getSchemaDef();
                $guest['data'] = $response->getJson();
                $this->set(compact('guest'));
            }
        } catch(\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }
    }


    /**
     * Delete method
     *
     * @param string|null $id Guest id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function _delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $guest = $this->Guests->get($id);
        if ($this->Guests->delete($guest)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Guest'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Guest'));
        }

        return $this->redirect(['action' => 'index']);
    }


    private function validateFields(){
        return true;
    }


    public function getSchemaDef(){
        $schema = [
            'schema' => [
                'firstname' => ['type' => 'string'],
                'lastname' => ['type' => 'string', 'length' => 255], 
                'dob' => ['type' => 'date'],
                'phone' => ['type' => 'string', 'length' => 15], 
                'remarks' => ['type' => 'text'], 
                'group_flag' => ['type' => 'boolean'], 
                'gender' => ['type' => 'string'],
                'email' => ['type' =>'email'],
                'billing_address' => [
                    'address_line_1' => ['type' => 'string'],
                    'address_line_2' => ['type' => 'string'],
                    'city' => ['type' => 'string'],
                    'state' => ['type' => 'string'],
                    'country' => ['type' => 'string'],
                ],
                'branch_id' => ['type' => 'number']
               ],
            'required' => [
                'firstname' => 'Firstname is required',
                'lastname' => 'Lastname is required',
                'phone' => 'Phone number is required'
            ]
        ];
        return $schema;
    }
}
