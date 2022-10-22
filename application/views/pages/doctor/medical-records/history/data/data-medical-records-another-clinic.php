<div class="data-tables datatable mt-5">
    <?php if ($this->session->userdata('id_store') == '2') : ?>
        <h6 class="mb-4">Siteba Clinic</h6>
    <?php else : ?>
        <h6 class="mb-4">Bandar Damar Clinic</h6>
    <?php endif ?>
    <table id="dataTablePatientsMedicalRecordsHistory" class="text-center table table-hover">
        <thead>
            <tr>
                <th>Date</th>
                <th>Anamnese</th>
                <th>Diagnose</th>
                <!-- <th>Checkup</th> -->
                <th>Therapy</th>
                <th>Products</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($getMedicalRecord as $row) : ?>
                <tr>
                    <td><?= date_format(new DateTime($row->created_at), 'd/m/Y') ?></td>
                    <td><?= $row->anamnesa; ?></td>
                    <td><?= $row->diagnosa; ?></td>
                    <!-- <td><?= $row->pemeriksaan; ?></td> -->
                    <td>
                        <?php foreach ($therapies[$row->id_therapies] as $row2) : ?>
                            <span class="badge badge-pill badge-info" style="font-size: 13px;"><?= $row2->title; ?></span>
                        <?php endforeach ?>
                    </td>
                    <td>
                        <?php foreach ($items[$row->id_items] as $data) : ?>
                            <span class="badge badge-pill badge-warning" style="font-size: 13px;"><?= $data->title; ?></span>
                        <?php endforeach ?>
                    </td>
                    <td><?= $row->note; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- <iframe src="<?= base_url("doctor/medicalrecord/print/$id_customer") ?>" name="medical_record_print" id="medical_record_print" style="display: none;" frameborder="0"></iframe> -->