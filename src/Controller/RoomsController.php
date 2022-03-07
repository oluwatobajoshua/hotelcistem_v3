<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * Rooms Controller
 *
 * @property \App\Model\Table\GuestsTable $Guests
 * @method \App\Model\Entity\Guest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoomsController extends AppController {
    private $basePath = '/rooms';
    

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
        $path = $this->basePath;
        $response = $this->httpClient->get($path);

        //pr($response->getJson());

        if ($response->getStatusCode() == "200") {
            $rooms = $response->getJson();
            $this->set(compact('rooms'));
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
                $room = (object)$response->getJson();            
                $this->set(compact('room'));
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
        $room = $this->getSchemaDef();
        //$this->Authorization->authorize($guest, 'update');
        
        if ($this->request->is('post') && $this->validateFields()) {
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
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'room'));
            } catch (\Exception $e) {
                $this->Flash->error(__($e->getMessage()));
            }     
        }
        
        $res = $this->httpClient->get("/room-types");
        $roomTypes[''] = '-Select One-';
        foreach ($res->getJson() as $key => $value){
            $roomTypes[$value['_id']] = $value['name'];
        }
        $this->set(compact('room', 'roomTypes'));
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
                    $this->Flash->success(__('The {0} has been updated.', 'room')); 
                    return $this->redirect(['action' => 'view', $id]);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'room'));
            }
    
            $response = $this->httpClient->get($path);
            if ($response->getStatusCode() == "200") {
                $room = $this->getSchemaDef();
                $room['data'] = $response->getJson();

                $res = $this->httpClient->get("/room-types");
                $roomTypes[''] = '-Select One-';
                foreach ($res->getJson() as $key => $value){
                    $roomTypes[$value['_id']] = $value['name'];
                }

                $this->set(compact('room', 'roomTypes'));
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

    


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addType() {
        $roomType = $this->getRoomTypeSchemaDef();
        //$this->Authorization->authorize($guest, 'update');
        
        if ($this->request->is('post') && $this->validateFields()) {
            try {
                $path = $this->basePath;
                $response = $this->httpClient->post('room-types', 
                    json_encode($this->request->getData()),
                    ['type' => 'json']);
    
                if($response->getStatusCode() == '200'){
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'room'));
            } catch (\Exception $e) {
                $this->Flash->error(__($e->getMessage()));
            }     
        }
        $this->set(compact('roomType'));
    }


    /**
     * List room types
     */
    public function types() {
        $path = '/room-types';
        $response = $this->httpClient->get($path);

        //pr($response->getJson());

        if ($response->getStatusCode() == "200") {
            $room_types = $response->getJson();
            $this->set(compact('room_types'));
        }
    }


    public function getSchemaDef(){
        $schema = [
            'schema' => [
                'room_number' => ['type' => 'string'],
                'room_type' => ['type' => 'string'], 
                'description' => ['type' => 'string'],
               ],
            'required' => [
                'room_number' => 'Room number is required',
                'room_type' => 'Room type is required'
            ]
        ];
        return $schema;
    }


    public function getRoomTypeSchemaDef(){
        $schema = [
            'schema' => [
                'name' => ['type' => 'string'],
                'description' => ['type' => 'string', 'length' => 255], 
                'rate' => ['type' => 'float'],
                'rate_deposit' => ['type' => 'float'],
                'hall_flag' => ['type' => 'boolean'],
               ],
            'required' => [
                'name' => 'Room type name is required',
                'rate' => 'Room type rate is required'
            ]
        ];
        return $schema;
    }
}


