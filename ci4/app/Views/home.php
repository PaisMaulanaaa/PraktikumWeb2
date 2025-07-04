<?= $this->extend('layout/simple'); ?>

<?= $this->section('content'); ?>
    <section style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 60vh; padding-top: 32px; padding-bottom: 24px; background: linear-gradient(120deg, #fff0f3 0%, #f8d7da 100%); position: relative; overflow: hidden;">
        <!-- Floating Gradient Accent -->
        <div style="position: absolute; top: -80px; left: -80px; width: 260px; height: 260px; background: radial-gradient(circle, #f8d7da 60%, #fff0f3 100%); opacity: 0.7; filter: blur(32px); z-index: 0;"></div>
        <div style="position: absolute; bottom: -100px; right: -100px; width: 320px; height: 320px; background: radial-gradient(circle, #b23b3b22 60%, #fff0f3 100%); opacity: 0.5; filter: blur(48px); z-index: 0;"></div>
        <div style="width: 100%; max-width: 900px; text-align: center; margin-bottom: 36px; position: relative; z-index: 1;">
            <h1 style="font-family: Georgia, serif; font-size: 56px; color: #b23b3b; font-weight: bold; margin-bottom: 12px; letter-spacing: 2.5px; text-shadow: 0 2px 18px #fff0f3cc, 0 1px 0 #fff;">mannarc</h1>
            <div style="font-size: 24px; color: #b23b3bcc; margin-bottom: 38px; font-family: Georgia, serif; letter-spacing: 1.2px; text-shadow: 0 1px 8px #fff0f3cc;">Media Artikel & Berita</div>
            <div style="display: flex; flex-direction: column; align-items: center; gap: 0;">
                <div style="background: linear-gradient(135deg, #fff0f3 0%, #f8d7da 100%); border-radius: 36px; padding: 44px 38px 32px 38px; box-shadow: 0 16px 48px 0 #b23b3b22, 0 2px 12px 0 #fff0f3cc; margin-bottom: 0; border: 2.5px solid #f8d7da; max-width: 900px; width: 100%; position: relative; transition: box-shadow 0.3s, border 0.3s; animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1) 0.1s both;">
                    <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
                        <h2 style="font-family: Georgia, serif; font-size: 28px; color: #b23b3b; font-weight: bold; margin: 0 0 8px 0; letter-spacing: 1.2px;">Selamat Datang di Mannarc!</h2>
                        <p style="font-size: 18px; color: #b23b3b; margin: 0 0 18px 0; font-family: Georgia, serif; max-width: 700px; text-align: justify;">Website ini hadir sebagai ruang baca yang menyuguhkan artikel-artikel pilihan dengan pendekatan informatif, reflektif, dan aktual. Kami percaya bahwa pengetahuan yang baik berasal dari bacaan yang berkualitas—itulah yang kami upayakan di setiap tulisan.</p>
                        <a href="<?= base_url('/artikel'); ?>" style="display: inline-block; background: linear-gradient(90deg, #b23b3b 60%, #f8d7da 100%); color: #fff; font-family: Georgia, serif; font-size: 20px; font-weight: bold; padding: 14px 44px; border-radius: 12px; text-decoration: none; box-shadow: 0 2px 12px #b23b3b22; transition: background 0.2s, box-shadow 0.2s, transform 0.2s; letter-spacing: 1px; border: none; animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1) 0.2s both;">Jelajahi Artikel</a>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 100%; max-width: 900px; margin-bottom: 32px; position: relative; z-index: 1;">
            <form method="get" style="display: flex; gap: 14px; justify-content: center; align-items: center; margin-bottom: 26px; background: #fff0f3cc; border-radius: 14px; box-shadow: 0 2px 12px #b23b3b11; padding: 14px 12px; border: 1.2px solid #f8d7da; animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1) 0.3s both;">
                <input type="text" name="q" value="<?= esc($q ?? ''); ?>" placeholder="Cari artikel..." style="padding: 13px; border-radius: 8px; border: 1px solid #f8d7da; width: 220px; font-family: Georgia, serif; font-size: 16px; background: #fff;">
                <select name="kategori_id" style="padding: 13px; border-radius: 8px; border: 1px solid #f8d7da; font-family: Georgia, serif; font-size: 16px; background: #fff;">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($kategori as $k): ?>
                        <option value="<?= esc($k['id_kategori']); ?>" <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>
                            <?= esc($k['nama_kategori']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" style="padding: 13px 26px; border-radius: 8px; border: none; background: linear-gradient(90deg, #b23b3b 60%, #f8d7da 100%); color: #fff; font-family: Georgia, serif; font-weight: bold; font-size: 16px; cursor: pointer; box-shadow: 0 1px 8px #b23b3b22; letter-spacing: 0.5px; transition: background 0.2s, box-shadow 0.2s, transform 0.2s; animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1) 0.4s both;">Cari</button>
            </form>
        </div>
        <h2 style="font-family: Georgia, serif; font-size: 36px; color: #b23b3b; text-align: center; margin-bottom: 34px; font-weight: bold; letter-spacing: 1.2px; text-shadow: 0 1px 8px #fff0f3cc; position: relative; z-index: 1; animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1) 0.5s both;">Artikel Terbaru</h2>
        <div style="width: 100%; max-width: 1200px; position: relative; z-index: 1;">
        <?php if (!empty($artikel)): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px; justify-content: center; align-items: stretch; margin: 0 auto;">
                <?php foreach ($artikel as $row): ?>
                    <div class="artikel-card-home" style="background: linear-gradient(120deg, #fff0f3 60%, #f8d7da 100%); border-radius: 22px; box-shadow: 0 8px 32px #b23b3b22, 0 2px 12px #fff0f3cc; overflow: hidden; border: 2.5px solid #b23b3b44; transition: box-shadow 0.25s, border 0.25s, transform 0.25s; display: flex; flex-direction: column; min-height: 360px; max-width: 400px; margin: 0 auto; padding: 0; position: relative; will-change: transform, box-shadow, border;">
                        <?php if (!empty($row['gambar'])): ?>
                            <img src="<?= base_url('/gambar/' . $row['gambar']); ?>" alt="<?= esc($row['judul']); ?>" style="width: 100%; height: 190px; object-fit: cover; border-top-left-radius: 22px; border-top-right-radius: 22px; filter: brightness(0.97) saturate(1.1);">
                        <?php endif; ?>
                        <div style="padding: 28px 24px 24px 24px; flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <h3 style="font-family: Georgia, serif; font-size: 23px; color: #b23b3b; margin-bottom: 16px; font-weight: bold; letter-spacing: 0.5px; text-shadow: 0 1px 6px #fff0f3cc;">
                                <a href="<?= base_url('/artikel/' . ($row['slug'] ?: 'artikel-' . $row['id'])); ?>" style="text-decoration: none; color: #b23b3b;"> <?= esc($row['judul']); ?> </a>
                            </h3>
                            <p style="color: #b23b3bcc; font-size: 15px; margin-bottom: 22px; font-family: Georgia, serif;">
                                <?= date('d M Y', strtotime($row['created_at'] ?? date('Y-m-d'))); ?>
                            </p>
                            <a href="<?= base_url('/artikel/' . ($row['slug'] ?: 'artikel-' . $row['id'])); ?>" style="color: #fff; background: linear-gradient(90deg, #b23b3b 60%, #f8d7da 100%); padding: 13px 28px; border-radius: 10px; text-decoration: none; font-family: Georgia, serif; font-size: 17px; font-weight: bold; box-shadow: 0 2px 12px #b23b3b22; letter-spacing: 0.5px; transition: background 0.2s, box-shadow 0.2s, transform 0.2s;">Baca Selengkapnya</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center; color: #b23b3b; font-family: Georgia, serif;">Tidak ada artikel yang cocok dengan pencarian Anda.</p>
        <?php endif; ?>
        </div>
        <style>
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .artikel-card-home:hover {
            transform: translateY(-8px) scale(1.025);
            box-shadow: 0 16px 48px #b23b3b33, 0 4px 16px #fff0f3cc;
            border-color: #b23b3bcc;
        }
        @media (max-width: 900px) {
            .artikel-card-home {
                min-width: 90vw;
                max-width: 98vw;
            }
        }
        </style>
    </section>
<?= $this->endSection(); ?>
