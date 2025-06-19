

<div class="page-wrapper">

     <div class="card page-header p-0">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col title-bukukas">
                <div class="big-icon">
                    <i class="fa fa-book"></i>
                </div>
                <div class="d-inline-block">
                    <h5><?=$page_name?></h5>
                    <span>Penyimpanan</span>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="page-body">
    
    

    <div class="card">
        <div class="card-header">
            <div class="row m-b-10 b-b-primary p-b-10">
                <div class="col-md-8 text-left">
                    <?php if($this->template->checkAccessed('SP002') == 1){ ?>
                        <button class="btn btn-success btn-outline-primary" onclick="renderExcel()"><i class="icofont icofont-file-excel" ></i> Ekspor Excel</button>
                        <button class="btn btn-danger btn-outline-primary" onclick="renderPdf()"><i class="icofont icofont-file-pdf"></i> Print Pdf</button>
                    <?php } ?>
                </div>
                <div class="col-md-4 text-right">
                    <?php if($this->template->checkAccessed('SP019') == 1){ ?>
                        <button id="addAset" class="btn btn-success" data-toggle="modal" data-target="#large-Modal"><i class="fa fa-plus"></i> Tambah Aset</button>
                    <?php } ?>
                </div>
            </div>
         
        </div>
        <div class="card-body">
            <table id="example" class="table custom-table table-hover table-bordered thead-center table-responsive d-lg-table" width="100%">
                <thead style="display: table-header-group;">
                    <tr>
                        <th style="width:40px">No</th>
                        <th>Kode Aset</th>
                        <th>Nama Aset</th>
                        <th>Tanggal Beli</th>
                        <th>Jenis Penyusutan</th>
                        <th>Nilai Buku</th>
                        <th style="width:150px">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>

