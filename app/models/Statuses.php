<?php

class Statuses{


	protected $table = 'statuses';

	/**
	 * Получаение последнего статуса из БД
	 *
	 * @param $id
	 * @return mixed
	 */
	public function getLast($id){
		return DB::table($this->table)->where('trackid',$id)->orderBy('created_at', 'desc')->first();
	}

	/**
	 * Получение всех статусов из БД
	 *
	 * @param $id
	 * @return mixed
	 */
	public function getAll($id){
		$result =  DB::table($this->table)->where('trackid',$id)->orderBy('created_at', 'asc')->get();

		//преобразуем в нужный формат
		if(!empty($result)){
			foreach ($result as $key=>$data) {
				$result[$key] = [
					'timestamp'         => $data->created_at,
					'parcel_status_id'  => $data->parcel_status_id,
					'message'           => $data->message
				];
			}

		}

		return $result;
	}

	/**
	 * Добавление статуса в БД
	 *
	 * @param $id
	 * @param $status
	 */
	public function add($id, $status){
		DB::table($this->table)->insert([
			'trackid'           => $id,
			'created_at'        => $status->timestamp,
			'updated_at'        => $status->timestamp,
			'parcel_status_id'  => $status->parcel_status_id,
			'message'           => $status->message
		]);
	}

	/**
	 * Ставим updated_at последнему статусу
	 * updated_at говорит что мы статус обновили через АПИ почты до актуальности
	 *
	 * @param $id
	 * @param $timestamp
	 */
	public function updateLast($id, $timestamp){
		DB::table($this->table)->where('id', $id)->update(['updated_at' => $timestamp]);
	}


}
