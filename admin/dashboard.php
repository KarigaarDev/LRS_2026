<?php
include 'db.php';
include 'partials/header.php';

/* Fetch counts safely */
$portfolio = $conn->query("SELECT COUNT(*) c FROM portfolio")->fetch_assoc()['c'] ?? 0;
$clients   = $conn->query("SELECT COUNT(*) c FROM clients")->fetch_assoc()['c'] ?? 0;
$reviews   = $conn->query("SELECT COUNT(*) c FROM reviews")->fetch_assoc()['c'] ?? 0;
$blogs     = $conn->query("SELECT COUNT(*) c FROM blogs")->fetch_assoc()['c'] ?? 0;
?>

<h2 class="mb-4">Dashboard</h2>

<!-- =======================
   STAT CARDS
======================= -->
<div class="row g-4">
<?php
$stats = [
  ['Portfolio', 'fa-briefcase', $portfolio, 'portfolio_list.php'],
  ['Clients',   'fa-users',     $clients,   'clients.php'],
  ['Reviews',   'fa-star',      $reviews,   'reviews.php'],
  ['Blogs',     'fa-pen-nib',   $blogs,     'blogs.php']
];

foreach ($stats as $s):
?>
  <div class="col-xl-3 col-md-6">
    <a href="<?= $s[3] ?>" class="card h-100 text-decoration-none">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-muted mb-1"><?= $s[0] ?></h6>
          <h2 class="count text-purple" data-target="<?= $s[2] ?>">0</h2>
        </div>
        <i class="fa-solid <?= $s[1] ?> fa-2x text-purple"></i>
      </div>
    </a>
  </div>
<?php endforeach; ?>
</div>

<!-- =======================
   CHARTS
======================= -->
<div class="row g-4 mt-4">
  <div class="col-lg-6">
    <div class="card chart-card">
      <canvas id="statsChart"></canvas>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card chart-card">
      <canvas id="monthlyChart"></canvas>
    </div>
  </div>
</div>

<!-- =======================
   SCRIPTS
======================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* Animated Counters */
document.querySelectorAll('.count').forEach(counter => {
  const target = +counter.dataset.target;
  let value = 0;
  const increment = Math.max(1, Math.ceil(target / 40));

  const update = () => {
    value += increment;
    if (value >= target) {
      counter.innerText = target;
    } else {
      counter.innerText = value;
      requestAnimationFrame(update);
    }
  };
  update();
});

/* Bar Chart */
new Chart(document.getElementById('statsChart'), {
  type: 'bar',
  data: {
    labels: ['Portfolio','Clients','Reviews','Blogs'],
    datasets: [{
      label: 'Total Records',
      data: [<?= $portfolio ?>, <?= $clients ?>, <?= $reviews ?>, <?= $blogs ?>],
      backgroundColor: '#7f5cff',
      borderRadius: 10
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: { labels: { color: '#cbd5ff' } }
    },
    scales: {
      x: {
        ticks: { color: '#cbd5ff' },
        grid: { color: 'rgba(255,255,255,0.05)' }
      },
      y: {
        ticks: { color: '#cbd5ff' },
        grid: { color: 'rgba(255,255,255,0.05)' }
      }
    }
  }
});

/* Monthly Line Chart */
new Chart(document.getElementById('monthlyChart'), {
  type: 'line',
  data: {
    labels: ['Jan','Feb','Mar','Apr','May','Jun'],
    datasets: [{
      label: 'Monthly Growth',
      data: [2,4,3,6,8,10],
      borderColor: '#7f5cff',
      backgroundColor: 'rgba(127,92,255,0.15)',
      tension: 0.4,
      fill: true,
      pointRadius: 4
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: { labels: { color: '#cbd5ff' } }
    },
    scales: {
      x: {
        ticks: { color: '#cbd5ff' },
        grid: { display: false }
      },
      y: {
        ticks: { color: '#cbd5ff' },
        grid: { color: 'rgba(255,255,255,0.05)' }
      }
    }
  }
});
</script>

<?php include 'partials/footer.php'; ?>
