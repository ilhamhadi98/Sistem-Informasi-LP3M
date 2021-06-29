<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Evaluasi proses pembelajaran</h4>
                    <h5 class="text-center font-weight-bold">Kelengkapan Dokumen</h5>
                    <hr>
                    <table class="table table-borderless w-100 mt-4">
                        <?php
                        $no = 1;
                        foreach ($pendidikan as $row) { ?>
                            <tr>
                                <td><strong>Objek Id</strong> </td>
                                <td>: <?= $row->object_id_pendidikan; ?></td>
                                <td><strong>Tahun Ajaran</strong></td>
                                <td>: <?= $row->tahun_ajaran; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Periode</strong> </td>
                                <td>: <?= $row->periode; ?></td>
                                <td><strong>Kegiatan</strong> </td>
                                <td>: <?= $row->kegiatan; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Fakultas </strong> </td>
                                <td>: <?= $row->nama_fakultas; ?></td>
                                <td><strong>Program Studi </strong> </td>
                                <td>: <?= $row->nama_prodi; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Pembuat </strong> </td>
                                <td>: <?= $row->name; ?></td>
                                <td><strong>Dibuat </strong> </td>
                                <td>: <?= $row->pendidikan_timestamp; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Deskripsi </strong> </td>
                                <td>: <?= $row->des_pendidikan; ?></td>
                                <td><strong>Penilaian </strong> </td>
                                <td>:
                                    <div class="badge badge-pill badge-info">
                                        <?php
                                        $h_pendidikan = $row->id_pendidikan_nilai;

                                        $this->db->like('pendidikan_id', $h_pendidikan);
                                        $this->db->like('status_id', 0);
                                        $this->db->from('pendidikan_transaksi');
                                        $hitung = $this->db->count_all_results();

                                        $hasil = $total_asset - $hitung;

                                        echo $hasil . ' / ' . $total_asset;
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Aspek</th>
                                    <th>Dokumen</th>
                                    <th>Keterangan</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($dokumen as $row) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row->aspek; ?></td>
                                        <td><?= $row->nama_dokumen; ?></td>
                                        <td>
                                            <?php

                                            if ($row->status_id >= 1) {
                                                echo '<div class="badge badge-success badge-pill">Selesai dikerjakan</div>';
                                            } else {
                                                echo '<div class="badge badge-warning badge-pill">Belum dikerjakan</div>';
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($row->file == false) {
                                                echo '<button type="button" class="btn btn-icons btn-rounded btn-outline-light disabled""><i class="fa fa-eye-slash"></i></button>';
                                            } else {
                                                echo '<a class="btn btn-icons btn-rounded btn-outline-success" href="' . base_url('unggah/pendidikan/' . $row->file) . '" target="_blank"><i class="fa fa-eye"></i></a>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary icon-btn dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-layers"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                                                    <a class="dropdown-item" href="<?php echo site_url('EvaluasiPendidikan/nilaiDokumen/' . $row->id_transaksi_pendidikan); ?>">Nilai</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <a type="button" class="btn btn-outline-danger btn-fw" href="<?php echo site_url('EvaluasiPendidikan'); ?>">
                        <i class="fa fa-undo"></i>
                        Kembali
                    </a>
                    <?php
                    foreach ($pendidikan as $row) { ?>
                        <a type="button" class="btn btn-outline-warning btn-fw pull-right" href="<?php echo site_url('EvaluasiPendidikan/sendPendidikan/' . $row->id_pendidikan_nilai); ?>" onclick="return confirm('Mohon cek kembali kelengkapan dokumen sebelum menyerahkan !!!')">
                            <i class="fa fa-send"></i>
                            Selesai Menilai
                        </a>
                    <?php } ?>
                    <hr>
                </div>
            </div>
        </div>