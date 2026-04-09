    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const toggleBtn = document.getElementById('themeToggle');
const htmlBody = document.body;

// Load saved theme
const savedTheme = localStorage.getItem('admin-theme');
if (savedTheme) {
  htmlBody.setAttribute('data-bs-theme', savedTheme);
  updateIcon(savedTheme);
}

toggleBtn.addEventListener('click', () => {
  const currentTheme = htmlBody.getAttribute('data-bs-theme');
  const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

  htmlBody.setAttribute('data-bs-theme', newTheme);
  localStorage.setItem('admin-theme', newTheme);
  updateIcon(newTheme);
});

function updateIcon(theme) {
  htmlBody.style.color = theme === 'dark' ? '#fff' : '#111';
  toggleBtn.innerHTML = theme === 'dark'
    ? '<i class="fa-solid fa-moon"></i> Dark Mode'
    : '<i class="fa-solid fa-sun"></i> Light Mode';
}
</script>

</body>
</html>

