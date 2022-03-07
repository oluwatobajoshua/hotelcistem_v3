<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * Companies Controller
 *
 * @property \App\Model\Table\GuestsTable $Guests
 * @method \App\Model\Entity\Guest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompaniesController extends AppController {
    private $basePath = '/customers/companies';
    

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
        try {
            $path = $this->basePath;
            $response = $this->httpClient->get($path);
    
            if ($response->getStatusCode() == "200") {
                $companies = $response->getJson();
                $this->set(compact('companies'));
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
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        //you might want to add validation for the request here
        try {
            $path = $this->basePath."/".$id;
            $response = $this->httpClient->get($path);
    
            if ($response->getStatusCode() == "200") {
                $company = (object)$response->getJson();            
                $this->set(compact('company'));
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
        $company = $this->getSchemaDef();
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
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Company'));
            } catch (\Exception $e){
                $this->Flash->error(__($e->getMessage()));
            }            
        }
        //$this->loadModel('States');
        //$this->loadModel('Countries');
        $states = $this->fetchTable('States')->find('list', ['limit' => 200])->toArray();
        //pr($states);exit;
        $countries = $this->fetchTable('Countries')->find('list', ['limit' => 200])->toArray();
        $this->set(compact('company', 'states', 'countries'));
        //$this->set(compact('company'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Company id.
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
                    $this->Flash->success(__('The {0} has been updated.', 'company')); 
                    return $this->redirect(['action' => 'view', $id]);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Company'));                
            }
    
            $response = $this->httpClient->get($path);
            if ($response->getStatusCode() == "200") {
                $company = $this->getSchemaDef();
                $company['data'] = $response->getJson();
                // $states = $this->States->find('list', ['limit' => 200]);
                // $countries = $this->Countries->find('list', ['limit' => 200]);
                //$this->set(compact('company', 'states', 'countries'));
                $this->set(compact('company'));
            }
        } catch (\Exception $e) {
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
                'business_name' => ['type' => 'string'],
                'contact_person' => [
                    'firstname' => ['type' => 'string'], 
                    'lastname' => ['type' => 'string']
                ],
                'phone' => ['type' => 'string', 'length' => 15], 
                'remarks' => ['type' => 'text'], 
                'email' => ['type' =>'email'],
                'registered_address' => [
                    'address_line_1' => ['type' => 'string'],
                    'address_line_2' => ['type' => 'string'],
                    'city' => ['type' => 'string'],
                    'state' => ['type' => 'string'],
                    'country' => ['type' => 'string'],
                ],
                'branch_id' => ['type' => 'number']
               ],
            'required' => [
                'business_name' => 'Business name is required',
                'contact_person' => [
                    'firstname' => 'Firstname is required', 
                    'lastname' => 'Lastname is required'
                ],
                'phone' => 'Phone number is required', 
                'email' => 'Email is required'
            ]
        ];
        return $schema;
    }
}
