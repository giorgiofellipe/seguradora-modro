<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Core;

/**
 * Description of EventResponse
 *
 * @author Rodrigo Cândido
 */
class EventResponse extends JsonResponse
{

    private $msg;
    private $success;
    private $close = null;
	private $reset = null;
	private $resetCaller = null;

    public function __construct($msg, $success = true)
    {
        $this->setMsg($msg);
        $this->setSuccess($success);
        parent::__construct(null);
    }
	
	public function setResetCaller($resetCaller)
	{
		$this->resetCaller = $resetCaller;	
	}
	
	public function setReset($reset) 
	{
		$this->reset = $reset;
	}
	
	public function getResetCaller() 
	{
		return $this->resetCaller;
	}
	
	public function getReset()
	{
		return $this->reset;
	}
	

    public function getMsg()
    {
        return $this->msg;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function getClose()
    {
        return $this->close;
    }

    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    public function setSuccess($success)
    {
        $this->success = $success;
    }

    public function setClose($close)
    {
        $this->close = $close;
    }


    public function render()
    {
        $this->setData(Array('success' => $this->getSuccess(), 'msg' => $this->getMsg(), 'close' => $this->close,'reset'=>$this->reset,'resetCaller'=>$this->resetCaller));
        return parent::render();
    }

}
