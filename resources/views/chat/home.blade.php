<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- csrf token  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bubble-chat.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>Hello, world!</title>
</head>

<body>
    <input type="hidden" id="user-log-id" value="{{ auth()->user()->id }}">
    <div class="content-wrapper">
        <div class="list-friend-segment">
            <div class="sidebar-header">
                <div class="profile-wrapper">
                    <div class="img-profile">
                        <img src="{{ asset('img/user_img/'.auth()->user()->foto .'.jpg') }}" alt="" class="profile-pict">
                    </div>
                    <div class="action-wrapper">
                        <i class="fas fa-circle-notch"></i>
                        <i class="fas fa-comment-dots"></i>
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
                <div class="search-wrapper">
                    <div class="form-search">
                        <label for=""><i class="fas fa-search"></i></label>
                        <input type="text" class="round-input" placeholder="cari atau mulai chat baru">
                    </div>
                </div>
            </div>
            <div class="list-friend">
                @foreach ($friendList as $row)
                <div class="friend-wrapper" data-id_friend="{{ $row->id }}">
                    <div class="friend-img">
                        <img src="{{ asset('img/user_img/'.$row->foto .'.jpg') }}" alt="" class="profile-pict-lg">
                    </div>
                    <div class="friend-chat">
                        <div class="name-wrapper">
                            <p class="p-0 m-0">{{ $row->name }}</p>
                            <p class="p-0 m-0 waktu-chat-masuk">15.26</p>
                        </div>
                        <div class=" chat-wrapper">
                            <p class="p-0 m-0 text-small chat-terbaru">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam, perspiciatis.</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="chat-segment">


            <div class="sidebar-header no-border fixed ">
                <div class="profile-wrapper">
                    <div class="img-profile">
                        <img src="{{ asset('img/user_img/1.jpg') }}" alt="" class="profile-pict">
                        <span class="p-3" id="friend-name">your friend name</span>
                    </div>
                    <div class="action-wrapper">
                        <i></i>
                        <i></i>
                        <i class="fas fa-search"></i>
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
            </div>
            <div class="chat-bubble-wrapper">
                <div class="chat-content">


                </div>

            </div>
            <div class="chat-input-wrapper ">
                <i class="far fa-laugh-squint"></i>
                <i class="fas fa-paperclip"></i>
                <input type="hidden" name="id_penerima" id="id_penerima" value="{{ isset($friend) ? $friend->id : '' }}">
                <input type="text" name="pesan" id="pesan" class="round-input" placeholder="ketik pesan">
                {{-- <i class="fas fa-microphone"></i> --}}
                <i class="fas fa-paper-plane send-message"></i>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).on('click', '.send-message', function() {
                let idPenerima = $('#id_penerima').val();
                let pesan = $('#pesan').val();
                console.log(idPenerima)
                console.log(pesan)
                if (pesan != '') {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        , url: '/user/send_message'
                        , method: 'post'
                        , dataType: 'json'
                        , data: {
                            id_penerima: idPenerima
                            , pesan: pesan
                        }
                        , success: function(data) {
                            fetchDataChat(idPenerima);
                        }
                    })
                }
            })

            // setInterval(() => {
            //     let idPenerima = $('#id_penerima').val();
            //     fetchDataChat(idPenerima);
            // }, 3000);

            function fetchDataChat(idFriend) {
                let userLogId = $('#user-log-id').val();
                $.ajax({
                    url: "/user/fetch_data_chat?idFriend=" + idFriend
                    , success: function(data) {
                        $('#friend-name').html(data.friend.name)
                        $('#id_penerima').val(data.friend.id)
                        for (i in data.chat) {
                            let bubleChatType = '';
                            if (data.chat[i].id_pengirim == userLogId) {
                                bubleChatType = 'right-top right';
                            } else {
                                bubleChatType = 'left-top left';
                            }
                            let chatContent = '';
                            chatContent += '<div class="talk-bubble tri-right round ' + bubleChatType + '">';
                            chatContent += '<div class="talktext">';
                            chatContent += '<p>' + data.chat[i].pesan + '</p>';
                            chatContent += '</div>';
                            chatContent += '</div>';
                            console.log(chatContent);
                            $('.chat-content').append(chatContent);
                        }
                        //console.log(data.chat);
                    }
                    , error: function(err) {
                        console.log(err);
                    }
                })
            }

            $(document).on('click', '.friend-wrapper', function() {
                let idFriend = $(this).data('id_friend');
                fetchDataChat(idFriend);
            })


            $(document).ready(function() {
                $('.content-wrapper').css('margin', '0px auto')
            })
            $(window).resize(function() {
                let windowSize = $(window).width();
                if (windowSize > 1364.2) {
                    $('.content-wrapper').css('margin', '10px auto')
                } else {
                    $('.content-wrapper').css('margin', '0px auto')
                }
            }).resize();

        </script>
</body>

</html>
