<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <br>

            <h3>Daftar Komik</h3>

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