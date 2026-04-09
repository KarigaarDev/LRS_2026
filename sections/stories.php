<?php
include 'db.php';

/* ===============================
   FETCH ACTIVE STORIES FROM DB
================================ */
$allowedPosts = [];
$allowedCategories = [];

$res = $conn->query("
    SELECT wp_post_id, wp_category_id, is_featured
    FROM story_controls
    WHERE is_active = 1
    ORDER BY is_featured DESC, created_at DESC
");

while ($row = $res->fetch_assoc()) {

    $postId = (int) $row['wp_post_id'];
    $catId  = (int) $row['wp_category_id'];

    // map posts → meta
    $allowedPosts[$postId] = [
        'is_featured' => (int) $row['is_featured'],
        'category'    => $catId
    ];

    // collect unique categories
    if ($catId > 0) {
        $allowedCategories[$catId] = true;
    }
}

/* ✅ arrays only — no implode errors */
$postIds = array_keys($allowedPosts);
$catIds  = array_keys($allowedCategories);
?>


<section class="stories-section" id="stories">
    <h2 class="stories-title section-title">Our Stories</h2>

    <!-- CATEGORY FILTER -->
    <div class="stories-filters" id="storyFilters">
        <button class="active" data-cat="all">All</button>

       <?php if (!empty($catIds)): 
    $cat_api = "https://livingroomstoriez.co.in/wp-json/wp/v2/categories?include=" . implode(',', $catIds);
    $cats = json_decode(@file_get_contents($cat_api), true);
    foreach ($cats as $cat):
?>

            <button data-cat="<?= $cat['id'] ?>">
                <?= htmlspecialchars($cat['name']) ?>
            </button>
        <?php endforeach; endif; ?>
    </div>

    <!-- GRID -->
    <div class="stories-grid" id="storiesGrid"></div>

    <!-- LOAD MORE -->
    <div class="text-center mt-5">
        <button id="loadMoreStories" class="btn btn-primary px-5">
            Load More
        </button>
    </div>
</section>


<style>
/* ================= STORIES ================= */
.stories-section {
    background: #000;
    padding: 90px 20px;
    text-align: center;
}
.stories-title {
    color: #fff;
    font-size: 34px;
    margin-bottom: 40px;
    font-family: 'Playfair Display', serif;
}

/* FILTERS */
.stories-filters button {
    background: rgba(255,255,255,.18);
    border: none;
    color: #fff;
    padding: 10px 24px;
    margin: 6px;
    border-radius: 30px;
    cursor: pointer;
}
.stories-filters button.active {
    background: #fff;
    color: #5a3f79;
}

/* GRID */
.stories-grid {
    display: grid;
    gap: 30px;
    max-width: 1400px;
    margin: auto;
}
@media (min-width: 1024px) { .stories-grid { grid-template-columns: repeat(4,1fr);} }
@media (min-width: 768px) and (max-width:1023px){ .stories-grid{grid-template-columns:repeat(3,1fr);} }
@media (max-width:767px){ .stories-grid{grid-template-columns:repeat(2,1fr);} }

/* CARD */
.story-card {
    background: #fff;
    border-radius: 22px;
    overflow: hidden;
    text-align: left;
    box-shadow: 0 15px 40px rgba(0,0,0,.45);
    transition: transform .3s ease;
    position: relative;
}
.story-card:hover { transform: translateY(-8px); }

/* FEATURED */
.story-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    background: gold;
    padding: 4px 12px;
    font-size: 12px;
    font-weight: 700;
    border-radius: 20px;
    z-index: 2;
}

/* IMAGE */
.story-img { height: 220px; overflow: hidden; }
.story-img img { width: 100%; height: 100%; object-fit: cover; }

/* CONTENT */
.story-content { padding: 20px; }
.story-content h3 { font-size: 17px; margin-bottom: 8px; }
.story-content p { font-size: 14px; color: #555; }
.story-link { font-weight: 600; color: #4f6df5; }

</style>

<script>
const allowedPosts = <?= json_encode($allowedPosts) ?>;

let allStories = [];
let visibleCount = 0;
let perPage = getPerPage();
let currentCategory = 'all';

/* RESPONSIVE COUNT */
function getPerPage() {
    if (window.innerWidth < 768) return 4;
    if (window.innerWidth < 1024) return 6;
    return 8;
}

/* FETCH ALL ACTIVE STORIES ONCE */
function fetchAllStories() {
    const ids = Object.keys(allowedPosts).join(',');
    if (!ids) return;

    const url = `https://livingroomstoriez.co.in/wp-json/wp/v2/posts?_embed&include=${ids}&per_page=100`;

    fetch(url)
        .then(res => res.json())
        .then(data => {
            allStories = data;
            renderStories(true);
        });
}

/* FILTER STORIES */
function getFilteredStories() {
    if (currentCategory === 'all') return allStories;
    return allStories.filter(p =>
        p.categories.includes(parseInt(currentCategory))
    );
}

/* RENDER */
function renderStories(reset = false) {
    const grid = document.getElementById('storiesGrid');
    if (reset) {
        grid.innerHTML = '';
        visibleCount = 0;
    }

    const stories = getFilteredStories();
    const slice = stories.slice(visibleCount, visibleCount + perPage);

    slice.forEach(post => {
        const meta = allowedPosts[post.id];
        if (!meta) return;

        const img = post._embedded?.['wp:featuredmedia']?.[0]?.source_url || '';

        const card = document.createElement('div');
        card.className = 'story-card';
        card.innerHTML = `
            ${meta.is_featured ? '<span class="story-badge">⭐ Featured</span>' : ''}
            <a href="${post.link}" target="_blank" data-story="${post.id}">
                <div class="story-img">
                    <img src="${img}">
                </div>
                <div class="story-content">
                    <h3>${post.title.rendered}</h3>
                    <p>${post.excerpt.rendered.replace(/<[^>]*>/g,'').slice(0,100)}...</p>
                    <span class="story-link">Read More →</span>
                </div>
            </a>
        `;
        grid.appendChild(card);
    });

    visibleCount += perPage;

    document.getElementById('loadMoreStories').style.display =
        visibleCount >= stories.length ? 'none' : 'inline-block';
}

/* CATEGORY FILTER */
document.querySelectorAll('#storyFilters button').forEach(btn => {
    btn.onclick = () => {
        document.querySelectorAll('#storyFilters button')
            .forEach(b => b.classList.remove('active'));

        btn.classList.add('active');
        currentCategory = btn.dataset.cat;
        renderStories(true);
    };
});

/* LOAD MORE */
document.getElementById('loadMoreStories').onclick = () => {
    renderStories();
};

/* CLICK TRACK */
document.addEventListener('click', e => {
    const a = e.target.closest('[data-story]');
    if (a) {
        fetch('track-story.php', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: 'id=' + a.dataset.story
        });
    }
});

/* INIT */
document.addEventListener('DOMContentLoaded', fetchAllStories);
</script>

