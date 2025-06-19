 <div class="errorValidate" style="display:none"><ul></ul></div>
 <div class="j-wrapper j-wrapper-640">
     <form class="j-pro" novalidate="" id="formajax" action="<?= base_url('master/barang/store') ?>" autocomplete="off">
        <div class="j-content">
            <div class="j-row">
                <div class="j-span7 j-unit">
                    <label class="j-label">Tanggal Masuk <small class="text-danger">*</small></label>
                    <div class="j-input">
                        <label class="j-icon-right" for="date_from">
                            <i class="fa fa-calendar"></i>
                        </label>
                        <input type="text" class="date_from" name="tanggal" readonly="">
                    </div>
                </div>
                <div class="j-span5 j-unit">
                    <label class="j-label">Jam Masuk <small class="text-danger">*</small></label>
                    <div class="j-input" >
                        <label class="j-icon-right" for="date_to">
                            <i class="fa fa-clock-o"></i>
                        </label>
                        <input type="text" class="jam" name="jam" >
                    </div>
                </div>
            </div>
            <div class="j-unit">
                <label class="j-label">Kode Barang <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="kode_barang">
                </div>
            </div>
            <div class="j-unit">
                <label class="j-label">Nama Barang <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="nama_barang">
                </div>
            </div>
        </div>
        <div class="j-footer">
            <button type="submit" class="btn btn-primary waves-effect btnSubmit">Simpan</button>
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $('.date_from').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "mm/dd/yy",
        prevText: '<i class="fa fa-caret-left"></i>',
        nextText: '<i class="fa fa-caret-right"></i>',
    });

     $('.currency').autoNumeric('init', {
        aSep: '.', 
        aDec: ',',
        aForm: true,
        aPad: false,
        vMin: 0,
     });

     $('.jam').datetimepicker({
            // Formats
            // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
            format: 'HH:mm',
            
            // Your Icons
            // as Bootstrap 4 is not using Glyphicons anymore
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });
</script>