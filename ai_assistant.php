<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include "includes/header.php";
?>

<style>
    /* Responsive Chat Layout */
    .ai-chat-wrapper {
        max-width: 900px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        height: calc(100vh - 180px); /* Adjust based on navbar height */
        min-height: 450px;
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        overflow: hidden;
    }

    #chat-log {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
        background-color: #fdfdfd;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .chat-bubble {
        max-width: 85%;
        padding: 10px 14px;
        border-radius: 15px;
        font-size: 0.95rem;
        line-height: 1.4;
        word-wrap: break-word;
    }

    .bubble-ai {
        align-self: flex-start;
        background-color: #f1f3f5;
        color: #212529;
        border-bottom-left-radius: 2px;
        border-left: 4px solid #0d6efd;
    }

    .bubble-user {
        align-self: flex-end;
        background-color: #0d6efd;
        color: #ffffff;
        border-bottom-right-radius: 2px;
    }

    .chat-input-container {
        padding: 15px;
        background: #fff;
        border-top: 1px solid #eee;
    }

    .thinking-text {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 5px;
        display: none;
    }

    @media (max-width: 576px) {
        .ai-chat-wrapper {
            height: calc(100vh - 220px);
            border-radius: 8px;
        }
        .chat-bubble {
            max-width: 90%;
            font-size: 0.88rem;
        }
        .chat-input-container {
            padding: 10px;
        }
        .btn-ask {
            padding-left: 12px;
            padding-right: 12px;
        }
    }
</style>

<div class="ai-chat-wrapper shadow-sm">
    <!-- Header -->
    <div class="p-3 bg-primary text-white d-flex align-items-center justify-content-between">
        <h5 class="mb-0 d-flex align-items-center">
            <span class="me-2">🤖</span>
            <span class="translate-me">AI Cattle Assistant</span>
        </h5>
    </div>

    <!-- Chat Logs -->
    <div id="chat-log">
        <div class="chat-bubble bubble-ai">
            <span class="translate-me">Hello! I'm your CowCare AI. Ask me anything about cow health or feeding. (English/Marathi)</span>
        </div>
    </div>

    <!-- Input Area -->
    <div class="chat-input-container">
        <div id="ai-status" class="thinking-text translate-me">Analyzing your query...</div>
        <div class="input-group">
            <input type="text" id="ai-query-field" class="form-control border-primary" 
                   placeholder="Type problem here..." 
                   autocomplete="off">
            <button class="btn btn-primary btn-ask" id="ai-submit-btn">
                <span class="translate-me">Ask AI</span>
            </button>
        </div>
        <div class="mt-2 text-center d-none d-sm-block">
            <small class="text-muted translate-me">Example: "My cow has a fever" or "गायीचे दूध वाढवण्यासाठी उपाय"</small>
        </div>
    </div>
</div>

<div class="text-center mt-3">
    <a href="dashboard.php" class="btn btn-sm btn-outline-secondary translate-me">← Back to Dashboard</a>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const log = document.getElementById('chat-log');
    const input = document.getElementById('ai-query-field');
    const btn = document.getElementById('ai-submit-btn');
    const status = document.getElementById('ai-status');

    // Make sure your API key is pasted in includes/footer.php or here
    const apiKey = "AIzaSyB0Ufs0CMfISMsFfuGvyJq4xSOHEknOWjs"; 

    async function callGemini(text) {
        if (!apiKey) return "API Key is missing.";
        const systemMsg = "Expert Cattle Assistant. Safe, practical farm advice. Respond in user's language.";
        try {
            const res = await fetch(`https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-preview-09-2025:generateContent?key=${apiKey}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    contents: [{ parts: [{ text }] }],
                    systemInstruction: { parts: [{ text: systemMsg }] }
                })
            });
            const data = await res.json();
            return data.candidates[0].content.parts[0].text;
        } catch (e) {
            return "Connection error. Try again.";
        }
    }

    function addMessage(text, role) {
        const div = document.createElement('div');
        div.className = `chat-bubble bubble-${role}`;
        div.innerText = text;
        log.appendChild(div);
        log.scrollTop = log.scrollHeight;
    }

    async function send() {
        const val = input.value.trim();
        if (!val) return;
        input.value = '';
        addMessage(val, 'user');
        status.style.display = 'block';
        btn.disabled = true;
        const reply = await callGemini(val);
        status.style.display = 'none';
        btn.disabled = false;
        addMessage(reply, 'ai');
    }

    btn.onclick = send;
    input.onkeypress = (e) => { if(e.key === 'Enter') send(); };
});
</script>

<?php include "includes/footer.php"; ?>