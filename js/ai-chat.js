// ===== Green Coffee Shop - AI Chat JS =====

const messages = [];

function handleKey(e) { if (e.key === 'Enter') sendMessage(); }

function quickAsk(btn) {
    document.getElementById('chatInput').value = btn.textContent;
    sendMessage();
}

function appendMessage(role, text) {
    const container = document.getElementById('chatMessages');
    const div = document.createElement('div');
    div.className = 'message ' + (role === 'user' ? 'user' : 'bot');
    div.innerHTML = `
        <div class="message-avatar"><i class="fas fa-${role === 'user' ? 'user' : 'robot'}"></i></div>
        <div class="message-bubble">${text.replace(/\n/g, '<br>')}</div>
    `;
    container.appendChild(div);
    container.scrollTop = container.scrollHeight;
}

function showTyping() {
    const container = document.getElementById('chatMessages');
    const div = document.createElement('div');
    div.className = 'message bot'; div.id = 'typingIndicator';
    div.innerHTML = `<div class="message-avatar"><i class="fas fa-robot"></i></div>
        <div class="message-bubble"><div class="typing-indicator">
            <div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div>
        </div></div>`;
    container.appendChild(div);
    container.scrollTop = container.scrollHeight;
}

function removeTyping() {
    const t = document.getElementById('typingIndicator');
    if (t) t.remove();
}

async function sendMessage() {
    const input = document.getElementById('chatInput');
    const sendBtn = document.getElementById('sendBtn');
    const text = input.value.trim();
    if (!text) return;
    input.value = ''; input.disabled = true; sendBtn.disabled = true;
    appendMessage('user', text);
    messages.push({ role: 'user', content: text });
    showTyping();
    try {
        const res = await fetch(BASE_URL + '/api/ai-chat.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ messages })
        });
        const data = await res.json();
        removeTyping();
        if (data.reply) {
            appendMessage('bot', data.reply);
            messages.push({ role: 'assistant', content: data.reply });
        } else {
            appendMessage('bot', '⚠️ ' + (data.error || 'Something went wrong.'));
        }
    } catch (e) {
        removeTyping();
        appendMessage('bot', '⚠️ Could not connect. Make sure XAMPP is running.');
    }
    input.disabled = false; sendBtn.disabled = false; input.focus();
}
