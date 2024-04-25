<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @push('customfrontcss')
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap');
       *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Nanum Gothic", sans-serif;
       }
       body{
            background: linear-gradient(90deg, #0e3959 0%,#0e3959 30%,#03a9f5 30%, #03a9f5 100%);
       }
       .contactUs{
        position: relative;
        width:100%;
        padding:40px 100px;
       }
       .contactUs .title{
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2em;
       }
       .contactUs .contact h2{
            color: #fff;
            font-weight:500;
       }
       .form{
        grid-area: form;
       }
       .info{
        grid-area: info;
       }
       .map{
        grid-area: map;
       }
       .contact{
        padding: 40px;
        background: #fff;
        box-shadow: 0 5px 35px rgba(0,0,0,0.15);
       }
       .box{
        position: relative;
        display: grid;
        grid-template-columns: 2fr 1fr;
        grid-template-rows: 5fr 4fr;
        grid-template-areas:
        "form info"
        "form map";
        grid-gap: 20px;
        margin: 20px
       }
       .contact h3 {
        color: #0e3959;
        font-weight: 500;
        font-size:1.4em;
        margin-bottom: 10px;
       }
       .formBox
       {
        position: relative;
        width:100%;
       }
       /* .formBox .inputBox
       {
        display:flex;
        gap: 20px;
       } */
       .formBox .inputBox
       {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
        gap: 20px;
       }

       .formBox  .row100 .inputBox{
        width: 100%;
       }
       .inputBox span{
        color: #18b7ff;
        margin-top: 10px;
        margin-bottom: 5px;
        font-weight: 500;
       }
       .inputBox input{
            padding: 10px;
            font-size: 1.1em;
            outline: none;
            border: 1px solid #333;
       }
       .inputBox textarea{
            padding: 10px;
            font-size: 1.1em;
            outline: none;
            border: 1px solid #333;
            resize: none;
            min-height: 220px;
            margin-bottom: 10px;
        }
        .inputBox input[type="submit"]
        {
            background: #ff578b;
            color: #fff;
            border:none;
            font-size: 1.1em;
            max-width: 120px;
            font-weight:500;
            cursor: pointer;
            padding: 14px 15px;
        }
        .inputBox ::placeholder
        {
            color: #999;
        }
        .info
        {
            background: #0e3959;
        }
        .info h3
        {
            color: #fff;
        }
        .info .infoBox .address
        {
            display: flex;
            align-items: center;
            margin-bottom: 5px;

        }
       .address i{
        margin-right: 10px;
       }
       .address span{
        margin-right: 5px;
       }
       .info .infoBox  .address span{
        min-width: 40px;
        height:40px;
        color:#fff;
        display: flex;
        justify-content: center;
        align-items:center;
        font-size:1.2em;

        nargin-right: 15px;
       }
       .info .infoBox  .address p{
        color:#fff;
       }
       .sci{
        margin-top:40px;
        display:flex;
       }
       .sci li
       {
        list-style:none;
        margin-right:15px;
       }
       .sci li a
       {
        font-size: 2em;
        color:#ccc;
       }
       .sci li a:hover
       {
        color: #fff;
       }
       .map{
        padding: 0;
       }
       .map iframe
       {
        width: 100%;
        height: 100%;
       }

       /* responsive */
@media (max-width: 991px)
{
    body
    {
        background:#03a9f5;
    }
    .contactUs
    {
        padding:20px;


    }
    .box {
    grid-template-columns: 1fr;
    grid-template-rows: auto;
    grid-template-areas:
        "form"
        "info"
        "map";
    }

    .formBox{
        display: flex;
        gap: 0;
        flex-direction:column;

    }

     .inputBox
    {
        width: 100%;
    }
    .contact{
        padding: 30px;
    }
    .map
    {
        min-height:300px;
        padding: 0;
    }
}
        </style>
    @endpush

</head>
<body>
    <div class="contactUs">
        <div class="title">
            <h2>Get in Touch</h2>
        </div>
        <div class="box">
            <div class="contact form">
                <h3>Send Message</h3>
                <form action="">
                    <div class="formBox">
                        <div class="inputBox">
                            <span>Name</span>
                            <input type="text" placeholder="Enter your Name">
                        </div>
                        <div class="inputBox">
                            <span>Email</span>
                            <input type="email" placeholder="Enter your Name">
                        </div>
                        <div class="inputBox">
                            <span>Mobile</span>
                            <input type="number" placeholder="Enter your Number">
                        </div>
                        <div class="row100">
                            <div class="inputBox">
                                <span>Message</span>
                                <textarea name="" placeholder="Write your message"></textarea>
                            </div>
                        </div>
                        <div class="row100">
                            <div class="inputBox">
                            <input type="submit" value="Send">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="contact info">
            @foreach ($contacts as $contact)
                <h3>Contact Info</h3>
                <div class="infoBox">
                    <div class="address">
                        <span><i class="fa-solid fa-location-dot"></i>Address: </span>
                        <p>{{ $contact->address }}</p>
                    </div>
                </div>
                <div class="infoBox">
                    <div class="address">
                        <span><i class="fa-solid fa-envelope"></i>Email: </span>
                        <p>{{ $contact->email }}</p>
                    </div>
                </div>
                <div class="infoBox">
                    <div class="address">
                        <span><i class="fa-solid fa-phone"></i>Phone: </span>
                        <p>{{ $contact->phone }}</p>
                    </div>
                </div>
                <ul class="sci">
                    <li><a href="{{ $contact->facebook }}" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href="{{  $contact->instagram }}" target="_blank"><i class="fa-brands fa-square-instagram"></i></a></li>
                    <li><a href="{{  $contact->twitter }}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="{{  $contact->linkedin }}" target="_blank""><i class="fa-brands fa-linkedin"></i></a></li>
                    <li><a href="{{  $contact->youtube }}" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                </ul>
@endforeach
            </div>
            <div class="contact map" >

                @if ($contact->google_map != null)
                {!! $contact->google_map !!}
                @endif
            </div>


        </div>
    </div>
 @stack('customfrontcss')
</body>
</html>
