<?= $this->extend('layout/simple'); ?>

<?= $this->section('content'); ?>
    <div style="max-width: 700px; margin: 40px auto 0 auto; background: linear-gradient(120deg, #fff0f3 0%, #f8d7da 100%); border-radius: 24px; box-shadow: 0 8px 32px #b23b3b22, 0 2px 12px #fff0f3cc; padding: 48px 36px 36px 36px; border: 2px solid #b23b3b22; text-align: center;">
        <h1 style="font-size: 36px; font-family: Georgia, serif; font-weight: bold; color: #b23b3b; letter-spacing: 2px; text-shadow: 0 2px 12px #fff0f3cc; margin-bottom: 18px;"><?= esc($title); ?></h1>
        <div style="height: 3px; width: 60px; background: #b23b3b33; border-radius: 2px; margin: 0 auto 24px auto;"></div>
        <p style="font-size: 18px; color: #374151; font-family: Georgia, serif; text-align: justify; line-height: 1.7; margin-bottom: 0;"><?= esc($content); ?></p>
    </div>
<?= $this->endSection(); ?>
