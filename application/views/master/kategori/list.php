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
        <div class="row m-b-20">
            <div class="col-md-6">
                <div class="card bukukas-card">
                    <h5 class="p-15 m-0 bg-success">List Kategori Pemasukan</h5>
                    <div class="card-block">
                        <table id="example" class="table table-striped table-hover table-bordered thead-center display dataTable m-t-20 tbody-left" width="100%">
                            <thead style="display: table-header-group;">
                                <tr>
                                    <th>Kategori</th>
                                    <th style="width:100px">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="button" onclick="addForm(1)" data-toggle="modal" data-target="#default-Modal" class="btn btn-success btn-round btn-block"><i class="fa fa-plus"></i> Buat kategori Pemasukan</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bukukas-card">
                    <h5 class="p-15 m-0 bg-danger">List Kategori Pengeluaran</h5>
                    <div class="card-block">
                        <table id="examples" class="table table-striped table-hover table-bordered thead-center display dataTable m-t-20 tbody-left" width="100%">
                            <thead style="display: table-header-group;">
                                <tr>
                                    <th>Kategori</th>
                                    <th style="width:100px">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="button" onclick="addForm(2)" data-toggle="modal" data-target="#default-Modal" class="btn btn-danger btn-round btn-block"><i class="fa fa-plus"></i> Buat kategori Pengeluaran</button>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<div id="formDelete"></div>