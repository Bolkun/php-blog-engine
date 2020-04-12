<div class="container-fluid" id="nav_top_page" style="display: none;">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link pages_nav_link active" data-toggle="tab" href="#containers">Containers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#alerts">Alerts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#badges">Badges</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#buttons">Buttons</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#cards">Cards</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#colors">Colors</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#divs">Divs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#flex">Flex</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#forms">Forms</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#grid">Grid</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#icons">Icons</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#images">Images</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#jumbotron">Jumbotron</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#lists">Lists</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#navbar">Navbar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#pagination">Pagination</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#popover">Popover</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#progress_bars">Progress Bars</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#spinners">Spinners</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#tables">Tables</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#toast">Toast</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#tooltip">Tooltip</a>
        </li>
        <li class="nav-item">
            <a class="nav-link pages_nav_link" data-toggle="tab" href="#typography">Typography</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }
    </script>
    <div class="tab-content">
        <div class="tab-pane container-fluid active" id="containers" style="border: 1px solid grey;">
            <img id="container_drag" src="<?php echo URLROOT; ?>/img/page/container634x143.png" draggable="true" ondragstart="drag(event)">
            <img id="container_drag" src="<?php echo URLROOT; ?>/img/page/container-fluid633x143.png" draggable="true" ondragstart="drag(event)">
        </div>
        <div class="tab-pane container" id="alerts">
            <h3>Menu 1</h3>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <div class="tab-pane container" id="badges">
            <h3>Menu 2</h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
        </div>
        <div class="tab-pane container" id="buttons">

        </div>
        <div class="tab-pane container" id="cards">

        </div>
        <div class="tab-pane container" id="colors">

        </div>
        <div class="tab-pane container" id="divs">

        </div>
        <div class="tab-pane container" id="flex">

        </div>
        <div class="tab-pane container" id="forms">

        </div>
        <div class="tab-pane container" id="grid">

        </div>
        <div class="tab-pane container" id="icons">

        </div>
        <div class="tab-pane container" id="images">

        </div>
        <div class="tab-pane container" id="jumbotron">

        </div>
        <div class="tab-pane container" id="lists">

        </div>
        <div class="tab-pane container" id="navbar">

        </div>
        <div class="tab-pane container" id="pagination">

        </div>
        <div class="tab-pane container" id="popover">

        </div>
        <div class="tab-pane container" id="progress_bars">

        </div>
        <div class="tab-pane container" id="spinners">

        </div>
        <div class="tab-pane container" id="tables">

        </div>
        <div class="tab-pane container" id="toast">

        </div>
        <div class="tab-pane container" id="tooltip">

        </div>
        <div class="tab-pane container" id="typography">

        </div>
    </div>
</div>