<?php
class Form extends AppModel
{
    public $actsAs = array('Containable');
    public $order = 'Form.online_date DESC';
    public $hasMany = array(
        'Question' => array(
            'order' => 'Question.order ASC',
            'dependent' => true
        )
    );
    public $hasAndBelongsToMany = array(
        'User' => array(
            'joinTable' => 'forms_users',
            'foreignKey' => 'form_id',
            'associationForeignKey' => 'user_id',
            'fields' => 'User.username'
        )
    );
    private $oldData;


    public function beforeSave()
    {
        $data = $this->data['Form'];
        if (isset($data['id'])) {
            $this->recursive = -1;
            $this->oldData = $this->findById($data['id']);

            if (isset($data['file']) && is_array($data['file']) && $data['file']['error'] == UPLOAD_ERR_OK) {
                if ($this->oldData) {
                    @unlink('files/uploads/form-' . $this->oldData['Form']['id'] . '-' . $this->oldData['Form']['file']);
                }

                $destination = 'files/uploads/form-' . $data['id'] . '-' . $data['file']['name'];
                move_uploaded_file($data['file']['tmp_name'], $destination);
                chmod($destination, 0777);
                $this->data['Form']['file'] = $data['file']['name'];
            } elseif (isset($data['file']) && is_array($data['file'])) {
                $this->data['Form']['file'] = $this->oldData ? $this->oldData['Form']['file'] : '';
            }
        }
        return true;
    }

    public function updateFile($data)
    {
        debug($data);
        if (isset($data['Form']['file']) && is_array($data['Form']['file']) && $data['Form']['file']['error'] == UPLOAD_ERR_OK) {

            $destination = 'files/uploads/form-' . $data['Form']['id'] . '-' . $data['Form']['file']['name'];
            move_uploaded_file($data['Form']['file']['tmp_name'], $destination);
            chmod($destination, 0777);
            $saveData = array('id' => $data['Form']['id'], 'file' => $data['Form']['file']['name']);
            $this->save($saveData, array('validate' => false, 'callbacks' => false));
        }
        return true;
    }


    public function getMaxPoints()
    {
        $sql = "SELECT SUM(q.points) AS 'points' FROM forms f LEFT JOIN questions q ON(f.id=q.form_id)
			 GROUP BY q.form_id";
        $row = $this->query($sql);
        return $row ? $row[0][0]['points'] : 0;
    }

    public function getTotalPoints()
    {
        $sql = "SELECT SUM(q.points) AS 'points' FROM forms f LEFT JOIN questions q ON(f.id=q.form_id)";
        $row = $this->query($sql);
        return $row ? $row[0][0]['points'] : 0;
    }

}
