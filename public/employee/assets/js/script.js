// ======== show and hide chat
document.querySelector('.chatbot-toggler').addEventListener('click', function () {
    document.body.classList.toggle('show-chatbot');
});
// ======== hide chat drop icon
document.querySelector('.drop-icon').addEventListener('click', function () {
    document.body.classList.toggle('show-chatbot');
});

const chatInput = document.querySelector('.chat-input textarea');
const sendChatBtn = document.querySelector('.chat-input span');
const chatBox = document.querySelector('.chatbox');
let userMessage;
const API_KEY = "sk-proj-wqdqrFo3uq1NFd3Yw1QoT3BlbkFJvTHpKhdWCA8BRL6qEc9w";
const inputInitHeight = chatInput.scrollHeight;

const createChatLi = (message, className) => {
    // Create a chat <li> element with the passed message and classname 
    const ChatLi = document.createElement("li");
    ChatLi.classList.add('chat', className);
    let chatContent = className === "outgoing" ? `<p></p>` : `<span>
                    <i class='bx bxs-message'></i>
                </span><p></p>`;
    ChatLi.innerHTML = chatContent;
    ChatLi.querySelector("p").textContent = message;
    return ChatLi;
}

const generateResponse = (incomingChatLi) => {
    const API_URL = "https://api.openai.com/v1/chat/completions";
    const messageElement = incomingChatLi.querySelector("p");

    const requestOptions = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${API_KEY}`
        },
        body: JSON.stringify({
            model: "gpt-3.5-turbo",
            messages: [{
                role: "user",
                content: userMessage,
            }]
        })
    }

    // Send POST request to API, get response
    fetch(API_URL, requestOptions)
        .then(res => {
            if (!res.ok) {
                throw new Error(`HTTP error! status: ${res.status}`);
            }
            return res.json();
        })
        .then(data => {
            messageElement.textContent = data.choices[0].message.content;
        })
        .catch((error) => {
            messageElement.classList.add("error");
            messageElement.textContent = "Oops! Something went wrong. Please try again.";
        })
        .finally(() => chatBox.scrollTo(0, chatBox.scrollHeight));
}

const handleChat = () => {
    userMessage = chatInput.value.trim();

    if (!userMessage) return;
    chatInput.value = "";
    chatInput.style.height = `${inputInitHeight}px`; // reset to initial height
    // Append the user message to the chat box
    chatBox.appendChild(createChatLi(userMessage, "outgoing"));
    chatBox.scrollTo(0, chatBox.scrollHeight);

    setTimeout(() => {
        // Display thinking message while waiting for the response
        const incomingChatLi = createChatLi("Thinking...", "incoming");
        chatBox.appendChild(incomingChatLi);
        chatBox.scrollTo(0, chatBox.scrollHeight);
        generateResponse(incomingChatLi);
    }, 600);
}

sendChatBtn.addEventListener('click', handleChat);

// ======== auto-resize chat input
chatInput.addEventListener('input', () => {
    chatInput.style.height = `${inputInitHeight}px`; // reset to initial height
    chatInput.style.height = `${chatInput.scrollHeight}px`; // adjust to new content height
});

chatInput.addEventListener('keydown', (e) => {
    // if enter key is pressed without shify key and the window
    // width is greater then 800px, handle the chat
    if(e.key === 'Enter' && !e.shiftKey && window.innerWidth > 800){
        e.preventDefault();
        handleChat();
    }
});
