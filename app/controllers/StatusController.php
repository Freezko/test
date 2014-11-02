<?php

class StatusController extends BaseController {

	public function Index()
	{
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
	}

}
