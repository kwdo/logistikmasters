<?php
App::uses('AppController', 'Controller');
/**
 * Friends Controller
 *
 * @property Friend $Friend
 */
class FriendsController extends AppController {

    public function send() {
        if(!empty($this->request->data)) {
            $user = $this->Auth->user();
            $this->Friend->set($this->request->data);
            if($this->Friend->validates()) {
                App::uses('CakeEmail', 'Network/Email');
                $mail = new CakeEmail();
                $mail->from(array($user['email'] => $user['UserProfile']['firstname'] . ' ' . $user['UserProfile']['surname']))
                    ->to($this->request->data['Friend']['email'])
                    ->subject('Empfehlung von Logistik Masters')
                    ->send($this->request->data['Friend']['message']);
                // Display the success.ctp page instead of the form again
                $this->render('success');
            } else {
                $this->render('recommend');
            }
        }
    }

    public function recommend() {
        // Placeholder for index. No actual action here, everything is submitted to the send function.
    }

    public function success() {
        // Placeholder for index. No actual action here, everything is submitted to the send function.
    }


    /**
     * beforeFilter
     *
     * @param
     * @return void
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('send','success');
    }
}
