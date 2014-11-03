<?php


class ApiPochta  {

	private $guzzle;
	private $config;

	public function __construct() {
		$this->config = Config::get('api');

		$this->guzzle = new \GuzzleHttp\Client(
			[
				'base_url' => $this->config['url']
			]
		);

	}

	/**
	 * Возвращаем все статусы (включая последний актуальный)
	 *
	 * @param $id
	 * @return mixed
	 * @throws Exception
	 */
	public function getStatuses($id){

		$statuses = new Statuses();
		$last_status = $statuses->getLast($id);

		#смотрим насколько старый предыдущий статус
		if(!empty($last_status)){
			$date   = Carbon::createFromTimeStamp($last_status->updated_at);
			$now    = Carbon::now();

			//если время актуальности статуса прошлло или посылка в конечном пункте, то выводим все статусы
			if($last_status->parcel_status_id == 4 || $now->diffInMinutes($date) < $this->config['actual_time']){
				$all_statuses = $statuses->getAll($id);
			}
		}

		//не получили статусы из кеша
		if(empty($all_statuses)) {
			//делаем запрос к апи почты на акутальный статус...
			$actual_status = $this->getActualStatus($id);

			#проверяем. Если последний статус у нас не актуален (или в БД у нас ничего нет, или статусы не совпадают)
			if (empty($last_status) || $actual_status->parcel_status_id != $last_status->parcel_status_id) {
				//добавляем в БД
				$statuses->add($id, $actual_status);
			} else {
				#обновляем время у последнего статуса
				$statuses->updateLast($last_status->id, $actual_status->timestamp);
			}

			$all_statuses = $statuses->getAll($id);
		}


		return $all_statuses;

	}

	/**
	 * Делаем запрос на АПИ почты, для получения актуального статуса
	 *
	 * @param $id
	 * @return mixed
	 * @throws Exception
	 */
	public function getActualStatus($id){
		try {
			$responce = $this->guzzle->get('statuses/' . $this->config['token'] . '/' . $id . $this->config['format'], [
				'future' => false,
				'timeout' => $this->config['timeout'],
				'exceptions' => false,
			]);
		} catch (\Exception $e) {
			throw new \Exception('Вы что не видите, у нас обед!');
		}

		if(!empty($responce)) {
			$code = $responce->getStatusCode();
			if($code == 200) {
				return json_decode($responce->getBody());
			}
		}

		throw new \Exception('Пчта не смогла в данный момент ответить на запрос. Попробуйте повторить запрос еще раз.');

	}

}
