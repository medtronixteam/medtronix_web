<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
class VerifyMail extends Component
{
    public $verificationMail=false;
    public $email;
    public function render()
    {   $this->email=auth()->user()->email;
        return view('livewire.verify-mail');
    }
    public function verify(User $user) {
        $this->validate(['email' => 'required|email']);
        $user=Auth::user();
        $user->email=$this->email;
        $user->save();
        $this->verificationMail=false;
        event(new Registered(Auth::user()));
        $this->verificationMail=true;
    }
}
