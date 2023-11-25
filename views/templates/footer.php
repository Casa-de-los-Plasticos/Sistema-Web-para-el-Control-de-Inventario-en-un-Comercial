</div>
</div>
<!--end page wrapper -->
<!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->
<!--Start Back To Top Button-->
<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
<footer class="page-footer">
    <p class="mb-0">Control de Almacén V.1.0 © | <?php echo date('Y'); ?> | Todos los Derechos Reservados...</p>
</footer>
</div>
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">
    <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
    </div>
    <div class="switcher-body">
        <div class="d-flex align-items-center">
            <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
            <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
        </div>
        <hr />
        <h6 class="mb-0">Theme Styles</h6>
        <hr />
        <div class="d-flex align-items-center justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                <label class="form-check-label" for="lightmode">Light</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                <label class="form-check-label" for="darkmode">Dark</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                <label class="form-check-label" for="semidark">Semi Dark</label>
            </div>
        </div>
        <hr />
        <div class="form-check">
            <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
            <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
        </div>
        <hr />
        <h6 class="mb-0">Header Colors</h6>
        <hr />
        <div class="header-colors-indigators">
            <div class="row row-cols-auto g-3">
                <div class="col">
                    <div class="indigator headercolor1" id="headercolor1"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor2" id="headercolor2"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor3" id="headercolor3"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor4" id="headercolor4"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor5" id="headercolor5"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor6" id="headercolor6"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor7" id="headercolor7"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor8" id="headercolor8"></div>
                </div>
            </div>
        </div>
        <hr />
        <h6 class="mb-0">Sidebar Colors</h6>
        <hr />
        <div class="header-colors-indigators">
            <div class="row row-cols-auto g-3">
                <div class="col">
                    <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end switcher-->
<!-- Bootstrap JS -->
<script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/chartjs/js/Chart.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/chartjs/js/Chart.extension.js"></script>
<!-- morris plugins -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!--app JS-->
<script src="<?php echo BASE_URL; ?>assets/js/app.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/all.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/DataTables/datatables.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/botones-perzonalizados.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/ckeditor.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/funciones.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/jquery-ui.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/fullcalendar/js/main.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/es.js"></script>
<script>
    const base_url = '<?php echo BASE_URL; ?>';
</script>
<?php if (!empty($data['busqueda'])) { ?>
    <script>
        const nombreKey = '<?php echo $data['carrito']; ?>';
    </script>
    <script src="<?php echo BASE_URL . 'assets/js/' . $data['busqueda']; ?>"></script>
<?php } ?>
<?php if (!empty($data['script'])) { ?>
    <script src="<?php echo BASE_URL . 'assets/js/modulos/' . $data['script']; ?>"></script>
<?php } ?>
<?php if (!empty($data['consolidado'])) { ?>
    <script src="<?php echo BASE_URL . 'assets/js/modulos/' . $data['consolidado']; ?>"></script>
<?php } ?>

<?php if (!empty($data['irs'])) { ?>
    <script src="<?php echo BASE_URL . 'assets/js/modulos/' . $data['irs']; ?>"></script>
<?php } ?>
</body>

</html>