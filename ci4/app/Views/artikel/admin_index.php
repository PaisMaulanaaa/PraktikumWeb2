<?= $this->include('template/admin_header'); ?>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
    <h2 style="font-size: 32px; font-family: 'Inter', sans-serif; font-weight: bold; color: #b23b3b; letter-spacing: 2px; text-shadow: 0 2px 12px #fff0f3cc; margin: 0;">Daftar Artikel</h2>
    <a href="<?= base_url('/admin/artikel/add'); ?>" class="btn btn-success" style="font-family: 'Inter', sans-serif; font-weight: bold; font-size: 16px; letter-spacing: 1px; background: linear-gradient(90deg, #b23b3b 60%, #f8d7da 100%); border: none; box-shadow: 0 2px 8px #b23b3b22;">Tambah Artikel</a>
</div>
<form method="get" style="margin-bottom: 24px; display: flex; gap: 12px; align-items: center; background: #fff0f3; border-radius: 12px; box-shadow: 0 2px 8px #b23b3b11; padding: 12px 10px; border: 1.2px solid #f8d7da;">
    <input type="text" name="q" value="<?= esc($q); ?>" placeholder="Cari judul..." style="padding: 12px; border-radius: 8px; border: 1.5px solid #f8d7da; font-family: 'Inter', sans-serif; font-size: 15px; background: #fff;">
    <select name="kategori_id" style="padding: 12px; border-radius: 8px; border: 1.5px solid #f8d7da; font-family: 'Inter', sans-serif; font-size: 15px; background: #fff;">
        <option value="">Semua Kategori</option>
        <?php if (isset($kategori) && is_array($kategori)): ?>
            <?php foreach ($kategori as $k): ?>
                <option value="<?= esc($k['id_kategori']); ?>" <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>
                    <?= esc($k['nama_kategori']); ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <button type="submit" class="btn btn-primary" style="font-family: 'Inter', sans-serif; font-weight: bold; font-size: 15px; letter-spacing: 0.5px; background: linear-gradient(90deg, #b23b3b 60%, #f8d7da 100%); border: none; box-shadow: 0 1px 6px #b23b3b22;">Cari</button>
</form>

<?php if (isset($error)): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; border-radius: 5px;">
        <h4><?= esc($error); ?></h4>
        <p><?= esc($message); ?></p>
    </div>
<?php else: ?>
    <table style="background: linear-gradient(120deg, #fff0f3 60%, #f8d7da 100%); border-radius: 16px; box-shadow: 0 8px 32px #b23b3b22, 0 2px 12px #fff0f3cc; overflow: hidden; border: 2px solid #b23b3b22; font-family: 'Inter', sans-serif; font-size: 15px;">
        <thead>
            <tr style="background: #fff0f3; color: #b23b3b; font-size: 16px; font-family: 'Inter', sans-serif;">
                <th>ID</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($artikel)): ?>
                <?php foreach ($artikel as $item): ?>
                    <tr style="background: #fff; border-bottom: 1.5px solid #f8d7da; transition: background 0.2s;">
                        <td><?= esc($item['id']); ?></td>
                        <td><?= esc($item['judul']); ?></td>
                        <td><?= esc($item['nama_kategori'] ?? 'N/A'); ?></td>
                        <td><?= $item['status'] ? '<span style=\'color:#10b981;font-weight:bold;font-family:Inter,sans-serif\'>Published</span>' : '<span style=\'color:#b23b3b;font-weight:bold;font-family:Inter,sans-serif\'>Draft</span>'; ?></td>
                        <td>
                            <a href="/admin/artikel/edit/<?= $item['id']; ?>" class="btn btn-primary" style="font-family: 'Inter', sans-serif; font-weight: bold; font-size: 14px; background: linear-gradient(90deg, #b23b3b 60%, #f8d7da 100%); border: none; box-shadow: 0 1px 6px #b23b3b22;">Edit</a>
                            <a href="/admin/artikel/delete/<?= $item['id']; ?>" class="btn btn-danger" style="font-family: 'Inter', sans-serif; font-weight: bold; font-size: 14px; background: linear-gradient(90deg, #b23b3b 60%, #f8d7da 100%); border: none; box-shadow: 0 1px 6px #b23b3b22;" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: #b23b3b; font-family: 'Inter', sans-serif;">Tidak ada artikel.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($pager): ?>
        <div class="pagination" style="margin-top: 20px;">
            <?= $pager->links(); ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?= $this->include('template/admin_footer'); ?>
