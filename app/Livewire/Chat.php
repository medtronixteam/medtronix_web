<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChatMessage;
use Livewire\Attributes\On;
class Chat extends Component
{

    public $chatUsersList=[];
    public $userChatOnly=[];
    public $UserName='';
    public $UserEmail='';
    public $newMessage='';

    protected $listeners = ['leftSideEmail' => 'leftSideEmails','chatWithD' => 'callFunction'];

    public function  leftSideEmails($param=null) {

        $this->chatUsersList = ChatMessage::select('email')->latest()->distinct()->get();
    }


    public function callFunction($param=null) {

        $this->chatWith($this->UserEmail,$this->UserName);
    }

    public function chatWith($email,$name){

        $this->UserName=$name;
        $this->UserEmail=$email;
        $this->userChatOnly = ChatMessage::where('email',$email)->get();

    }

    #[On('call-Function')]
        public function render()
    {
       // $this->listeners = ['leftSideEmails'];
        $this->leftSideEmails ();
        return view('livewire.chat');
    }
    public function store(){

        if($this->newMessage!=''){

            $ChatMessage = ChatMessage::create([
                'name' => $this->UserName,
                'email' => $this->UserEmail,
                'message' => $this->newMessage,
                'is_admin' => 1,
            ]);
            $this->dispatch('chatWithData', ['email' => $this->UserEmail,'UserName'=>'']);

            $this->newMessage='';
            $this->chatWith($this->UserEmail,$this->UserName);

        }



    }

}
