<section class="stories-section">
    <h2 class="stories-title">Our Stories</h2>

    <div class="stories-grid">

        <?php
        $wp_api = "https://livingroomstoriez.co.in/wp-json/wp/v2/posts?_embed&per_page=8";
        $response = @file_get_contents($wp_api);

        if ($response):
            $posts = json_decode($response, true);

            foreach ($posts as $post):

                $title   = $post['title']['rendered'];
                $excerpt = strip_tags($post['excerpt']['rendered']);
                $link    = $post['link'];

                $image = $post['_embedded']['wp:featuredmedia'][0]['source_url']
                         ?? 'assets/images/placeholder.jpg';
        ?>

        <article class="story-card">
            <a href="<?= $link ?>" target="_blank" rel="noopener">

                <div class="story-img">
                    <img src="<?= $image ?>" alt="<?= htmlspecialchars($title) ?>" loading="lazy">
                </div>

                <div class="story-content">
                    <h3><?= $title ?></h3>
                    <p><?= mb_strimwidth($excerpt, 0, 110, '...') ?></p>
                    <span class="story-link">Read More →</span>
                </div>

            </a>
        </article>

        <?php
            endforeach;
        endif;
        ?>

    </div>
</section>
<style>
    /* ===== STORIES SECTION ===== */
.stories-section {
    background: #000;
    padding: 90px 0 70px;
    text-align: center;
}

.stories-title {
    color: #fff;
    font-size: 34px;
    margin-bottom: 50px;
    font-family: 'Playfair Display', serif;
}

/* GRID */
.stories-grid {
    max-width: 1400px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
    padding: 0 30px;
}

/* CARD */
.story-card {
    background: rgba(255,255,255,0.95);
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,.45);
    transition: transform .35s ease, box-shadow .35s ease;
    text-align: left;
}

.story-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 60px rgba(0,0,0,.6);
}

/* IMAGE */
.story-img {
    height: 220px;
    overflow: hidden;
}

.story-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .6s ease;
}

.story-card:hover img {
    transform: scale(1.08);
}

/* CONTENT */
.story-content {
    padding: 22px 24px 26px;
}

.story-content h3 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #111;
}

.story-content p {
    font-size: 14px;
    color: #555;
    line-height: 1.6;
    margin-bottom: 18px;
}

.story-link {
    font-weight: 600;
    font-size: 14px;
    color: #4f6df5;
}

/* REMOVE LINK STYLES */
.story-card a {
    text-decoration: none;
    color: inherit;
}

/* RESPONSIVE */
@media (max-width: 1024px) {
    .stories-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-width: 640px) {
    .stories-grid {
        grid-template-columns: 1fr;
    }

    .story-img {
        height: 190px;
    }
}

</style>
