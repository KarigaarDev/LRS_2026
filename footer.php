
<footer class="footer">

    <!-- EXTRA LINK BAR -->
    <div class="footer-links-bar">
        <div class="footer-links-container">
            <a href="/">Home</a>
            <a href="/terms-and-conditions">Terms & Conditions</a>
            <a href="/privacy-policy">Privacy Policy</a>
            <a href="/about-contact">Contact</a>
        </div>
    </div>

    <!-- COPYRIGHT -->
    <div class="footer-bottom">
        <p>
            © <?= date('Y') ?> Living Room Storiez | Design by 
            <a href="https://numindstech.com/" target="_blank" rel="noopener">Numindstech</a>
        </p>
    </div>

</footer>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
<!-- Your main JS -->
<script src="<?= asset('assets/js/main.js') ?>"></script>


<script>
document.addEventListener('click', function(e){
    const card = e.target.closest('.portfolio-card');
    if(!card) return;

    window.dataLayer.push({
        event: 'portfolio_click',
        portfolio_id: card.dataset.portfolioId,
        category: card.dataset.category
    });
});
</script>
<script>
document.addEventListener('click', function (e) {
  const btn = e.target.closest('[data-event="hero_cta_click"]');
  if (!btn) return;

  if (typeof gtag === 'function') {
    gtag('event', 'hero_cta_click', {
      event_category: 'conversion_intent',
      event_label: btn.dataset.location || 'unknown'
    });
  }
});
</script>
<script>
function trackEvent(eventName, meta = {}) {
    fetch('./api/track-event.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            event: eventName,
            page: window.location.pathname,
            meta: meta
        })
    }).catch(() => {});
}
</script>


</body>
</html>
