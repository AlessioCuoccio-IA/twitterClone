<footer class="footer">
    <div class="container">
        <p>&copy; My Website 2021</p>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>

<!--Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title" id="loginModalTitle">Login</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="loginAlert"></div>
                <form>
                    <input type="hidden" id="loginActive" name="loginActive" value="1">
                    <fieldset class="form-group">
                        <label for="email">Email</label> 
                        <input type="email" class="form-control" id="email" placeholder="Email address"> 
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <a id="toggleLogin">Sing up</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="loginSingupButton" class="btn btn-primary">Login</button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#toggleLogin").click(function(){
        if ($("#loginActive").val() == "1") {
            $("#loginActive").val("0");
            $("#loginModalTitle").html("Sing Up");
            $("#loginSingupButton").html("Sing Up");
            $("#toggleLogin").html("Login");
        } else {
            $("#loginActive").val("1");
            $("#loginModalTitle").html("Login");
            $("#loginSingupButton").html("Login");
            $("#toggleLogin").html("Sing up");
        }
    })

    $("#loginSingupButton").click(function() {
        $.ajax({
            type:"POST",
            url:"actions.php?action=loginSingup",
            data:"email=" + $("#email").val + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
            success: function(result) {
                if (result == "1") {
                    window.location.assign("http://localhost/twitterClone/");
                } else {
                    $("loginAlert").html(result).show();
                }
            }
        })
    })

    $(".toggleFollow").click(function() {
        var id = $(this).attr("data-userId");

        $.ajax({
            type:"POST",
            url:"actions.php?action=toggleFollow",
            data: "userId=" + id,
            success: function(result) {
                if (result == "1") {
                    $("a[data-userId='" + id + "']").html("Follow"); 
                } else if (result == "2") {
                    $("a[data-userId='" + id + "']").html("Unfollow");
                }
            }
        })
    })

    $("#postTweetButton").click(function() {
        $.ajax({
            type:"POST",
            url:"actions.php?action=postTweet",
            data: "tweetContent=" + $("#tweetContent").val(),
            success: function(result) {
                if (result == "1") {
                    $("#tweetSuccess").show();
                    $("#tweetSuccess").hide();
                } else if (result != "") {
                    $("#tweetFail").html(result).show();
                    $("#tweetSuccess").hide();
                }
            }
        })
    })
</script>

</body>
</html>