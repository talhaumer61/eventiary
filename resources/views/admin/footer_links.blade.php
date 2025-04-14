    <!-- jQuery CDN (Add this in your HTML file inside <head> or before </body>) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper JS -->
    <script src="{{asset('dashboard/libs/%40popperjs/core/umd/popper.min.js')}}"></script>

    <!-- Bootstrap JS -->
    <script src="{{asset('dashboard/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{asset('dashboard/js/defaultmenu.min.js')}}"></script>

    <!-- Node Waves JS-->
    <script src="{{asset('dashboard/libs/node-waves/waves.min.js')}}"></script>

    <!-- Sticky JS -->
    <script src="{{asset('dashboard/js/sticky.js')}}"></script>

    <!-- Simplebar JS -->
    <script src="{{asset('dashboard/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('dashboard/js/simplebar.js')}}"></script>

    <!-- Color Picker JS -->
    <script src="{{asset('dashboard/libs/%40simonwep/pickr/pickr.es5.min.js')}}"></script>

     <!-- Apex Charts JS -->
     <script src="dashboard/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Mail Settings -->
    <script src="dashboard/js/mail-settings.js"></script>

     <!-- Used For Sessions By Device Chart -->
     <script src="dashboard/libs/moment/moment.js"></script>
 
     <!-- Analytics-Dashboard JS -->
     <script src="dashboard/js/analytics-dashboard.js"></script>
 
    
    <!-- Custom-Switcher JS -->
    <script src="{{asset('dashboard/js/custom-switcher.min.js')}}"></script>

    <!-- Date & Time Picker JS -->
    <script src="{{asset('dashboard/libs/flatpickr/flatpickr.min.js')}}"></script>

    <!-- Quill Editor JS -->
    <script src="{{asset('dashboard/libs/quill/quill.min.js')}}"></script>

    <!-- Filepond JS -->
    <script src="{{asset('dashboard/libs/filepond/filepond.min.js')}}"></script>
    <script src="{{asset('dashboard/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js')}}"></script>
    <script src="{{asset('dashboard/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js')}}"></script>
    <script src="{{asset('dashboard/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js')}}"></script>
    <script src="{{asset('dashboard/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js')}}"></script>
    <script src="{{asset('dashboard/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.js')}}"></script>
    <script src="{{asset('dashboard/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js')}}"></script>
    <script src="{{asset('dashboard/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js')}}"></script>
    <script src="{{asset('dashboard/libs/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js')}}"></script>
    <script src="{{asset('dashboard/libs/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js')}}"></script>
    <script src="{{asset('dashboard/libs/filepond-plugin-image-transform/filepond-plugin-image-transform.min.js')}}"></script>

    <!-- Internal Add Products JS -->
    <script src="{{asset('dashboard/js/add-products.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{asset('dashboard/js/custom.js')}}"></script>
    <script>
        // Wait for the DOM to load
        document.addEventListener("DOMContentLoaded", function () {
            // Get the current URL path
            const currentPath = window.location.pathname;

            // Select all sidebar menu items
            const menuItems = document.querySelectorAll(".side-menu__item");

            // Loop through each menu item and add 'active' class if the href matches the current path
            menuItems.forEach(item => {
                if (item.getAttribute("href") === currentPath) {
                    item.classList.add("active"); // Add 'active' class to the matching menu item
                }
            });
        });

    </script>
    {{-- <script>
        document.getElementById("changePasswordForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission
        
            let isValid = true;
            let currentPassword = document.getElementById("current-password").value;
            let newPassword = document.getElementById("new-password").value;
            let confirmPassword = document.getElementById("confirm-password").value;
        
            // Reset error messages
            document.getElementById("currentPasswordError").innerText = "";
            document.getElementById("newPasswordError").innerText = "";
            document.getElementById("confirmPasswordError").innerText = "";
        
            // Validate current password
            if (currentPassword.trim() === "") {
                document.getElementById("currentPasswordError").innerText = "Current password is required.";
                isValid = false;
            }
        
            // Validate new password
            let passwordRegex = /^.{8,}$/;
                if (!passwordRegex.test(newPassword)) {
                    document.getElementById("newPasswordError").innerText = "Password must be at least 8 characters long.";
                    isValid = false;
            }
        
            // Validate confirm password
            if (newPassword !== confirmPassword) {
                document.getElementById("confirmPasswordError").innerText = "Passwords do not match.";
                isValid = false;
            }
        
            // Submit form if all validations pass
            if (isValid) {
                this.submit();
            }
        });
    </script> --}}

    {{-- Change Password --}}
    <script>
        document.getElementById("changePasswordForm").addEventListener("submit", function (e) {
            e.preventDefault(); // Prevent form submission

            let isValid = true;
            
            let currentPassword = document.getElementById("current-password").value.trim();
            let newPassword = document.getElementById("new-password").value.trim();
            let confirmPassword = document.getElementById("confirm-password").value.trim();

            // Clear previous errors
            document.getElementById("currentPasswordError").innerText = "";
            document.getElementById("newPasswordError").innerText = "";
            document.getElementById("confirmPasswordError").innerText = "";

            // Validate new password (Minimum 8 characters)
            let passwordRegex = /^.{8,}$/;
            if (!passwordRegex.test(newPassword)) {
                document.getElementById("newPasswordError").innerText = "Password must be at least 8 characters long.";
                isValid = false;
            }

            // Check if new password and confirm password match
            if (newPassword !== confirmPassword) {
                document.getElementById("confirmPasswordError").innerText = "Passwords do not match.";
                isValid = false;
            }

            if (!isValid) {
                return; // Stop if validation fails
            }

            // **AJAX request to check current password**
            fetch("{{ route('check-current-password') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ current_password: currentPassword })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    let errorElement = document.getElementById("currentPasswordError");
                    errorElement.innerText = "Current password is incorrect.";
                    console.log("Current password is incorrect.");
                    errorElement.style.color = "red"; // Ensure it's visible
                    return;
                }
                
                // Submit the form if password is correct
                document.getElementById("changePasswordForm").submit();
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });

    </script>

    {{-- Delete Record --}}
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(table, id, column) {
            Swal.fire({
                title: "Are you sure?",
                text: "You are about to delete this record.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Disable button to prevent multiple clicks
                    $(".delete-btn").prop("disabled", true);

                    $.ajax({
                        url: "{{ route('delete.record') }}",
                        type: "POST",
                        data: {
                            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                            table: table,
                            id: id,
                            column: column
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: response.message,
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = "Something went wrong.";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire("Error!", errorMessage, "error");

                            // Re-enable button in case of error
                            $(".delete-btn").prop("disabled", false);
                        }
                    });
                }
            });
        }
    </script>

</body>


</html>