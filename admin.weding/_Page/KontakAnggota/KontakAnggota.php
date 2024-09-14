<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <?php
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                echo '  Berikut ini adalah halaman pengelolaan data kontak untuk customer service.';
                echo '  Anda bisa mengirimkan broadcast berdasarkan kontak yang telah dibagikan admin.<br>';
                echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            ?>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-10 mb-3"></div>
        <div class="col-md-2 mb-3">
            <a class="btn btn-md btn-outline-dark btn-block" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalFilter">
                <i class="bi bi-funnel"></i> Filter
            </a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12" id="MenampilkanTabelKontakAnggota">
            
        </div>
    </div>
</section>