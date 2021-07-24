<?php

require_once "../Core/bootstrap.php";

use App\Query\ArticleQuery;
use App\Query\PageQuery;

$articleQuery = new ArticleQuery();
$pageQuery = new PageQuery();

$pages = $pageQuery->getPagesSitemap();
$articles = $articleQuery->getArticlesSitemap();

$getUrl = new \Core\Util\Url();
$url = $getUrl->getHostUrl();

header('Content-Type: text/xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>'."\n"; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

<?php

$verifTable = new \Core\Util\Table();

    if (!empty($articles) || !empty($pages)){ ?>
        <?php if ($verifTable->is_multi($pages)){
            foreach ($pages as $key => $page){ ?>
                <url>

                    <loc><?= $url . $page['url'] ?></loc>

                    <lastmod><?= $page['updated_at'] ?></lastmod>

                    <changefreq>monthly</changefreq>

                    <priority>0.8</priority>

                </url>
            <?php }
        } else{ ?>
            <url>
                <loc><?= $url . $pages['url'] ?></loc>

                <lastmod><?= $pages['updated_at'] ?></lastmod>

                <changefreq>monthly</changefreq>

                <priority>0.8</priority>
            </url>
        <?php }

        if ($verifTable->is_multi($articles)){

            foreach ($articles as $key => $article){ ?>
                <url>

                    <loc><?= $url . '/article/' . $article['slug'] ?></loc>

                    <lastmod><?= $article['updated_at'] ?></lastmod>

                    <changefreq>weekly</changefreq>

                    <priority>0.5</priority>

                </url>
            <?php }
        } else{ ?>
            <url>
                <loc><?= $url . '/article/' . $articles['slug'] ?></loc>

                <lastmod><?= $articles['updated_at'] ?></lastmod>

                <changefreq>weekly</changefreq>

                <priority>0.5</priority>
            </url>
        <?php } ?>
    <?php } ?>
</urlset>
