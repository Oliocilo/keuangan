<table class="table custom-table table-hover table-bordered thead-center" width="100%">
    <thead>
        <tr>
            <th>Akhir Bulan</th>
            <th>Biaya Penyusutan</th>
            <th>Akumulasi Penyusutan</th>
            <th>Nilai Buku</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Rp. <?= number_format($aset['nilai_perolehan'], 0, ',', '.') ?></td>
        </tr>
        <?php foreach ($aset_bulanan['table'] as $data) : ?>
            <tr>
                <td><?= $data['Bulan']; ?></td>
                <td><?= $data['Biaya Penyusutan']; ?></td>
                <td><?= $data['Akumulasi Penyusutan']; ?></td>
                <td><?= $data['Nilai Buku']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>