
<div class="page-wrapper">

<div class="page-body">
    <div class="row">
        <!-- task, page, download counter  start -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-yellow update-card">
                <div class="card-block">
                    <h4 class="text-white m-b-0">Rp. <?= number_format($totalPemasukan, 0, ',', '.') ?></h4>
                </div>
                <div class="card-footer">
                    <h6 class="text-white">Seluruh Saldo Pemasukan</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-green update-card">
                <div class="card-block">
                    <h4 class="text-white m-b-0">Rp. <?= number_format($totalPengeluaran, 0, ',', '.') ?></h4>
                </div>
                <div class="card-footer">
                    <h6 class="text-white">Seluruh Saldo Pengeluaran</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-pink update-card">
                <div class="card-block">
                    <h4 class="text-white m-b-0">Rp. <?= number_format($totalKas, 0, ',', '.') ?></h4>
                </div>
                <div class="card-footer">
                    <h6 class="text-white">Seluruh Saldo Buku Kas</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-lite-green update-card">
                <div class="card-block">
                    <h4 class="text-white m-b-0"><?= $totalPengguna ?></h4>
                </div>
                <div class="card-footer">
                    <h6 class="text-white">Jumlah Pengguna</h4>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12">
            <div class="card user-activity-card">
                <div class="card-header">
                    <h5>Jatuh Tempo Utang</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-maximize full-card"></i></li>
                            <li><i class="feather icon-minus minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    
                    <?php 
                    if(empty($utang)){
                    ?>
                        <h6 class="text-center">Anda tidak memiliki Hutang</h6>
                    <?php
                    } else {
                        foreach($utang as $u){ 
                    ?>
                        <div class="m-b-25">
                            <h6 class="m-b-5"><?=$u['klien']?></h6>
                            <p class="text-muted m-b-0">Rp. <?= number_format($u['saldo_akhir'], 0, ',', '.') ?></p>
                            <p class="text-danger m-b-0"><i class="feather icon-clock m-r-10"></i><?= date_format(date_create($u['tanggal_tempo']),'d M Y H:i')?></p>
                        </div>
                    <?php 
                        }
                    ?>
                    <div class="text-center">
                        <a href="<?=base_url('debt')?>" class="b-b-primary text-primary">Lihat Semua Utang</a>
                    </div>
                    <?php
                    } 
                    ?>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5>Kalender</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-maximize full-card"></i></li>
                            <li><i class="feather icon-minus minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div id="clndr-default" class="overflow-hidden bg-grey bg-lighten-3 p-3"></div>
                </div>
            </div>
        </div>
        <div id="clndr" class="clearfix">
            <script type="text/template" id="clndr-template">
                <div class="clndr-controls">
                    <div class="clndr-previous-button">&lt;</div>
                    <div class="clndr-next-button">&gt;</div>
                    <div class="current-month">
                        <%= month %>
                            <%= year %>
                    </div>
                </div>
                <div class="clndr-grid">
                    <div class="days-of-the-week clearfix">
                        <% _.each(daysOfTheWeek, function(day) { %>
                            <div class="header-day">
                                <%= day %>
                            </div>
                            <% }); %>
                    </div>
                    <div class="days">
                        <% _.each(days, function(day) { %>
                            <div class="<%= day.classes %>" id="<%= day.id %>"><span class="day-number"><%= day.day %></span></div>
                            <% }); %>
                    </div>
                </div>
            </script>
        </div>

    </div>
</div>
</div>