<?php

class UserPoint extends AppModel
{
    public $actsAs = array('Utils.SoftDelete');

    public $belongsTo = array(
		'User'
	);
	
	public function initStatsRow($userId) {
		$params = array(
			'recursive' => -1,
			'conditions' => array(
				'UserPoint.user_id' => $userId,
				'UserPoint.year' => (CURRENT_YEAR - 2000)
			),
			'fields' =>  'UserPoint.user_id'
		);
		$stats = $this->find('first', $params);
		
		if(!$stats) {
			$data = array(
				'UserPoint' => array(
					'user_id' => $userId,
					'year' => (CURRENT_YEAR - 2000)
				)
			);
			$this->save($data);
		}
	}

    public function getStatsRow($userId) {
        $params = array(
            'recursive' => -1,
            'conditions' => array(
                'UserPoint.user_id' => $userId,
                'UserPoint.year' => (CURRENT_YEAR - 2000)
            ),
            'fields' =>  'UserPoint.points'
        );
        $stats = $this->find('first', $params);
        return $stats['UserPoint']['points'] ? $stats['UserPoint']['points'] : 0;
    }

}

