<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Blog' ?></title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; max-width: 800px; margin: 40px auto; padding: 0 20px; color: #333; }
        h1 { color: #2c3e50; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .post { background: #f9f9f9; padding: 15px; margin-bottom: 10px; border-left: 5px solid #3498db; }
        .post h3 { margin-top: 0; }
        a { color: #3498db; text-decoration: none; font-weight: bold; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <h1><?= $title ?></h1>
    <p>NexRouter ile güçlendirilmiş blog sayfasına hoş geldiniz!</p>

    <?php if(!empty($yazilar)): ?>
        <?php foreach($yazilar as $id => $yazi): ?>
            <div class="post">
                <h3><?= $yazi['baslik'] ?></h3>
                <a href="/nex-router/public/yazi/<?= $id ?>">Devamını Oku →</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Henüz yazı eklenmemiş.</p>
    <?php endif; ?>

</body>
</html>