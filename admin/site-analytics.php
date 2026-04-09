<?php
include 'db.php';
include 'partials/header.php';

/* ===========================
   FETCH ANALYTICS COUNTS
=========================== */
$stats = [
  'page_view'            => 0,
  'project_form_submit'  => 0,
  'project_modal_open'   => 0,
  'whatsapp_click'       => 0,
  'social_click'         => 0
];

$q = $conn->query("
  SELECT event_name, COUNT(*) c
  FROM analytics_events
  GROUP BY event_name
");

while ($r = $q->fetch_assoc()) {
  if (isset($stats[$r['event_name']])) {
    $stats[$r['event_name']] = $r['c'];
  }
}

/* ===========================
   TOP PAGES
=========================== */
$topPages = $conn->query("
  SELECT page, COUNT(*) c
  FROM analytics_events
  WHERE event_name='page_view'
  GROUP BY page
  ORDER BY c DESC
  LIMIT 5
");

/* ===========================
   LAST 7 DAYS TRAFFIC
=========================== */
$days = [];
$views = [];

$res = $conn->query("
  SELECT DATE(created_at) d, COUNT(*) c
  FROM analytics_events
  WHERE event_name='page_view'
  AND created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
  GROUP BY d
  ORDER BY d
");

while ($row = $res->fetch_assoc()) {
  $days[]  = date('D', strtotime($row['d']));
  $views[] = $row['c'];
}
?>

<h2 class="mb-4">Analytics Dashboard</h2>

<!-- =======================
   STAT CARDS
======================= -->
<div class="row g-4">
<?php
$cards = [
  ['Page Views', 'fa-eye', $stats['page_view']],
  ['Leads', 'fa-paper-plane', $stats['project_form_submit']],
  ['Modal Opens', 'fa-window-maximize', $stats['project_modal_open']],
  ['WhatsApp Clicks', 'fab fa-whatsapp', $stats['whatsapp_click']],
  ['Social Clicks', 'fa-share-nodes', $stats['social_click']]
];

foreach ($cards as $c):
?>
  <div class="col-xl-2 col-md-6">
    <div class="card h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-muted mb-1"><?= $c[0] ?></h6>
          <h2 class="count text-purple" data-target="<?= $c[2] ?>">0</h2>
        </div>
        <i class="fa-solid <?= $c[1] ?> fa-2x text-purple"></i>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>

<!-- =======================
   CHARTS
======================= -->
<div class="row g-4 mt-4">

  <div class="col-lg-6">
    <div class="card chart-card">
      <h6 class="text-muted mb-3">Conversion Funnel</h6>
      <canvas id="funnelChart"></canvas>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card chart-card">
      <h6 class="text-muted mb-3">Last 7 Days Traffic</h6>
      <canvas id="trafficChart"></canvas>
    </div>
  </div>

</div>

<!-- =======================
   TOP PAGES
======================= -->
<div class="card mt-4">
  <div class="card-body">
    <h6 class="text-muted mb-3">Top Pages</h6>
    <table class="table table-dark table-hover mb-0">
      <thead>
        <tr>
          <th>Page</th>
          <th>Views</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($p = $topPages->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($p['page']) ?></td>
          <td><?= $p['c'] ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- =======================
   SCRIPTS
======================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* Animated counters */
document.querySelectorAll('.count').forEach(counter => {
  const target = +counter.dataset.target;
  let val = 0;
  const step = Math.max(1, Math.ceil(target / 40));
  const tick = () => {
    val += step;
    if (val >= target) counter.innerText = target;
    else {
      counter.innerText = val;
      requestAnimationFrame(tick);
    }
  };
  tick();
});

/* Funnel Chart */
new Chart(document.getElementById('funnelChart'), {
  type: 'bar',
  data: {
    labels: ['Page Views', 'Modal Opens', 'Leads'],
    datasets: [{
      data: [
        <?= $stats['page_view'] ?>,
        <?= $stats['project_modal_open'] ?>,
        <?= $stats['project_form_submit'] ?>
      ],
      backgroundColor: '#7f5cff',
      borderRadius: 12
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } },
    scales: {
      x: { ticks: { color: '#cbd5ff' } },
      y: { ticks: { color: '#cbd5ff' } }
    }
  }
});

/* Traffic Line Chart */
new Chart(document.getElementById('trafficChart'), {
  type: 'line',
  data: {
    labels: <?= json_encode($days) ?>,
    datasets: [{
      label: 'Page Views',
      data: <?= json_encode($views) ?>,
      borderColor: '#7f5cff',
      backgroundColor: 'rgba(127,92,255,0.15)',
      fill: true,
      tension: 0.4,
      pointRadius: 4
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { labels: { color: '#cbd5ff' } }
    },
    scales: {
      x: { ticks: { color: '#cbd5ff' } },
      y: { ticks: { color: '#cbd5ff' } }
    }
  }
});
</script>

<?php include 'partials/footer.php'; ?>
