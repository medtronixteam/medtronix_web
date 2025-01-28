<?php

namespace App\Livewire;

use App\Models\JobApplication;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;


class ApplyNow extends Component
{
    use WithFileUploads;
    public $step=1;
    public $first_name, $last_name, $email, $position_applied, $experience, $cover_letter, $resume;

    public $ipAddress;
    public $browser;
    public $platform;
    public $device;
    public $userAgent;
    public function mount()
    {
        // Get IP address
        $this->ipAddress = Request::ip();

        // Get device details using Agent
        $agent = new Agent();
        $this->browser = $agent->browser();
        $this->platform = $agent->platform();
        $this->device = $agent->device();
        $this->userAgent = Request::header('User-Agent');
    }
    public function nextStep() {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'position_applied' => 'required|string|max:255',
        ]);


        $this->step = 2;
    }
    public function backStep() {
        $this->step = 1;
    }
    public function submit()
    {
        $this->validate([
            'experience' => 'required|string',
            'cover_letter' => 'nullable|string', // 10MB max
        ]);

        $resumePath = $this->resume ? $this->resume->store('resumes', 'public') : null;

        JobApplication::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'position_applied' => $this->position_applied,
            'experience' => $this->experience,
            'cover_letter' => $this->cover_letter,
            'resume_path' => $resumePath,
            'applied_from' => json_encode( [
                'ipAddress' => $this->ipAddress,
                'browser' => $this->browser,
                'platform' => $this->platform,
                'device' => $this->device,
                'userAgent' => $this->userAgent,
            ]),

        ]);

        $this->step = 3;
    }

    public function render()
    {
        return view('livewire.apply-now');
    }
}
