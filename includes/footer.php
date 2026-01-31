</div> <!-- Close container from header -->

    <footer class="mt-auto py-3 border-top bg-white text-center">
        <div class="container">
            <p class="text-muted small mb-0 translate-me">&copy; <?php echo date('Y'); ?> CowCare Management</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Use the same API Key for Translation and AI
        const apiKey = "AIzaSyB0Ufs0CMfISMsFfuGvyJq4xSOHEknOWjs"; 
        
        let currentLang = sessionStorage.getItem('app_lang') || 'en';
        const translationCache = JSON.parse(sessionStorage.getItem('trans_cache') || '{}');

        // Logic for Language Toggle UI
        function updateBtnStyles() {
            const e = document.getElementById('btn-en');
            const m = document.getElementById('btn-mr');
            if(!e || !m) return;
            if(currentLang === 'en') {
                e.classList.replace('btn-dark', 'btn-primary');
                m.classList.replace('btn-primary', 'btn-dark');
            } else {
                m.classList.replace('btn-dark', 'btn-primary');
                e.classList.replace('btn-primary', 'btn-dark');
            }
        }

        function setLanguage(l) {
            sessionStorage.setItem('app_lang', l);
            location.reload();
        }

        // Global AI Translation Engine (Flash 2.5)
        async function runTranslation() {
            if(currentLang === 'en' || !apiKey) return;

            const loader = document.getElementById('translate-loader');
            if(loader) loader.style.display = 'block';

            const targets = document.querySelectorAll('.translate-me, h2, h3, h4, h5, label, .list-group-item, .btn, .alert, p, th, td, option');
            const texts = [];
            const nodes = [];

            targets.forEach(node => {
                const t = node.innerText.trim();
                if(t && t.length > 1 && isNaN(t) && !translationCache[t]) texts.push(t);
                nodes.push({node, original: t});
            });

            if(texts.length > 0) {
                try {
                    const prompt = `Translate list to Marathi. Dairy farm context. Output JSON only: {"English": "Marathi"}`;
                    const res = await fetch(`https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-preview-09-2025:generateContent?key=${apiKey}`, {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({
                            contents: [{parts: [{text: JSON.stringify(texts)}]}],
                            systemInstruction: {parts: [{text: prompt}]},
                            generationConfig: {responseMimeType: "application/json"}
                        })
                    });
                    const data = await res.json();
                    let raw = data.candidates[0].content.parts[0].text;
                    const parsed = JSON.parse(raw.replace(/```json/g, '').replace(/```/g, '').trim());
                    Object.assign(translationCache, parsed);
                    sessionStorage.setItem('trans_cache', JSON.stringify(translationCache));
                } catch(err) { console.error("Trans Error", err); }
            }

            nodes.forEach(item => {
                if(translationCache[item.original]) item.node.innerText = translationCache[item.original];
            });

            // Input Placeholders
            document.querySelectorAll('input[placeholder]').forEach(i => {
                const p = i.getAttribute('placeholder');
                if(translationCache[p]) i.setAttribute('placeholder', translationCache[p]);
            });

            if(loader) loader.style.display = 'none';
        }

        window.onload = () => {
            updateBtnStyles();
            if(currentLang === 'mr') runTranslation();
        };
    </script>
</body>
</html>