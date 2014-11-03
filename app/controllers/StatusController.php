<?php

class StatusController extends BaseController {

	public function Index($id)
	{
		/*
		$status = [
			'trackid' => '123',
			'statuses' => [
					[
						'timestamp' => time(),
						'parcel_status_id' => 0,
						'message' => 'Text'
					],
					[
						'timestamp' => time(),
						'parcel_status_id' => 2,
						'message' => 'Text2'
					],
			]
		];

		return Response::json($status);
		*/

		$pochta = new ApiPochta();
		try{
			$statuses = $pochta->getStatuses($id);

			return Response::json([
				'trackid'   => $id,
				'statuses'  => $statuses
			]);

		}catch(\Exception $e){
			return Response::json([
				'status'    => 500,
				'message'   => $e->getMessage()
			], 500);
		}


	}

}
