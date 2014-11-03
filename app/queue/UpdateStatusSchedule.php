<?php


class UpdateStatusSchedule implements \Kodeks\PhpResque\Lib\ResqueJobInterface {

    public $start = false;
    public $id;
    private $redis;

    public function setUp()
    {


        if(empty($this->args['id'])){
            return;
        }else{
            $this->id = $this->args['id'];
        }


        $this->redis = Redis::connection();
        $status = $this->redis->get('schedule:' . $this->id);

        //если над задачей больше никто не крутится или это повторная задача - разрешаем выполненение
        if(empty($status)){
            $this->start = true; //разрешаем старт задачи
        }
    }


    public function perform(){

        if(!$this->start)
            return;

        $pochta = new ApiPochta();
        try{
            $statuses = $pochta->getStatuses($this->id);
        }catch(\Exception $e){
            //ставим задачу повторно
            $retry = true;
            Queue::push("UpdateStatus",["id"=>$this->id, 'retry' => $retry]);
        }

        if(empty($retry)){ //задача завершилась хорошо
            $this->redis->set('status:' . $this->id, false);
        }

    }
}
