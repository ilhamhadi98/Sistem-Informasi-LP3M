<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Evaluasi Pendidikan dan pengajaran</h4>
                    <hr>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Standar</th>
                                        <th>Object Id</th>
                                        <th>Periode</th>
                                        <th>Kegiatan</th>
                                        <th>Prodi</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Kelengkapan</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pendidikan as $p) { ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php
                                                $id_s = $p['standar_id'];

                                                $this->db->where('id_standar', $id_s);
                                                $this->db->from('standar');
                                                $q = $this->db->get();

                                                foreach ($q->result() as $s) {
                                                    echo $s->no_standar;
                                                }
                                                ?></td>
                                            <td><?php echo $p['object_id_pendidikan']; ?></td>
                                            <td><?php echo $p['periode']; ?></td>
                                            <td><?php echo $p['kegiatan']; ?></td>
                                            <td>
                                                <?php
                                                $id_prodi = $p['prodi_id'];

                                                $this->db->where('id_prodi', $id_prodi);
                                                $this->db->from('prodi');
                                                $q = $this->db->get();

                                                foreach ($q->result() as $pro) {
                                                    echo $pro->nama_prodi;
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $p['tahun_ajaran']; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <?php
                                                    $hp = $p['id_pendidikan'];

                                                    $this->db->like('pendidikan_id', $hp);
                                                    $this->db->like('status_id', 0);
                                                    $this->db->from('pendidikan_transaksi');
                                                    $isi = $this->db->count_all_results();

                                                    $hitung = $total_asset - $isi;

                                                    $persen = $hitung / $total_asset * 100;
                                                    echo '<div class="progress-bar bg-success" role="progressbar" style="' . 'width: ' . $persen . '%' . '" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>';

                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <?php
                                                $n = $p['is_active_pendidikan'];

                                                if ($n > 3) {
                                                    echo '<label class="badge badge-success">Done</label>';
                                                } elseif ($n > 2) {
                                                    echo '<label class="badge badge-success">Done</label>';
                                                } elseif ($n > 1) {
                                                    echo '<label class="badge badge-primary">Aktif</label>';
                                                } elseif ($n > 0) {
                                                    echo '<label class="badge badge-danger">Nonaktif</label>';
                                                } else {
                                                    echo '<label class="badge badge-danger">Nonaktif</label>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php

                                                if ($p['is_active_pendidikan'] > 2) {
                                                    echo '
                                                    <div class="dropdown">
                                                        <button class="btn btn-success icon-btn dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-check"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                                                            <a class="dropdown-item" href="' . site_url('Stafflp3m/HasilPendidikanEvaluasi/' . $p['id_pendidikan']) . '?>">Hasil Evaluasi</a>
                                                            <a class="dropdown-item" href="' . site_url('Stafflp3m/MutuEvaluasi/' . $p['id_pendidikan']) . '?>">Mutu</a>
                                                        </div>
                                                    </div>';
                                                } elseif ($p['is_active_pendidikan'] > 1) {
                                                    echo '
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary icon-btn dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-layers"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                                                            <a class="dropdown-item" href="' . site_url('Stafflp3m/DetailPendidikanEvaluasi/' . $p['id_pendidikan']) . '?>">Detail</a>
                                                            <a class="dropdown-item" href="' . site_url('Stafflp3m/HasilPendidikanEvaluasi/' . $p['id_pendidikan']) . '?>">Hasil Evaluasi</a>
                                                            <a class="dropdown-item" href="' . site_url('Stafflp3m/EvaluasiLampiran/' . $p['id_pendidikan']) . '?>">Lampiran</a>
                                                        </div>
                                                    </div>';
                                                } else {
                                                    echo '
                                                    <div class="dropdown">
                                                        <button class="btn btn-danger icon-btn dropdown-toggle disabled" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-ban"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                                                            <a class="dropdown-item" href="' . site_url('Stafflp3m/DetailPendidikanEvaluasi/' . $p['id_pendidikan']) . '?>">Detail</a>
                                                            <a class="dropdown-item" href="' . site_url('Stafflp3m/HasilPendidikanEvaluasi/' . $p['id_pendidikan']) . '?>">Hasil Evaluasi</a>
                                                            <a class="dropdown-item" href="' . site_url('Stafflp3m/EvaluasiLampiran/' . $p['id_pendidikan']) . '?>">Lampiran</a>
                                                        </div>
                                                    </div>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>