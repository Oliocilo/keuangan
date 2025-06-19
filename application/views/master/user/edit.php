<div class="errorValidate" style="display:none"><ul></ul></div>
<div class="j-wrapper j-wrapper-640">
     <form class="j-pro" novalidate="" action="<?= base_url('master/user/update/'.$v_user['id']) ?>" id="formajax" autocomplete="off">
        <div class="j-content">
             <div class="j-unit">
                <label class="j-label">Nama  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="nama" value="<?=$v_user['nama']?>">
                </div>
            </div>
            <div class="j-unit">
                <label class="j-label">Email  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="email" name="email" value="<?=$v_user['username']?>">
                </div>
            </div>

            <div class="j-unit">
                <label class="j-label">Password  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="password" name="password" autocomplete="new-password" placeholder="Biarkan kosong, jika tidak ingin diubah">
                </div>
            </div>

            <div class="j-unit">
                <label class="j-label">Role</label>
                <label class="j-input j-select">
                    <select name="role" id="role">
                        <?php 
                            foreach ($roles as $key => $role) {
                            $selected = $v_user['role_id'] == $role['id'] ? "selected" : "";
                        ?>
                            <option value="<?=$role['id']?>" <?=$selected?>><?=$role['role_name']?></option>
                        <?php } ?>
                    </select>
                    <i></i>
                </label>
            </div>

        </div>
        <div class="j-footer">
            <button type="submit" class="btn btn-success waves-effect btnSubmit">Simpan</button>
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>