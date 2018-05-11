<header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>Nefertari</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme"></span>
                        </a>

                        <ul class="dropdown-menu extended inbox">

                            <li>
                                <p class="green">Messages</p>
                            </li>
                            <li class="dropdown2">


                            </li>
                            <li>
                                <a href="/notification/default"><strong>See all messages</strong></a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
              <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="/index/logout">Logout</a></li>
              </ul>
            </div>
        </header>
<script>

    $(document).ready(function(){
        setInterval(fetchUnseendata,10000);
    });

            function fetchUnseendata(){
            $.ajax({
                url: "/notification/add",
                method: "POST",
                data: {action: "getUnseen"},
                success: function (data, tS, theXHRObject) {
                    if (data > 0) {
                        $('.badge').html(data);
                    }
                }
            }); }

    $(document).ready(function() {

        $.ajax({
            url: "/notification/add",
            method: "POST",
            data: {action: "getUnseen"},
            success: function (data, tS, theXHRObject) {
                if (data > 0) {
                    $('.badge').html(data);
                }
            }
        });

        $(document).on('click', '.dropdown-toggle', function () {
            var d = new Date();

            $('.badge').html('');
            $.ajax({
                url: "/notification/add",
                method: "POST",
                data: {action: "getSeen"},
                success: function (data, tS, theXHRObject) {
                    $('.dropdown2').html('');
                    $.each(JSON.parse(data), function (i, data) {
                        $('.dropdown2').append($('<li><a href=""><span class="subject"><span class="from">' + data.fname + ' ' + data.lname + '</span><span class="time">' + data.created_at + '</span></span><span class="message">' + data.title + '</span><span class="message">' + data.body + '</span></a></li>'));
                    });
                }
            });
        });
    });

</script>

