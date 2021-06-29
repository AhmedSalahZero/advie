<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>The tailors </title>

</head>

<body>



<div class="page-container">




    <div class="main-content">






        <div class="card-body">

            <div class="single-table">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead class="text-uppercase bg-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">created_at</th>
                            <th scope="col">Read</th>


                        </tr>
                        </thead>
                        <tbody>



                        <tr class="message{{$lastMessage->id}}">

                            <th scope="row">{{$lastMessage->id}}</th>
                            <td>{{$lastMessage->name}}</td>
                            <td>{{$lastMessage->email}}</td>

                            <td>{{$lastMessage->subject}}</td>
                            <td>{{$lastMessage->message}}</td>
                            <td>
                                {{$lastMessage->created_at}}
                            </td>

                            <td>

                                <a href="{{url("admin/messages/".$lastMessage->id)}}" class="{{$lastMessage->id}}"  id="but" style="color:blue;background:none;" >
                                    Read
                                </a>



                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>





</div>

</body>

</html>


