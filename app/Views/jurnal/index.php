<?= $this->extend('layouts/page_layout') ?>

<?= $this->section('content') ?>
<div class="control-nav mb-3 d-flex gap-2 justify-content-between">
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tambah Jurnal
        </button>
        <ul class="dropdown-menu">
            <li><a href="/jurnal/addJournal" class=" dropdown-item"> <i class="fa-solid fa-circle-plus"></i> Jurnal Umum</a></li>
            <li><a href="/finance/addDeposit" class=" dropdown-item"> <i class="fa-solid fa-circle-plus"></i> Deposit</a></li>
            <li><a href="/sales/addSalesValues" class=" dropdown-item"> <i class="fa-solid fa-circle-plus"></i> Penjualan Barang (Values)</a></li>
            <li><a href="/finance/importJurnal" class=" dropdown-item"> <i class="fa-solid fa-circle-plus"></i> Import Jurnal Umum</a></li>
        </ul>
    </div>
    <div class="link-list-finance">
        <a href="/finance/receivable" class=" btn btn-warning"> <i class="fa-solid fa-circle-plus"></i> Piutang</a>
        <a href="/finance/payable" class=" btn btn-warning"> <i class="fa-solid fa-circle-plus"></i> Hutang</a>
        <a href="/finance/cashTotal" class=" btn btn-success"> <i class="fa-solid fa-wallet"></i> Cash & Bank</a>
    </div>
</div>
<table class="table display-noorder">
    <thead>
        <tr>
            <th>Waktu</th>
            <th>Invoice</th>
            <th>Description</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($jurnal as $j) {
        ?>
            <tr>
                <td><?= $j->waktu; ?></td>
                <td><?= $j->invoice; ?></td>
                <td>
                    <span class="badge text-bg-success"><?= $j->debt_acc_name . ' x ' . $j->cred_acc_name; ?> </span><br>
                    <?= '#' . $j->id . ' - ' . $j->description; ?>
                </td>
                <td class="text-end"><?= number_format($j->jumlah); ?></td>
                <td><?= $j->status = 1 ? '<span class="badge text-bg-success">Success</span>' : '<span class="badge text-bg-danger">Failed</span>'; ?></td>
                <td>
                    <a href="/jurnal/edit/<?= $j->id; ?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="/jurnal/delete/<?= $j->id; ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php }; ?>
    </tbody>
</table>
<?= $this->endSection() ?>