<?php
$page_title = 'AI Barista';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <h1><i class="fas fa-robot me-2"></i>AI Barista</h1>
    <p>Ask me anything about coffee, brewing, or get a personal recommendation</p>
</div>

<section class="section">
    <div class="container" style="max-width: 800px;">
        <div class="chat-wrapper">
            <div class="chat-header">
                <div class="bot-avatar"><i class="fas fa-robot"></i></div>
                <h5 class="mb-1">Your AI Barista</h5>
                <small style="opacity:0.8;">Ask me about brewing methods, bean origins, or what to order</small>
            </div>

            <div class="chat-messages" id="chatMessages">
                <div class="message bot">
                    <div class="message-avatar"><i class="fas fa-robot"></i></div>
                    <div class="message-bubble">
                        Hi there! ☕ I'm your Green Coffee AI Barista. I can help you choose the perfect drink, explain our brewing methods, or share the story behind our beans. What are you in the mood for today?
                    </div>
                </div>
            </div>

            <div class="chat-input-area">
                <input type="text" class="chat-input" id="chatInput" placeholder="Ask for a recommendation..." onkeypress="handleKey(event)">
                <button class="btn-send" id="sendBtn" onclick="sendMessage()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>

        <div class="mt-4 p-4 bg-white rounded-4 border">
            <h6 class="mb-3 text-muted">💡 Try asking:</h6>
            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-sm btn-outline-secondary rounded-pill" onclick="quickAsk(this)">What's your strongest coffee?</button>
                <button class="btn btn-sm btn-outline-secondary rounded-pill" onclick="quickAsk(this)">I like sweet drinks</button>
                <button class="btn btn-sm btn-outline-secondary rounded-pill" onclick="quickAsk(this)">Difference between latte and cappuccino?</button>
                <button class="btn btn-sm btn-outline-secondary rounded-pill" onclick="quickAsk(this)">Best drink for cold weather?</button>
                <button class="btn btn-sm btn-outline-secondary rounded-pill" onclick="quickAsk(this)">Do you have dairy-free options?</button>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo BASE_URL; ?>/js/ai-chat.js"></script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
