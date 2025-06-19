<style>
    .dataTables_wrapper {
      overflow-x: hidden;
    }
</style>

<div class="page-wrapper">
<div class="card page-header p-0 titledev">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col ">
                <div class="d-inline-block">
                   <div class="typing"><h5><?=$page_name?></h5></div>
                    
                </div>
            </div>
        </div>
    </div>

<div class="page-body">
    
    

    <div class="card">
        <div class="card-body"  style="padding:3px">
            <table id="example" class="table smalltable custom-table  table-hover table-bordered thead-center table-condensed" width="100%">
                <thead>
                    <tr>
                        <th class="min-mobile">Parent</th>
                        <th style="width:40%">Function</th>
                        <th>Kode</th>
                         <?php foreach ($roles as $key => $role) {?>
                           <th class="min-mobile"><?=$role['role_name']?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sysfunction as $key => $val) { ?>
                      <tr>
                         <td><b><?=$val['parentname']?></b></td>
                          <td><?=$val['name']?></td>
                          <td class="text-center"><?=$val['kode']?></td>
                        <?php foreach ($roles as $key => $role) {?>
                           <td class="text-center" style="vertical-align:middle;">
                               <input type="checkbox" <?= $this->template->checkAccessed($val['kode'],$role['id']) == 1 ? 'checked' : ''?> class="setAccess" data-func="<?=$val['kode']?>" data-role="<?=$role['id']?>">
                           </td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

