<?= $this->extend('layouts/page_layout') ?>

<?= $this->section('content') ?>
<!-- <h2>Jurnal Page</h2> -->
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-8">
                <form action="/jurnal/addJournal" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group mb-3">
                        <label for="waktu">Waktu</label>
                        <input type="datetime-local" class="form-control <?= $validation->hasError('waktu') ? 'is-invalid' : '' ?>" id="waktu" name="waktu" value="<?= old('waktu') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('waktu'); ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="debt_code">Akun Debet</label>
                        <select class="form-control" id="debt_code" name="debt_code">
                            <option value="">-- Pilih Akun Debet --</option>
                            <?php foreach ($akun as $a) : ?>
                                <option value="<?= $a->acc_code ?>" <?= old('debt_code') == $a->acc_code ? 'selected' : '' ?>><?= $a->acc_code . ' - ' . $a->acc_name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="cred_code">Akun Kredit</label>
                        <select class="form-control" id="cred_code" name="cred_code">
                            <option value="">-- Pilih Akun Kredit --</option>
                            <?php foreach ($akun as $a) : ?>
                                <option value="<?= $a->acc_code ?>" <?= old('cred_code') == $a->acc_code ? 'selected' : '' ?>><?= $a->acc_code . ' - ' . $a->acc_name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" cols="10" rows="5"><?= old('description') ?></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="amount" class="form-label">Jumlah</label>
                        <input type="text" class="form-control <?= $validation->hasError('amount') ? 'is-invalid' : '' ?>" id="amount" name="amount" value="<?= old('amount') ?>">
                        <div id="amountFeedback" class="invalid-feedback">
                            <?= $validation->getError('amount'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-secondary" href="/jurnal">Go Back</a>
                </form>
            </div>
            <div class="col-sm">
                <?php if (session()->has('validation')) : ?>
                    <div class="alert alert-danger">
                        <?= session('validation')->listErrors() ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>