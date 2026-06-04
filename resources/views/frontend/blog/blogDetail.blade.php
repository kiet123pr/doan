@extends('frontend.layout.app')
@section('section')
<script>
    if (screen.width <= 736) {
        document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
    }
</script>
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        <div class="single-blog-post">
            <h3>{{$data['title']}}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Mac Doe</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <!-- <span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span> -->
            </div>
            <a href="">
                <img src="{{ asset('/public/uploads/blogs/' . $data['image']) }}" alt="">
            </a>
            <p>
                {!!$data['content']!!}
            </p> <br>


            <div class="pager-area">
                <ul class="pager pull-right">
                    @if($data1)
                    <li><a href="{{url('/blogDetail/'. $data1['id'])}}">Pre</a></li>
                    @endif
                    @if($data2)
                    <li><a href="{{url('/blogDetail/'. $data2['id'])}}">Next</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div><!--/blog-post-area-->
    <div class="rate">

        <div class="vote" id="{{$data['id']}}">
            <!-- // nếu rating > 1 thì hiển thị sao vàng lên còn không thì hiển thị sao bạc  -->
            @for($i=1;$i <= 5;$i++)
            @if($i<= $newRate)
                <div class="star_1 ratings_stars ratings_over"><input value ="{{$i}}" type="hidden"></div>
            @else
                <div class="star_1 ratings_stars ratings_hover"><input value ="{{$i}}" type="hidden"></div>
            @endif
            @endfor
        </div>
    </div>
    <div class="socials-share">
        <a href=""> <img src="{{ asset('frontend/images1/blog/socials.png') }}" alt="" /></a>
    </div><!--/socials-share-->

    <!-- <div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="images/blog/man-one.jpg" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
					</div> --><!--Comments-->
    <div class="response-area">
        <h2>3 RESPONSES</h2>
        <ul class="media-list">
            @foreach($dataCmt as $key => $valueCha)
            @if($valueCha['level'] == 0)
            <li class="media" id="{{$valueCha['id']}}">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{asset('upload/user/'. $valueCha['avatar'])}}" alt="">
                </a>
                <div class="media-body">
                    <ul class="sinlge-post-meta">
                        <li><i class="fa fa-user"></i>{{$valueCha['name_user']}}</li>
                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                    </ul>
                    <p>{{$valueCha['cmt']}}</p>
                    <a class="btn btn-primary reply-btn" href=""><i class="fa fa-reply"></i>Replay</a>
                    <div class="new-comment">
                        <textarea class="textarea1" name="message" rows="11"></textarea>
                        <a class="btn btn-primary new-comment-btn">post comment</a>
                    </div>
                </div>
            </li>
            @endif
            @foreach($cmtCon as $key => $valueCon)
            @if($valueCon['level'] == $valueCha['id'])
            <li class="media second-media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{asset('upload/user/'. $valueCon['avatar'])}}" alt="" />
                </a>
                <div class="media-body">
                    <ul class="sinlge-post-meta">
                        <li><i class="fa fa-user"></i>{{$valueCon['name_user']}}</li>
                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                    </ul>
                    <p>{{$valueCon['cmt']}}</p>
                    <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                </div>
            </li>
            @endif
            @endforeach
            @endforeach
        </ul>
    </div><!--/Response-area-->
    <div class="replay-box">
        <div class="row">
            <div class="col-sm-12">
                <h2>Leave a replay</h2>

                <div class="text-area" id="{{$data['id']}}">
                    <div class="blank-arrow">
                        <label>Your Name</label>
                    </div>
                    <span>*</span>
                    <textarea name="message" rows="11"></textarea>
                    <a id="comment-btn" class="btn btn-primary">post comment</a>
                </div>
            </div>
        </div>
    </div><!--/Repaly Box-->
</div>
<script>
    $(document).ready(function() {
        $('.new-comment').hide();
        $('.reply-btn').click(function(e) {
            e.preventDefault();
            $(this).closest('.media-body').find('.new-comment').show();
        })
        $('.new-comment-btn').click(function(e) {
            e.preventDefault();
            var checklogin = "{{Auth::check()}}"
            if (checklogin) {
                var cmt = $(this).closest('li.media').find('.textarea1').val();
                var id_blog = "{{$data['id']}}";
                var level = $(this).closest('li.media').attr('id');
                console.log(cmt);
                console.log(level);
                console.log(id_blog);
                $.ajax({
                    type: "POST",
                    url: '{{url("/blog/cmt/ajax")}}',
                    data: {
                        level: level,
                        id_blog: id_blog,
                        cmt: cmt
                    },
                    success: function(data) {
                        const datacmt = data.data;
                        console.log(datacmt)
                        const cmt_con =
                            '<li class="media second-media">' +
                            '<a class="pull-left" href="#">' + '<img class="media-object" src="/upload/user/' + datacmt['avatar'] + '">' + "</a>" +
                            '<div class="media-body">' +
                            '<ul class="sinlge-post-meta">' +
                            " <li>" + '<i class="fa fa-user">' + " </i>" + datacmt['name_user'] + "</li>" +
                            " <li>" + '<i class="fa fa-clock-o">' + "</i>" + "1:33 pm" + "</li>" +
                            " <li>" + '<i class="fa fa-calendar">' + "</i>" + "DEC 5, 2013" + "</li>" +
                            "</ul>" +
                            "<p>" + datacmt['cmt'] + "</p>" +
                            '<a class="btn btn-primary new-comment-btn" href="">' + '<i class="fa fa-reply">' + "</i>" + "Replay" + "</a>" +
                            "</div>" +
                            "</li>"
                        console.log(cmt_con);
                        $("#" + level).after(cmt_con);
                    },
                })
            } else {
                alert("vui lòng login để comment");
            }
            $(this).closest('.new-comment').hide();
        })
        $('#comment-btn').click(function(e) {
            e.preventDefault();
            var checkLogin = "{{Auth::Check()}}";
            // console.log(checkLogin);
            if (checkLogin) {
                var value = $(this).closest('.text-area').find('textarea').val();
                var id_blog = $(this).closest('.text-area').attr('id');
                console.log(id_blog);
                console.log(value);
                $.ajax({
                    type: 'POST',
                    url: '{{url("/blog/cmt/ajax")}}',
                    data: {
                        cmt: value,
                        id_blog: id_blog,
                        level: 0
                    },
                    success: function(data) {
                        const newData = data.data;
                        console.log(newData)
                        const newCmt =
                            '<li class="media">' +
                            '<a class="pull-left" href="#">' + '<img class="media-object" src="/upload/user/' + newData['avatar'] + '">' + '</a>' +
                            '<div class="media-body">' +
                            '<ul class="sinlge-post-meta"> ' +
                            "<li>" + '<i class="fa fa-user">' + "</i>" + newData['name_user'] + "</li>" +
                            " <li>" + '<i class="fa fa-clock-o">' + "</i>" + "1:33 pm" + "</li>" +
                            "<li>" + '<i class="fa fa-calendar">' + "</i>" + "DEC 5, 2013" + "</li>" +
                            "</ul>" +
                            "<p>" + newData['cmt'] + "</p>" +
                            '<a class="btn btn-primary" href="">' + '<i class="fa fa-reply">' + "</i>" + "Replay" + "</a>" +
                            "</div>" +
                            "</li>";
                        console.log(newCmt);
                        $(".media-list").append(newCmt);
                    },
                })
            } else {
                alert("vui lòng login để comment");
            }
        })
        //vote
        $('.ratings_stars').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().addBack().addClass('ratings_hover');
                // $(this).nextAll().removeClass('ratings_vote'); 
            },
            function() {
                $(this).prevAll().addBack().removeClass('ratings_hover');
                // set_votes($(this).parent());
            }
        );

        $('.ratings_stars').click(function() {
            var checkLogin = "{{Auth::Check()}}";
            console.log(checkLogin);
            if (checkLogin) {
                var Values = $(this).find("input").val();
                var id_blog = $(this).closest(".rate").find(".vote").attr('id');
                console.log(id_blog);
                // kt có click vào chưa
                if ($(this).hasClass('ratings_over')) {
                    $('.ratings_stars').removeClass('ratings_over');
                    // prevALL : lấy các sao trước sao click 
                    // addback : lấy cả sao hiện tại
                    $(this).prevAll().addBack().addClass('ratings_over');
                } else {
                    $(this).prevAll().addBack().addClass('ratings_over');
                }
                $.ajax({
                    type: 'POST',
                    url: '{{url("/blog/rating/ajax")}}',
                    data: {
                        rate: Values,
                        id_blog: id_blog,
                    },
                    success: function(data) {
                        console.log(data);
                    }
                })
            } else {
                alert("vui lòng login để rate");
            }
        });
    });
</script>
@endsection