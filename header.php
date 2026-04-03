<div class="navbar">

    <div class="nav-left">
        <button class="menu-btn" onclick="toggleSidebar()">
            <i class="fa fa-bars"></i>
        </button>

        <h2 class="logo">Parking System</h2>
    </div>

</div>

<script>
function toggleSidebar(){
    document.querySelector(".sidebar").classList.toggle("hide");
    document.querySelector(".content").classList.toggle("full");
}
</script>

