<?= $this->extend('layouts/main')?>
<?= $this->section('content')?>
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            <h2>Tablica Wyników <button type="button" class="btn btn-outline-dark float-right" data-mdb-ripple-color="dark">Wszystkie Wyniki</button></h2>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table border text-center">
                        <thead>
                        <tr>
                            <th scope="col">🏆</th>
                            <th scope="col">Imię</th>
                            <th scope="col">Nazwisko</th>
                            <th scope="col">Szkoła</th>
                            <th scope="col">Czas</th>
                            <th scope="col">Gokart</th>
                        </tr>
                        </thead>
                        <tbody class="font-weight-bold">
                        <!-- ELEMENT -->
                        <?php foreach($resultleaderboard as $row) : ?>
                            <tr>
                                <th scope="row"><?= $i; $i++ ?></th>
                                <td><?= $row->imie ?></td>
                                <td><?= $row->nazwisko ?></td>
                                <td><?= $row->akronim ?></td>
                                <td><?= $row->czas ?></td>
                                <td><?= $row->nazwa ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- ELEMENT KONIEC -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>