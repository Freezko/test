<?php

class StatusController extends BaseController {

	public function Index($id)
	{

		$pochta = new ApiPochta();
		try{
			//получаем статусы
			$statuses = $pochta->getStatuses($id);

			$last = end($statuses);

			if($last['parcel_status_id'] != 4){ // Если посылка еще не в конечном пункте
				if(!(count($statuses) == 1 && $last['parcel_status_id'] == 0)) { //и в массиве не 1 элемент с ненайденной посылкой
					$pochta->schedule($id); //ставим робота на проверку
				}
			}

			return Response::json([
				'trackid'   => $id,
				'statuses'  => $statuses
			]);

		}catch(\Exception $e){

			//ставим задачу в очередь на обновление статуса по данному трекинг номеру
			Queue::push("UpdateStatus",["id"=>$id]);
			$pochta->schedule($id); //ставим робота на проверку если еще не установлен

			return Response::json([
				'status'    => 500,
				'message'   => $e->getMessage()
			], 500);
		}


	}

}
