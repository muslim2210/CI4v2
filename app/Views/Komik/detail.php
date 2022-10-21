<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Komik</h2>
            <div class="card mb-3" style="max-width: 740px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/<?= $komik['sampul']; ?>" alt="..." style="width: 250px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title"><?= $komik['judul']; ?></h4>
                            <p class="card-text">Penulis :<b> <?= $komik['penulis']; ?></b></p>
                            <p class="card-text"><b><?= $komik['penerbit']; ?></b> <small class="text-muted"></small></p>

                            <a href="/komik/edit/<?= $komik['slug']; ?>" class="btn btn-warning">Edit</a>

                            <form action="/komik/<?= $komik['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                            </form>

                            <br><br>
                            <a href="/komik">Kembali ke Daftar Komik</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>