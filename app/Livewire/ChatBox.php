<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChatMessage;
use Livewire\Attributes\On;

class ChatBox extends Component
{
    public $boxStep=1;
    public $userNameBox='';
    public $userEmailBox='';
    public $userMessage='';
    public $serviceType='';
    public $selectedProduct='service';
    public $userChatOnly=[];

    protected $listeners = ['chatWithData' => 'refreshCall'];

    public function render()
    {

        if(session()->has('userEmail')){
            $this->userEmailBox=session()->get('userEmail');
            if(session()->has('userName')){
                $this->boxStep=4;
                $this->userNameBox=session()->get('userName');
            }
        }


        return view('livewire.chat-box');
    }
    public function serviceType($service){
        $this->serviceType=$service;
    }
    public function store(){
        if($this->userMessage!=''){
            $this->validate([
                'userMessage' => 'required|string|min:1|max:30',

            ]);
            ChatMessage::create([
                'name' => $this->userNameBox,
                'email' => $this->userEmailBox,
                'message' => $this->userMessage,
                'is_admin' => 0,
            ]);

            //$this->dispatch('call-Function');
            $this->userMessage='';
            $this->chatWith($this->userEmailBox,$this->userNameBox);
           $this->dispatch('chatWithD', ['someData' => '']);
        }
    }
    public function chatWith($email,$UserName){

        $this->userChatOnly = ChatMessage::where('email',$email)->get();
    }
    public function refreshCall($param=null) {

        $this->chatWith($this->userEmailBox,$this->userNameBox);
    }

    public function nextStep($step)
    {

        if($step==3){

            $this->validate([
                'userEmailBox' => 'required|email',
                'userNameBox' => 'required|string|min:5|max:15',
            ]);
            $this->boxStep=$step;
            session()->put('userEmail',$this->userEmailBox);
            session()->put('userName',$this->userNameBox);

        }else{
            $this->boxStep=$step;
        }


    }

}
