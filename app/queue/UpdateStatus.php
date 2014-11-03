<?php

/**
 * Class UpdateStatus
 *
 * Задача включает в себя как повторный запуск при общибке, так и запуск запланированной задачи
 */
class UpdateStatus implements \Kodeks\PhpResque\Lib\ResqueJobInterface {

    public $start = false;
    public $id;
    private $redis;

    public function setUp()
    {

        if(empty($this->args['id'])){
            return;
        }

        $this->id = $this->args['id'];

        $this->redis = Redis::connection();
        $status = $this->redis->get('status:' . $this->id);

        //если над задачей больше никто не крутится или это повторная задача - разрешаем выполненение
        if(empty($status) || !empty($this->args['retry']) || !empty($this->args['later'])){
            $this->start = true; //разрешаем старт задачи
        }
    }


    public function perform(){

        if(!$this->start)
            return;

        $pochta = new ApiPochta();
        try{
            $statuses = $pochta->getStatuses($this->id);

            $last = array_pop($statuses);
            if($last['parcel_status_id'] != 4 && !empty($this->args['later'])){
                //добавляем мониторинг по данному трек номеру
                $pochta->schedule($this->id, false);
            }

        }catch(\Exception $e){
            //ставим задачу повторно
            $retry = true;
            $params = ["id"=>$this->id, 'retry' => $retry];

            if(!empty($this->args['later'])){
              $params['later'] = true;
            }

            Queue::push("UpdateStatus", $params);
        }

        if(empty($retry)){ //задача завершилась хорошо
            $this->redis->set('status:' . $this->id, false);
        }

    }
}
