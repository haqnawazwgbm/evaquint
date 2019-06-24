            <div class="panel-body {{ $markers->displayChat }} displayChat">
                <div class="row">
                    <div class="col-md-9 col-lg-9 col-lg-offset-1">
                        <div class="chat_window">
                            <div class="top_menu">
                                <div class="title">Discussion</div>
                            </div>
                            <ul class="messages"></ul>
                            <div class="bottom_wrapper clearfix">
                                <div class="message_input_wrapper"><input class="message_input"
                                                                          placeholder="Type your message here..."/>
                                </div>
                                <div class="send_message">
                                    <div class="icon"></div>
                                    <div class="text">Send</div>
                                </div>
                            </div>
                        </div>
                        <div class="message_template">
                            <li class="message">
                                <div class="avatar avatarImage">
                                    <img src="sdf" class="userImage"/>
                                </div>
                                <div class="text_wrapper">
                                    <div class="avatarName"><strong></strong></div>
                                    @if (! Auth::guest())
                                        <a href="#" class="pull-right discussionButton"><span
                                                    class="glyphicon glyphicon-remove "></span></a>
                                        <div class="text"></div>
                                        <span class="discussion-datetime glyphicon glyphicon-time pull-right">01-01-2016 03:00</span>
                                    @endif
                                </div>

                            </li>
                        </div>
                    </div>

                </div>
            </div>
<script>
      //Start chat section from here.
        (function () {
            var chatID;
            var myChat = 'false';
            var Message;
            var name;
            var image;
            var userID = {{ Auth::user()->id }};
            var poiID = {{ $markers->id }};
            var dateTime;
            Message = function (arg) {
                this.text = arg.text, this.message_side = arg.message_side;
                this.draw = function (_this) {
                    return function () {
                        var $message;
                        $message = $($('.message_template').clone().html());
                        $message.addClass(_this.message_side).find('.text').html(_this.text);
                        $message.find('.avatarName').children('strong').html(name);
                        $message.find('.discussionButton').attr("id", chatID);
                        $message.find('.userImage').attr("src", image);
                        $message.find('.discussion-datetime').html(dateTime);
                        console.log($message);
                        $('.messages').append($message);
                        return $message.addClass('appeared');
                    };
                }(this);
                return this;
            };
            $(function () {
                var getMessageText, message_side, sendMessage;
                message_side;
                getMessageText = function () {
                    var $message_input;
                    $message_input = $('.message_input');
                    return $message_input.val();
                };
                sendMessage = function (text) {
                    var $messages, message;
                    if (text.trim() === '') {
                        return;
                    }
                    $('.message_input').val('');
                    $messages = $('.messages');
                    message_side = message_side === 'guest' ? 'right' : 'left';
                    message = new Message({
                        text: text,
                        message_side: message_side
                    });
                    message.draw();
                    return $messages.animate({scrollTop: $messages.prop('scrollHeight')}, 300);
                };
                $('.send_message').click(function (e) {
                    // Inserting discussion into database start from here.
                    var data = {userID: userID, poiID: poiID, discussion: getMessageText()};
                    myChat = 'true';
                    $.ajax({
                        url: "/insertDiscussion",
                        type: "POST",
                        data: data,
                        success: function (data) {
                            var parseData = JSON.parse(data);
                            name = parseData[0].first_name + ' ' + parseData[0].last_name;
                            image = parseData[0].user_picture;
                            message_side = parseData[0].userType;
                            chatID = parseData[0].chatID;
                            dateTime = parseData[0].dateTime;
                            myChat = 'false';
                            return sendMessage(getMessageText());
                        }
                    });

                });
                $('.message_input').keyup(function (e) {
                    if (e.which === 13) {
                        $( ".send_message" ).trigger( "click" );
                    }
                });
                @foreach($markers->discussions as $discussion)
                        name = '{{ $discussion->first_name }}' + ' ' + '{{ $discussion->last_name }}';
                image =  '{{ $discussion->user_picture }}';
                message_side = '{{ $discussion->userType }}';
                chatID = {{ $discussion->chatID }};
                dateTime = '{{ $discussion->dateTime }}';
                sendMessage('{{ $discussion->discussion }}');
                @endforeach
                 update();

                $("body").delegate('.discussionButton', 'click', function (e) {
                    e.preventDefault();
                    if (confirm("Are you sure to delete this comment?")) {
                        $(this).parent().parent().remove();
                        $.ajax({
                            url: "/deleteDiscussion",
                            type: "POST",
                            data: {chatID: $(this).attr('id')},
                            success: function (e) {
                            }
                        });
                    }
                });

                function update () {
                    if (typeof chatID == 'undefined') {
                        chatID = '';
                    }
                    if (myChat == 'false') {
                        var data = {chatID: chatID, userID: userID, poiID: poiID};
                        $.ajax({
                            url: "/getDiscussions",
                            type: "POST",
                            data: data,
                            success: function (data) {
                                console.log(data);
                                if(data) {
                                    var parseData = JSON.parse(data);
                                    name = parseData[0].first_name + ' ' + parseData[0].last_name;
                                    image = parseData[0].user_picture;
                                    message_side = parseData[0].userType;
                                    chatID = parseData[0].chatID;
                                    dateTime = parseData[0].dateTime;
                                    sendMessage(parseData[0].discussion);
                                }
                                setTimeout(update,3000);

                            }
                        });
                    }

                }




            });
        }.call(this));
</script>