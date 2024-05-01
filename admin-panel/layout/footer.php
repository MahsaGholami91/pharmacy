    <footer class="footer text-center"> </footer>
            
        </div>
        
    </div>


    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="../../dist/js/waves.js"></script>
    <script src="../../dist/js/sidebarmenu.js"></script>
    <script src="../../dist/js/custom.min.js"></script>
    <script>
        function openDeleteModal(id) {
            document.getElementById('deleteItemId').value = id;
            $('#deleteModal').modal('show');
        }
            $('#cancelButton').click(function() {
            $('#deleteModal').modal('hide');
        });
    </script>
</body>

</html>

    