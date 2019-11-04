<!-- Sidebar  -->
<link rel="stylesheet" type="text/css" href="/myfactory/styles/sidebar.css?d=<?= date("YmdHis"); ?>">
<nav class="col-2 no-gutter" id="sidebar">
    <div class="sidebar-logo">
        <img src="/myfactory/images/iapparel_logo.png">
    </div>

    <div class="pt-2 sidebar-header border-bottom">
        <h5 class="text-center"><?= $_SESSION["username"]; ?></h5>
        <h6 class="text-center small" id="menu_datetime"></h6>
        <p class="text-right mb-1 pr-3 small" id="btn-logout"><a href="./logout.php"><?= $hdlang["logout"]; ?> <i class="fa fa-sign-out-alt"></i></a></p>
        <p class="text-right mb-2 pr-3 small"><a href="/myfactory/index.php"><?= $hdlang["home"]; ?> <i class="fa fa-home"></i> </a></p> 
    </div>

    <ul class="list-unstyled components">
        <li>
            <a class="dropdown-toggle" href="#" data-toggle="collapse" aria-expanded="false" data-target="#setup"><?= $hdlang["setup"]; ?></a>
            <ul class="collapse list-unstyled submenu" id="setup">
                <li>
                    <a href="/myfactory/usr_acc/index.php">Account Maintenance</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="dropdown-toggle" href="#" data-toggle="collapse" aria-expanded="false" data-target="#misc">Miscellaneous <span class="caret"></span></a>
            <ul class="collapse list-unstyled submenu" id="misc">
                <?php 
                $user_class->printMisc();
                ?>
            </ul>
        </li>
        <li>
            <a href="#">2</a>
        </li>
    </ul>  
</nav>

<script type="text/javascript">
    $(document).ready(function()
    {
        updateClock(); 
    });

    function updateClock() 
    {
        var now = new Date(); // current date
        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]; // you get the idea
        var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

        var hours = String(now.getHours()); 
        var mins = String(now.getMinutes()); 
        var secs = String(now.getSeconds()); 
        var time = hours.padStart(2,"0") + ":" + mins.padStart(2,"0") + ":" + secs.padStart(2,"0"); // again, you get the idea

        var dates = String(now.getDate());
        var datetime = days[now.getDay()] + ", " + months[now.getMonth()] + " " + dates.padStart(2,"0") + " @ " + time; 


        // set the content of the element with the ID time to the formatted string
        document.getElementById("menu_datetime").innerHTML = datetime; 

        // call this function again in 1000ms
        setTimeout(updateClock, 1000);
    }
</script>