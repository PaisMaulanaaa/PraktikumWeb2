<?= $this->extend('layout/simple'); ?>

<?= $this->section('content'); ?>
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="font-size: 40px; font-family: Georgia, serif; font-weight: bold; color: #b23b3b; letter-spacing: 2px; text-shadow: 0 2px 12px #fff0f3cc; margin-bottom: 10px;"><?= esc($title); ?></h1>
        <p style="color: #b23b3bcc; font-size: 20px; font-family: Georgia, serif;">Temukan artikel menarik dan informatif dari kami.</p>
    </div>

    <?php if (!empty($artikel)): ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 36px; justify-content: center; align-items: stretch; margin: 0 auto; max-width: 1200px;">
            <?php foreach ($artikel as $row): ?>
                <div class="artikel-card-daftar" style="background: linear-gradient(120deg, #fff0f3 60%, #f8d7da 100%); border-radius: 20px; box-shadow: 0 8px 32px #b23b3b22, 0 2px 12px #fff0f3cc; overflow: hidden; border: 2px solid #b23b3b33; transition: box-shadow 0.25s, border 0.25s, transform 0.25s; display: flex; flex-direction: column; min-height: 340px; max-width: 400px; margin: 0 auto; padding: 0; position: relative; will-change: transform, box-shadow, border;">
                    <?php if (!empty($row['gambar'])): ?>
                        <img src="<?= base_url('/gambar/' . $row['gambar']); ?>" alt="<?= esc($row['judul']); ?>" style="width: 100%; height: 170px; object-fit: cover; border-top-left-radius: 20px; border-top-right-radius: 20px; filter: brightness(0.97) saturate(1.1);">
                    <?php endif; ?>
                    <div style="padding: 24px 20px 20px 20px; flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <p style="color: #b23b3b; font-weight: bold; margin-bottom: 10px; font-family: Georgia, serif; font-size: 15px; letter-spacing: 1px;">Kategori: <?= esc($row['nama_kategori'] ?? 'N/A'); ?></p>
                        <h2 style="font-size: 22px; font-family: Georgia, serif; font-weight: bold; margin-bottom: 10px; color: #b23b3b; letter-spacing: 0.5px; text-shadow: 0 1px 6px #fff0f3cc;">
                            <a href="<?= base_url('/artikel/' . ($row['slug'] ?: 'artikel-' . $row['id'])); ?>" style="text-decoration: none; color: #b23b3b;"> <?= esc($row['judul']); ?> </a>
                        </h2>
                        <p style="color: #b23b3bcc; font-size: 14px; margin-bottom: 16px; font-family: Georgia, serif;">
                            <?= date('d M Y', strtotime($row['created_at'] ?? date('Y-m-d'))); ?>
                        </p>
                        <p style="color: #374151; font-size: 15px; margin-bottom: 18px; font-family: Georgia, serif; line-height: 1.5;"> <?= esc(substr(strip_tags($row['isi'] ?? ''), 0, 100)); ?>...</p>
                        <a href="<?= base_url('/artikel/' . ($row['slug'] ?: 'artikel-' . $row['id'])); ?>" style="color: #fff; background: linear-gradient(90deg, #b23b3b 60%, #f8d7da 100%); padding: 10px 22px; border-radius: 8px; text-decoration: none; font-family: Georgia, serif; font-size: 15px; font-weight: bold; box-shadow: 0 1px 8px #b23b3b22; letter-spacing: 0.5px; transition: background 0.2s, box-shadow 0.2s, transform 0.2s;">Baca Selengkapnya</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <style>
        .artikel-card-daftar:hover {
            transform: translateY(-8px) scale(1.025);
            box-shadow: 0 16px 48px #b23b3b33, 0 4px 16px #fff0f3cc;
            border-color: #b23b3bcc;
        }
        @media (max-width: 900px) {
            .artikel-card-daftar {
                min-width: 90vw;
                max-width: 98vw;
            }
        }
        </style>
    <?php else: ?>
        <p style="text-align: center; color: #b23b3b; font-family: Georgia, serif;">Belum ada artikel.</p>
    <?php endif; ?>

<?= $this->endSection(); ?>
