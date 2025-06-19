

<div class="page-wrapper">
<div class="card page-header p-0">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col title-bukukas">
                <div class="big-icon">
                    <i class="fa fa-book"></i>
                </div>
                <div class="d-inline-block">
                    <h5><?=$page_name?></h5>
                    <span>Master Data</span>
                </div>
            </div>
        </div>
    </div>

<div class="page-body">
    
    

    <div class="card">
        <div class="card-header">
            <div class="row m-b-10 b-b-primary p-b-10">
                <div class="col-md-8">
                    
                 
                </div>

                <div class="col-md-4 text-right">
                    <?php if($this->template->checkAccessed('SP017') == 1){ ?>
                    <button id="add" class="btn btn-success" data-toggle="modal" data-target="#default-Modal"><i class="fa fa-plus"></i> Tambah Kategori Aset</button>
                <?php } ?>
                </div>
            </div>
         
        </div>
        <div class="card-body">
            <table id="example" class="table custom-table table-hover table-bordered thead-center table-responsive d-sm-table" width="100%">
                <thead style="display: table-header-group;">
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>

