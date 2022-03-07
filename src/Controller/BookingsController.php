<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Bookings Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
 * @method \App\Model\Entity\Guest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookingsController extends AppController {
    private $basePath = '/bookings';    

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
                $bookings = (object) $response->getJson();
                $this->set(compact('bookings'));
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
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        try {
            $path = $this->basePath."/".$id;
            $response = $this->httpClient->get($path);
    
            if ($response->getStatusCode() == "200") {
                $booking = (object)$response->getJson();           
                $this->set(compact('booking'));
            } else {
                $this->handleHttpErrors($response);
            }
        } catch (\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }
    }

    public function add($data) {        
        //Store the booking info with a temp status pending payment confimation
        //Create checkout with ID for the new booking         
        //Booking created. Proceed to take payments to confirm the booking
        //Redirect to payment gateway to process payment using the booking checkout ID as reference

        if ( $this->request->is('post') ) {
            try {
                $path = $this->basePath;
                $response = $this->httpClient->post($path, 
                    json_encode($this->request->getData()),
                    ['type' => 'json']);
    
                if($response->getStatusCode() == '200'){
                    $ref = $response->getJson()['_id'];
                    $this->Flash->success(__('The {0} has been saved. Continue to take payment.', 'Booking'));
                    return $this->redirect(['action' => 'add', 'controller' => 'payments', $ref]);
                } else {
                    $this->handleHttpErrors($response);
                    $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Booking'));
                }
            } catch (\Exception $e){
                $this->Flash->error(__($e->getMessage()));
            }   
        }
        //pr("Booking created. Proceed to take payment to confirm the booking");
    }

    /**
     * New method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function new($guestId = null) {
        $booking = $this->getSchemaDef();
        if ( $this->request->is('post') ) {
            if(isset($this->request->getData()['check_availability'])) { 
                $availability = false;                
                $guest = null;
                try {
                    $booking['data'] = $this->request->getData();    

                    $availability = $this->checkAvailability($booking['data']);
                    if (!$availability) {
                        $this->Flash->error(__('There are no {0} for the selected dates. Please, try again.', 'availabilities'));
                    } else
                    if($guestId != null){
                        $guest = $this->findCustomer($guestId);
                        if($guest != null) {
                            $booking['data']['customer']['id'] = $guest->_id; 
                            $booking['data']['customer']['accessToken'] = $guest->_id; 
                        }
                    }     
                } catch (\Exception $e) {
                    $this->Flash->error(__($e->getMessage()));
                }
                $this->set(compact('booking', 'availability', 'guest'));
            } else { 
                $this->add($this->request->getData());
            }
        } 
        $guestIdString = "".$guestId;
        $this->set(compact('booking', 'guestIdString'));  

        /* This is handled in the browser js
        // $response = $this->httpClient->get('rooms');
        // if($response->getStatusCode() == '200'){
        //     $rooms = (object)$response->getJson();
        // }
        // $this->set(compact('booking', 'rooms')); 
        */
      
    }

    public function checkAvailability($data){
        $available = false;
        try {
            $path = $this->basePath.'/rooms/availabilities/check';
            $response = $this->httpClient->post($path, 
                json_encode($data),
                ['type' => 'json']);        
            if($response->getStatusCode() == '200'){
                $resp = (object) $response->getJson();
                $available = $resp->status;
            } else {
                $this->handleHttpErrors($response);                
            }
        } catch (\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }
        return $available;
    }

    //call get customer backend service when handling existing customers
    private function findCustomer($guestId) {
        $guest = null;
        try {            
            $path = '/customers/guests/'.$guestId;
            $response = $this->httpClient->get($path);        
            if($response->getStatusCode() == '200'){
                $guest = (object) $response->getJson();
            } else {
                $this->handleHttpErrors($response, 'Guest');
            }
        } catch (\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }
        return $guest;
    }

    /**
     * Edit method
     *
     * @param string|null $id Booking id.
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
                    $this->Flash->success(__('The {0} has been updated.', 'Booking')); 
                    return $this->redirect(['action' => 'view', $id]);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Booking'));                
            }
    
            $response = $this->httpClient->get($path);
            if ($response->getStatusCode() == "200") {
                $booking = $this->getSchemaDef();
                $booking['data'] = $response->getJson();
                $this->set(compact('booking'));
            }
        } catch (\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }
    }

    /****************************************************************** */
    /**
     * This section relates to managing the rooms on a booking ********
     */
    /****************************************************************** */

    public function bookingRoomEdit($bookingId, $roomId = "") {
        try {
            $path = $this->basePath."/".$bookingId."/rooms/".$roomId;
        
            if ($this->request->is(['patch', 'post', 'put'])) {

                $response = $this->httpClient->patch($path, 
                    json_encode($this->request->getData()),
                    ['type' => 'json']);
                if ($response->getStatusCode() == "200") {
                    $this->Flash->success(__('The {0} has been updated.', 'booking room')); 
                    return $this->redirect(['action' => 'view', $response->getJson()['booking']]);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Booking'));                
            }
    
            $response = $this->httpClient->get($path);
            if ($response->getStatusCode() == "200") {
                $room = $this->getBookingRoomSchemaDef();
                $room['data'] = $response->getJson();

                $this->set(compact('room'));
            }
        } catch (\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }        
    }



    public function bookingRoomAllocate($bookingId, $roomId = "") {
        try {
            $path = $this->basePath."/".$bookingId."/rooms/".$roomId;
        
            if ($this->request->is(['patch', 'post', 'put'])) {

                $response = $this->httpClient->patch($path.'/?action=allocate_room', 
                    json_encode($this->request->getData()),
                    ['type' => 'json']);
                if ($response->getStatusCode() == "200") {
                    $this->Flash->success(__('The {0} has been allocated.', 'booking room')); 
                    return $this->redirect(['action' => 'view', $response->getJson()['booking']]);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Booking'));                
            }
    
            $response = $this->httpClient->get($path);
            if ($response->getStatusCode() == "200") { 
                $room = $this->getBookingRoomSchemaDef();
                $room['data'] = $response->getJson();

                if(!empty($room['data']['room'])) {
                    $options = [$room['data']['room'] => $room['data']['room_num']];
                } else {
                    $resp = $this->httpClient->get('/room-types/'.$room['data']['room_type']);
                    $options[''] = ['-Select One-'];
                    foreach ($resp->getJson()['rooms'] as $key => $value) {
                        $options[$value['_id']] = $value['room_number'];
                    }
                }
                $this->set(compact('room', 'options'));
            }
        } catch (\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }        
    }


    /**
     * Only available to rooms that have status [reserved, checkin]
     */
    public function bookingRoomChange ($bookingId, $roomId = "") { 
        try {
            $path = $this->basePath."/".$bookingId."/rooms/".$roomId;
        
            if ($this->request->is(['patch', 'post', 'put'])) {

                $response = $this->httpClient->patch($path.'/?action=change_room', 
                    json_encode($this->request->getData()),
                    ['type' => 'json']);

                if ($response->getStatusCode() == "200") {
                    $this->Flash->success(__('The {0} has been changed.', 'room')); 
                    return $this->redirect(['action' => 'view', $response->getJson()['_id']]);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Booking'));                
            }
    
            $response = $this->httpClient->get($path);
            if ($response->getStatusCode() == "200") {
                $room = $this->getBookingRoomSchemaDef();
                $room['data'] = $response->getJson();
                if($room['data']['status'] == 'checkin') {
                    $room['required']['new_room'] = 'You need to select a new room number';
                }
                $this->set(compact('room'));
            }
        } catch (\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }        
    }


    public function bookingRoomCheckin($bookingId, $roomId = "") {
        try {
            $path = $this->basePath."/".$bookingId."/rooms/".$roomId;
        
            if ($this->request->is(['patch', 'post', 'put'])) {
                $response = $this->httpClient->patch($path.'/?action=checkin_room', 
                    json_encode($this->request->getData()),
                    ['type' => 'json']);
                if ($response->getStatusCode() == "200") {
                    $this->Flash->success(__('The {0} has been checked in.', 'booking room')); 
                    return $this->redirect(['action' => 'view', $response->getJson()['booking']]);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Booking'));                
            }
    
            // $response = $this->httpClient->get($path);
            // if ($response->getStatusCode() == "200") {
            //     $room = $this->getBookingRoomSchemaDef();
            //     $room['data'] = $response->getJson();
            //     $this->set(compact('room'));
            // }
        } catch (\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }        
    }


    public function bookingRoomCancel($bookingId, $roomId = "") {
        try {
            $path = $this->basePath."/".$bookingId."/rooms/".$roomId;
        
            if ($this->request->is(['patch', 'post', 'put'])) {
                $response = $this->httpClient->patch($path.'/?action=cancel_room', 
                    json_encode($this->request->getData()),
                    ['type' => 'json']);
                if ($response->getStatusCode() == "200") {
                    $this->Flash->success(__('The {0} has been cancelled.', 'booking room')); 
                    return $this->redirect(['action' => 'view', $response->getJson()['booking']]);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Booking'));                
            }
        } catch (\Exception $e) {
            $this->Flash->error(__($e->getMessage()));
        }        
    }



    public function bookingRoomCheckout($bookingId, $roomId = "") {
        try {
            $path = $this->basePath."/".$bookingId."/rooms/".$roomId;
        
            if ($this->request->is(['patch', 'post', 'put'])) {
                $response = $this->httpClient->patch($path.'/?action=checkout_room', 
                    json_encode($this->request->getData()),
                    ['type' => 'json']);
                if ($response->getStatusCode() == "200") {
                    $this->Flash->success(__('The {0} has been checked out.', 'booking room')); 
                    return $this->redirect(['action' => 'view', $response->getJson()['booking']]);
                } else {
                    $this->handleHttpErrors($response);
                }
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Booking'));                
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
                'customer' => [
                    'title' => ['type' => 'string'],
                    'firstname' => ['type' => 'string'], 
                    'lastname' => ['type' => 'string'],                
                    'phone' => ['type' => 'string', 'length' => 15],                 
                    'email' => ['type' =>'email'],
                    'group_flag' => ['type' => 'boolean'],
                    'remarks' => ['type' => 'text'], 
                ],
                'check_in_date' => ['type' => 'date'],
                'check_out_date' => ['type' => 'date']
                
            ],
            'required' => [
                'check_in_date' => 'You need to select a check in date',
                'check_out_date' => 'You nee to select a check out date', 
                'customer' => [
                    'firstname' => 'Customer firstname is required',
                    'lastname' => 'Customer lastname is required',
                    'phone' => 'Phone number is required', 
                    //'email' => 'Email is required'
                ]
            ]
        ];
        return $schema;
    }

    private function getBookingRoomSchemaDef() {

        $schema = [
            'schema' => [
                'room_desc' => ['type' => 'string'],
                'room_type_desc' => ['type' => 'string'],
                'start_date' => ['type' => 'date'],
                'end_date' => ['type' => 'date'], 
                'discount' => ['type' => 'float'],
                'amount' => ['type' => 'float'],                
            ],
            'required' => ['new_room_type' => 'You need to select a new room type']
        ]; 
        return $schema;
    }


    public function sample(){

    }
}
