<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat History | Medtronix</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<style>
    .contact-list::-webkit-scrollbar {
  width: 5px;
}

.contact-list::-webkit-scrollbar-track {
  background: black !important;
}

.contact-list::-webkit-scrollbar-thumb {
  background-color: #15B4AD !important;
  border-radius: 10px;
}
.chat-messages::-webkit-scrollbar {
  width: 5px;

}

.chat-messages::-webkit-scrollbar-track {
  background: black ;
}

.chat-messages::-webkit-scrollbar-thumb {
  background-color: #15B4AD;
  border-radius: 10px;
}
.chat-online {
    color: #34ce57
}

.chat-offline {
    color: #e4606d
}

.chat-messages {
    display: flex;
    flex-direction: column;
    height: calc(100vh - 200px);
    overflow-y: scroll;
}

.chat-message-left,
.chat-message-right {
    display: flex;
    flex-shrink: 0
}

.chat-message-left {
    margin-right: auto
}

.chat-message-right {
    flex-direction: row-reverse;
    margin-left: auto
}
.py-3 {
    padding-top: 1rem!important;
    padding-bottom: 1rem!important;
}
.px-4 {
    padding-right: 1.5rem!important;
    padding-left: 1.5rem!important;
}
.flex-grow-0 {
    flex-grow: 0!important;
}
.border-top {
    border-top: 1px solid #dee2e6!important;
}
.contact-list {
  overflow-y: auto;
  /* max-height: 100vh; */
  height: calc(100vh - 40px);
}

</style>
@livewireStyles
<script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
</head>
<body>

    <main class="content mt-2" >
     @livewire('chat')
    </main>

  @livewireScripts



</body>
</html>
