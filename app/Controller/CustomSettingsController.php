<?php
App::uses('AppController', 'Controller');

/**
 * CustomSettingsController Controller *
 *
 */

class CustomSettingsController extends AppController {

    public function admin_index() {
        $config = Configure::read('custom_settings');
        if($this->request->is('post') && $this->request->data['CustomSetting']['competion_end']) {
            $newEnd = $this->request->data['CustomSetting']['competion_end'];
            $config['competion_end'] = mktime($newEnd['hour'],$newEnd['min'],0,$newEnd['month'],$newEnd['day'],$newEnd['year']);
            $newNextStart = $this->request->data['CustomSetting']['next_competition'];
            $config['next_competition'] = mktime($newNextStart['hour'],$newNextStart['min'],0,$newNextStart['month'],$newNextStart['day'],$newNextStart['year']);
            $config['show_points_in_profile'] = $this->request->data['CustomSetting']['show_points_in_profile'];
            $config['reactivate_email_text'] = $this->request->data['CustomSetting']['reactivate_email_text'];
            Configure::write('custom_settings', $config);
            Configure::dump('custom_settings.php', 'default', array('custom_settings'));
            $this->Session->setFlash("Die Einstellungen wurden gespeichert.", 'default', array('class' => 'success'));
        }
        $this->set('config',$config);

    }


    public function admin_testmail(){
        $this->autoRender = false;

        $this->loadModel('User');

        $this->User->id = $this->Auth->user('id');

        if (!$this->User->exists())
        {
            throw new NotFoundException(__('Invalid user'));
        }

        $config = Configure::read('custom_settings');
        $text = $config['reactivate_email_text'];
        $searchArray = array('<a','<p','<li','<ul','<ol');
        $replaceArray = array('<a style="font: bold 14px Arial;color: #000000; text-decoration: underline;"','<p style="font: 14px Arial; padding: 0; margin: 0 0 20px 0;"','<li style="font: 14px Arial; margin: 0 0 5px 0;"','<ul style="margin-bottom: 20px; list-style: square;"','<ol style="margin-bottom: 20px;"');
        $text = str_replace($searchArray,$replaceArray,$text);

        $user = $this->User->read(null, $this->User->id);

        App::uses('CakeEmail', 'Network/Email');
        $mail = new CakeEmail();
        $mail->from('logistikmasters@springer.com')
            ->to($user['User']['email'])
            ->subject('Bestätigen Sie Ihre Teilnahme bei Logistik Masters (Testmail!!!)')
            ->emailFormat('html')
            ->template('activation')
            ->viewVars(array(   'firstname' => $user['UserProfile']['firstname'],
                'surname' => $user['UserProfile']['surname'],
                'text' => $text,
                'activationLink' => 'https://' . $_SERVER['HTTP_HOST'] . '/users/doubleoptin/ichbinnichtaktiv'))
            ->send();
        $this->Session->setFlash('Die Testmail wurde erfolgreich versendet.', 'default', array('class' => 'success'));
        $this->redirect(array(
            'action'     => 'index'
        ));

    }
}