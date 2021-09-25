<div id="confirm" class="modal hide fade">
    <div class="modal-body">
        Are you sure?
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
    </div>
</div>
<footer class="main-footer">
    <!-- To the right -->
    <strong>Copyright &copy; 2021 Developer System by <a target="_blank" href="https://wa.me/6281378957946">Dion</a>

</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url(); ?>/template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>/template/dist/js/demo.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>/template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="<?= base_url(); ?>/template/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<script src="<?= base_url(); ?>/js/dion.js"></script>


<script>
    window.setTimeout(function() {


        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });

    }, 2000);
</script>
<script>
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>



</body>

</html>