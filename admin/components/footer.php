
</div>
 <!-- /#page-content-wrapper -->
</div>
<!-- /#page-wrapper -->

<!-- Alertify JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<!-- Sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Menu Toggle
    let wrapper = document.getElementById("wrapper");
    let toggleButton = document.getElementById("menu-toggle");

    toggleButton.addEventListener('click', function() {
        wrapper.classList.toggle("toggled")
    })

    // Display Alert Message
    <?php
    if (isset($_SESSION['message'])) { 
        if (($_SESSION['type']) == 'danger'){
            ?>
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('<?= $_SESSION['message'] ?>');
    <?php
    }
    else  if (($_SESSION['type']) == 'success'){
        ?>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['message'] ?>');
    <?php
    }
    }
    unset($_SESSION['message']);
    unset($_SESSION['type']);
    ?>
    
    // AJAX - Upload picture
    function uploadPic() {
        let formData = new FormData();
        formData.append('picture', fileInput.files[0]);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../change-img.php');
        xhr.onload = function() {
            if (xhr.status === 200) {
                let response = JSON.parse(this.responseText);

                imageElement.src = '../' + response.url;
            }
        };
        xhr.send(formData);
    }
    let fileInput = document.getElementById('picture-upload');
    let imageElement = document.getElementById('picture-placeholder');
    if (fileInput) {
        fileInput.addEventListener('change', uploadPic);
    }
    // AJAX - Delete User
    let deleteBtn = document.querySelectorAll('.delete-btn')
    deleteBtn.forEach((btn, i) => {
        btn.addEventListener('click', function() {
            let id = btn.value
            Swal.fire({
                title: 'Are you sure?',
                text: "Once deleted, you won't be able to recover!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', 'users/actions.php');
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    let data = `id=${id}&delete-btn=${true}`
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            Swal.fire({
                                title: 'The user has been deleted!',
                                text: 'Success',
                                icon: 'success',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    };
                    xhr.send(data);
                }
            })
        })
    })
</script>
</body>

</html>