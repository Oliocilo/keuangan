<div class="page-wrapper">
    <div class="card page-header p-0 titleweb">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col ">
                <div class="d-inline-block">
                 <h5><?=$page_name?></h5>

             </div>
         </div>
     </div>
 </div>

 <div class="page-body">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <label>Status</label>
                    <select class="form-control" id="statusFilter">
                        <option value="">-- Semua Status --</option>
                        <option value="Pending" selected>Pending</option>
                        <option value="Batal">Batal</option>
                        <option value="Terverifikasi">Terverifikasi</option>
                       
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Konfirmasi Pembayaran</label>
                    <select class="form-control" id="pembayaranFilter">
                        <option value="">-- Semua --</option>
                        <option value="Sudah">Sudah</option>
                        <option value="Belum">Belum</option>
                       
                    </select>
                </div>
                <div class="col-md-2">
                    <label style="opacity: 0;">filter</label>
                    <button type="button" class="btn btn-info btn-block filterBtn">
                        <i class="icofont icofont-search m-r-5"></i> Filter
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="example" class="table smalltable custom-table  table-hover table-bordered thead-center table-condensed" width="100%">
                <thead>
                   <tr>
                        <th style="width: 40px;">No</th>
                        <th style="width: 100px;">Type</th>
                        <th style="width: 200px;">User</th>
                        <th style="width: 150px;">Tanggal Pembelian</th>
                        <th>Harga</th>
                        <th>Kode Unik</th>
                        <th>Status</th>
                        <th>Konfirmasi Pembayaran</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
 </div>
</div>