    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-migrate-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/tether.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script> 
    <script src="{{asset('js/jquery.easing.js')}}"></script>    
    <script src="{{asset('js/jquery-waypoints.js')}}"></script>    
    <script src="{{asset('js/jquery-validate.js')}}"></script> 
    <script src="{{asset('js/owl.carousel.js')}}"></script>
    <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('js/numinate.min6959.js?ver=4.9.3')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>


    <!-- Revolution Slider -->
    <script src="{{asset('revolution/js/jquery.themepunch.tools.min.js')}}"></script>
    <script src="{{asset('revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
    <script src="{{asset('revolution/js/slider.js')}}"></script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->    

    <script src="{{asset('revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
    <script src="{{asset('revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
    <script src="{{asset('revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
    <script src="{{asset('revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
    <script src="{{asset('revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
    <script src="{{asset('revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
    <script src="{{asset('revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
    <script src="{{asset('revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
    <script>
        // Wait for the DOM to load
        // Wait for the DOM to load
document.addEventListener("DOMContentLoaded", function () {
    // Get the current URL path
    const currentPath = window.location.pathname;

    // Select all menu items
    const menuItems = document.querySelectorAll("#menu .dropdown a");

    // Loop through each menu item
    menuItems.forEach(item => {
        // Check if the href of the item matches the current path
        if (item.getAttribute("href") === currentPath) {
            // Add the active class to the parent `<li>` of the matching link
            item.parentElement.classList.add("active");

            // If it's a dropdown, ensure parent dropdowns also get the `active` class
            let parent = item.parentElement.parentElement.closest("li");
            while (parent) {
                parent.classList.add("active");
                parent = parent.parentElement.closest("li");
            }
        }
    });
});


    </script>
    

   
</body>

</html>