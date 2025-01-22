<div>
    <style>
        .chat.incoming {
            text-align: left;
            margin-left: auto;
        }

        .chat.outgoing {
            text-align: right;
            margin-right: auto;
        }
    </style>
    <button class="chatbot-toggler">
        <i class="bx bx-message-rounded"></i>
        <i class="bx bx-x"></i>
    </button>
    <div class="chatbot">
        <header>
            <h6 class="font-weight-bold">
                <img src="{{ url('assets/images/Medtronix/medtronix-chat.png') }}" alt="" class="img-fluid"
                    style="max-width: 60px;">
                MEDTRONIX SYSTEMS
                <sup style="font-size: 10px">TM</sup>
            </h6>
            <span><i class="bx bx-chevron-down drop-icon"></i></span>
        </header>
        @if ($boxStep <4)
        <div class="card card-body d-flex justify-content-center" style="height: 400px;">
            @if ($boxStep == 1)
            <div id="step-1">
                <h6>Hello! 🤖  <br>   Welcome to MEDTRONIX SYSTEMS <br> It is a pleasure for me to be able to assist you!</h6>
                <button type="button" wire:click='nextStep(2)' class="btn btn-primary btn-block">Next <i
                        class="fa fa-arrow-right ms-1" aria-hidden="true"></i></button>
            </div>

            @elseif ($boxStep == 2)
            <div >
                <h6>To Talk with our Experts Enter Your Valid Details.</h6>
                @if($userMessage!=="") <p class="text-danger">{{$userMessage}}</p> @endif
                <input type="text" wire:model='userNameBox'   class="form-control" placeholder="Name">
                @error('userNameBox')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="email" wire:model='userEmailBox' class="form-control my-2" placeholder="Email">
                @error('userEmailBox')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <button wire:click='nextStep(3)' type="button"  class="btn btn-primary mb-2 btn-block">Next<i
                        class="fa fa-arrow-right ms-1" aria-hidden="true"></i></button>
            </div>
            @elseif($boxStep == 3)

            <div id="" >
                <h6>Select your Product</h6> <br>
                <div class="row">
                    <div class="col-12">
                        <input wire:model="selectedProduct" type="radio" value="service" name="service" class="onoffswitch-checkbox" id="product_1"
                            checked="checked" />
                        <label for="product_1">Services</label>
                    </div>
                    <div class="col-12">
                        <input wire:model="selectedProduct" type="radio" value="job" name="service" class="onoffswitch-checkbox" id="product_2" />
                        <label for="product_2">Job</label>
                    </div>
                    <div class="col-12">
                        <input wire:model="selectedProduct" type="radio" value="courses" name="service" class="onoffswitch-checkbox"
                            id="product_3" />
                        <label for="product_3">Courses</label>
                    </div>
                </div>
                <button wire:click='nextStep(4)' type="button"  class="btn btn-primary mb-2 btn-block">Next<i
                        class="fa fa-arrow-right ms-1" aria-hidden="true"></i></button>
            </div>
            @endif



        </div>
        @endif
        @if ($boxStep == 4)
        <ul class="chatbox otherChatbox" id="chatbox">
            <li class="chat incoming mt-1">
                <img src="{{ url('assets/images/Medtronix/chat-logo.png') }}" alt="" class="img-fluid mr-2"
                    style="width: 30px; height: 30px;">
                <p>Hi there <br />how can I help you today?</p>
            </li>
            @foreach ($userChatOnly as $message)
            @if($message->is_admin==1)
            <li class="chat incoming mt-1">
                <img src="{{ url('assets/images/Medtronix/chat-logo.png') }}" alt="" class="img-fluid mr-2"
                    style="width: 30px; height: 30px;">
                <p>{{$message->message}}</p>
            </li>
            @else
            <li class="chat outgoing mt-1">

                <p  style="text-align: left">{{$message->message}}</p>
            </li>
            @endif
            @endforeach


        </ul>

        <div class="chat-input">
            <textarea id="message-input" wire:model='userMessage' placeholder="Enter a message..." autofocus></textarea>
            <span id="send-btn" wire:click='store'><i class="bx bxs-send" o></i></span>
        </div>
        @endif

    </div>
</div>
@if ($boxStep == 4)
<script>
    setInterval(() => {
       // console.log('chatWithD');
        Livewire.dispatch('chatWithData', {});
    }, 3000);
</script>
@endif
