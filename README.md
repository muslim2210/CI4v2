<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <br>

            <a href="/komik/create" class="btn btn-primary mb-3">Tambah Data Komik</a>
            <h3>Daftar Komik</h3>

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Berhasil!</h4>
                    <p><?= session()->getFlashdata('pesan'); ?></p>
                    <hr>

                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('delete')) : ?>
                <div class="alert alert-danger" role="alert">
                    <p><?= session()->getFlashdata('delete'); ?></p>
                    <hr>

                </div>
            <?php endif; ?>
            <div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Sampul</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($komik as $k) : ?>

                            <tr>
                                <th scope="col"><?= $i++; ?></th>
                                <td><img src="/img/<?= $k['sampul']; ?>" alt="" class="sampul"></td>
                                <td><?= $k['judul']; ?></td>
                                <td><a href="/Komik/<?= $k['slug']; ?>" class="btn btn-success">Detail</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>
