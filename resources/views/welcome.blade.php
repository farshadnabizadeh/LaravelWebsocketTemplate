<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row" style="width: 100%; !important">
            <ul class="msg-list" style="width: 100%; !important">

            </ul>
        </div>
        <form method="post" id="chatForm">
            <div class="form-group">
                <label for="message"></label>
                <input type="text" name="message" id="message" class="form-control" />
            </div>
            <div>
                <input type="submit" id="subBtn" class="btn btn-info" value="send">
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.templates/1.0.0/jquery.tmpl.min.js"></script>
    <script type="module" src="{{ asset('scripts/index.js') }}"></script>
    <script>
        $(document).ready(function() {
            var conn = new WebSocket('wss://healthandtourismturkey.com/ws');
            var chatForm = $('#chatForm');
            var userMessage = $("#message");
            var msgList = $('.msg-list');
            chatForm.on('submit', function(e) {
                e.preventDefault();
                var message = userMessage.val();
                conn.send(message);
                msgList.prepend(`
                <li style='width:100%;display:flex;justify-content: start;'>
                    <div style='width:50%;border-radius:10px;margin:10px 0;text-align:center;padding:10px 20px;color:#ffffff;background-color:#3364FF;'>
                        ${message}
                    </div>
                </li>
                `);
            });
            conn.onopen = function(e) {
                console.log("Connection stablished");
            }
            conn.onmessage = function(e) {
                console.log(e.data);
                msgList.prepend(
                    `
                    <li style='width:100%;display:flex;justify-content: end;'>
                        <div style='width:50%;border-radius:10px;margin:10px 0;text-align:center;padding:10px 20px;color:#ffffff;background-color:#c8173f;'>
                            ${e.data}
                        </div>
                    </li>
                `
                );

            }
        });

    </script>
</body>
</html>
{{-- msgList.prepend("<li style='width:100%;'>" + message + "</li>");  --}}
{{-- msgList.prepend("<li style='color:red;'>" + e.data + "</li>");  --}}
