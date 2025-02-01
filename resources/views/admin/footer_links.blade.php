
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

</body>


</html>